<?php


namespace frontend\repositories;


use common\models\Video;
use yii\web\NotFoundHttpException;

/**
 * Class VideoRepository
 * @package frontend\repositories
 */
final class VideoRepository
{

    /**
     * @param $id
     * @return Video|null
     */
    public function findVideo(string $id):Video
    {

        return Video::findOne($id);
    }


}