<?php

namespace frontend\services;

use common\models\Video;
use common\models\VideoLike;
use common\models\VideoView;
use yii\base\BaseObject;
use yii\db\Exception;

/**
 * Class VideoService
 * @package frontend\services
 */
final class VideoService
{

    /**
     * @param $videoId
     * @param $userId
     * @param $type
     * @throws Exception
     */
    public function saveLikeDislike(string $videoId,int $userId,$type):void
    {

        $videoLikeDislike = new VideoLike();
        $videoLikeDislike->video_id = $videoId;
        $videoLikeDislike->user_id = $userId;
        $videoLikeDislike->type = $type;
        $videoLikeDislike->created_at = time();
        if(!$videoLikeDislike->save()){

            throw new Exception("Can`t save");
        }
    }

    /**
     * @param $id
     * @param $userId
     * @param $type
     * @throws Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function likeDislikeSave(string $id,int $userId,$type):void
    {

        $videoLikeDislike = VideoLike::find()->userIdVideoId($userId,$id)->one();
        $likeDislikeSaver = new VideoService();
        if(!$videoLikeDislike) {

            $likeDislikeSaver->saveLikeDislike($id,$userId,$type);
        }else if($videoLikeDislike->type == $type){

            $videoLikeDislike->delete();
        }else{

            $videoLikeDislike->delete();
            $likeDislikeSaver->saveLikeDislike($id,$userId,$type);
        }
    }

    /**
     * @param $id
     */
    public function videoViewSave(string $id):void
    {
        $videoView = new VideoView();
        $videoView->video_id = $id;
        $videoView->user_id = \Yii::$app->user->id;
        $videoView->created_at = time();
        if(!$videoView->save()){

            throw new Exception("Can`t save");
        }
    }

    /**
     * @param $id
     * @param $video
     * @return array|Video[]
     */
    public function videoSimilarGet(string $id,Video $video):array
    {

        return Video::find()->published()->andWhere(['NOT',['video_id'=>$id]])->byKeyword($video->title)->limit(11)->all();
    }

    /**
     * @return \common\models\query\VideoQuery
     */
    public function videoHistoryGet():object
    {
        return Video::find()->alias('v')->innerJoin("(SELECT video_id, MAX(created_at) as max_date FROM video_view WHERE user_id = :userId GROUP BY video_id) vv", 'vv.video_id = v.video_id',[
            'userId' => \Yii::$app->user->id
        ])->orderBy("vv.max_date DESC");
    }

    /**
     * @return \common\models\query\VideoQuery
     */
    public function videoSearchGet():object
    {
        return Video::find()->published()->last();
    }
}