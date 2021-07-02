<?php


namespace frontend\modelviews;


use common\models\Video;
use Yii;
use yii\helpers\Url;

/**
 * Class VideoModelView
 * @package frontend\modelviews
 */
class VideoModelView
{
    /**
     * @var Video
     */
    public $video;

    /**
     * VideoModelView constructor.
     * @param Video $video
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * @return Video
     */
    public function getVideo():Video
    {
        return $this->video;
    }

    /**
     * @param $path
     * @param $model
     * @return string
     */
    public function urlTo($path,$model)
    {
        return Url::to([$path,'id'=>$model->video_id]);
    }

    /**
     * @return array|\common\models\VideoLike|null
     */
    public function isLiked(){
        return $this->video->isLikedBy(Yii::$app->user->id);
    }

    /**
     * @return array|\common\models\VideoLike|null
     */
    public function isDisliked(){
        return $this->video->isDislikedBy(Yii::$app->user->id);
    }

    /**
     * @return mixed
     */
    public function getLikesCount()
    {
        return $this->video->getLikes()->count();
    }

    /**
     * @return mixed
     */
    public function getDislikesCount()
    {
        return $this->video->getDislikes()->count();
    }


}