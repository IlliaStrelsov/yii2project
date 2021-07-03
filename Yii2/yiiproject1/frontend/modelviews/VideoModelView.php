<?php


namespace frontend\modelviews;


use common\models\Video;
use common\models\VideoLike;
use Yii;
use yii\helpers\Url;

/**
 * Class VideoModelView
 * @package frontend\modelviews
 */
final class VideoModelView
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
    public function urlTo(string $path,Video $model)
    {
        return Url::to([$path,'id'=>$model->video_id]);
    }

    /**
     * @return array|\common\models\VideoLike|null
     */
    public function isLiked($user)
    {
        return $this->video->isLikedBy($user);
    }

    /**
     * @return array|\common\models\VideoLike|null
     */
    public function isDisliked($user)
    {
        return $this->video->isDislikedBy($user);
    }

    /**
     * @return mixed
     */
    public function getLikesCount():int
    {
        return $this->video->getLikes()->count();
    }

    /**
     * @return mixed
     */
    public function getDislikesCount():int
    {
        return $this->video->getDislikes()->count();
    }


}