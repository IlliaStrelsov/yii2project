<?php

namespace frontend\services;

use common\models\Video;
use common\models\VideoLike;
use common\models\VideoView;
use yii\base\BaseObject;
use yii\db\Exception;

class VideoService
{
    public function like(){

    }

    public function saveLikeDislike($videoId,$userId,$type):void
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

    public function likeDislikeSave($id,$userId,$type):void
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

    public function videoViewSave($id):void
    {
        $videoView = new VideoView();
        $videoView->video_id = $id;
        $videoView->user_id = \Yii::$app->user->id;
        $videoView->created_at = time();
        $videoView->save();
    }

    public function videoSimilarGet($id,$video){

        return Video::find()->published()->andWhere(['NOT',['video_id'=>$id]])->byKeyword($video->title)->limit(11)->all();
    }

    public function videoHistoryGet(){
        return Video::find()->alias('v')->innerJoin("(SELECT video_id, MAX(created_at) as max_date FROM video_view WHERE user_id = :userId GROUP BY video_id) vv", 'vv.video_id = v.video_id',[
            'userId' => \Yii::$app->user->id
        ])->orderBy("vv.max_date DESC");
    }

    public function videoSearchGet(){
        return Video::find()->published()->last();
    }
}