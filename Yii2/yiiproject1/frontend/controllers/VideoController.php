<?php


namespace frontend\controllers;

use frontend\modelviews\VideoModelView;
use frontend\services\VideoService;
use frontend\repositories\VideoRepository;
use common\models\Video;
use common\models\VideoLike;
use common\models\VideoView;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class VideoController extends Controller
{

    public function behaviors()
    {
        return [
            'access'=> [
                'class' => AccessControl::class,
                'only' => ['like','dislike','history'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],

            'verb' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'like' => ['post'],
                    'dislike' => ['post'],
                ]
            ]
        ];
    }


    public function actionIndex(){


        $videoService = new VideoService();
        $dataProvider = new ActiveDataProvider([
            'query' => $videoService->videoSearchGet()
        ]);

        return $this->render('index',[
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id){
        $this->layout = 'auth';
        $videoRepository = new VideoRepository();
        $video = $videoRepository->findVideo($id);
        if(!$video){
            throw new NotFoundHttpException("Video does not exist");
        }

        $videoService = new VideoService();
        $videoService->videoViewSave($id);
        $similarVideos = $videoService->videoSimilarGet($id,$video);

        $viewModel = new VideoModelView($video);
        return $this->render('view',[
            'viewModel' => $viewModel,
            'similarVideos' => $similarVideos
        ]);
    }

    public function actionLike($id){

        $videoRepository = new VideoRepository();
        $video = $videoRepository->findVideo($id);
        if(!$video){
            throw new NotFoundHttpException("Video does not exist");
        }
        $userId = \Yii::$app->user->id;

        $videoService = new VideoService();
        $videoService->likeDislikeSave($id,$userId,VideoLike::TYPE_LIKE);

        $viewModel  = new VideoModelView($video);
        return $this->renderAjax('_buttons',[
            'viewModel' => $viewModel
        ]);
    }


    public function actionDislike($id){

        $videoRepository = new VideoRepository();
        $video = $videoRepository->findVideo($id);
        if(!$video){
            throw new NotFoundHttpException("Video does not exist");
        }
        $userId = \Yii::$app->user->id;

        $videoService = new VideoService();
        $videoService->likeDislikeSave($id,$userId,VideoLike::TYPE_DISLIKE);

        $viewModel  = new VideoModelView($video);
        return $this->renderAjax('_buttons',[
            'viewModel' => $viewModel
        ]);
    }

    public function actionSearch($keyword){
        $videoService = new VideoService();
        $query = $videoService->videoSearchGet();

        if($keyword){
            $query->byKeyword($keyword);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);


        return $this->render('search',[
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionHistory(){

        $videoService = new VideoService();
        $query = $videoService->videoHistoryGet();


        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);


        return $this->render('history',[
            'dataProvider' => $dataProvider
        ]);


    }


    protected function saveLikeDislike($videoId,$userId,$type){

        $videoLikeDislike = new VideoLike();
        $videoLikeDislike->video_id = $videoId;
        $videoLikeDislike->user_id = $userId;
        $videoLikeDislike->type = $type;
        $videoLikeDislike->created_at = time();
        $videoLikeDislike->save();
    }
}