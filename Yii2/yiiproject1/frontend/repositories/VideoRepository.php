<?php


namespace frontend\repositories;


use common\models\Video;
use yii\web\NotFoundHttpException;

class VideoRepository
{
    public function findVideo($id){

        $video = Video::findOne($id);
        return $video;
    }


}