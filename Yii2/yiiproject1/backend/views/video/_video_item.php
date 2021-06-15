<?php
use yii\helpers\Url;
?>

<div class="media">
    <a href="<?php echo  Url::to(['/video/update', 'id' => $model->video_id]) ?>">
        <div class="embed-responsive embed-responsive-16by9 mr-2">

            <video class="embed-responsive-item" poster="<?php echo $model->getThumbnailLink() ?>" style="width:120px" src="<?php echo $model->getVideoLink() ?>" ></video>
        </div>
    </a>
    <div class="media-body">
        <h6 class="mt-0"><?php echo $model->title ?></h6>
        <?php \yii\helpers\StringHelper::truncateWords($model->description,10) ?>
    </div>
</div>
