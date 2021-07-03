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

/**
 * Class VideoController
 * @package frontend\controllers
 */
class VideoController extends Controller
{

    /**
     * @return array[]
     */
    public function behaviors():array
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


    /**
     * @return string
     */
    public function actionIndex():string
    {

        $videoService = new VideoService();
        $dataProvider = new ActiveDataProvider([
            'query' => $videoService->videoSearchGet()
        ]);

        return $this->render('index',[
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(string $id):string
    {
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

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionLike(string $id):string
    {

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

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionDislike(string $id):string
    {

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

    /**
     * @param $keyword
     * @return string
     */
    public function actionSearch(string $keyword):string
    {
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

    /**
     * @return string
     */
    public function actionHistory():string
    {

        $videoService = new VideoService();
        $query = $videoService->videoHistoryGet();


        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);


        return $this->render('history',[
            'dataProvider' => $dataProvider
        ]);


    }

    /**
     * @param $videoId
     * @param $userId
     * @param $type
     */
    protected function saveLikeDislike(int $videoId,int $userId,$type):void
    {

        $videoLikeDislike = new VideoLike();
        $videoLikeDislike->video_id = $videoId;
        $videoLikeDislike->user_id = $userId;
        $videoLikeDislike->type = $type;
        $videoLikeDislike->created_at = time();
        $videoLikeDislike->save();
    }
}