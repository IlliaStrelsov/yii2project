<?php
/** @var $model \common\models\Video */
/** @var $similarVideos */
/**  @var $viewModel  */
?>

<div class="row">
    <div class="col-sm-8">
        <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item" controls poster="<?php use yii\helpers\Html;
            use yii\helpers\Url;

            echo $viewModel->video->getThumbnailLink() ?>" src="<?php echo $viewModel->video->getVideoLink() ?> " ></video>
        </div>
        <h5 class="mt-3"><?php echo $viewModel->video->title ?></h5>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <?php echo $viewModel->video->getViews()->count() ?> views • <?php echo Yii::$app->formatter->asDate($viewModel->video->created_at) ?>
            </div>
        </div>
        <div>
            <?php \yii\widgets\Pjax::begin() ?>
                <?php echo $this->render('_buttons',[
                        'viewModel'=>$viewModel
            ])?>
            <?php \yii\widgets\Pjax::end() ?>
        </div>
    </div>

    <div class="col-sm-4">
        <?php foreach ($similarVideos as $similarVideo):?>
            <div class="media">
                <a href="<?php echo Url::to(['/video/view', 'id' => $similarVideo->video_id]) ?>">
                    <div class="embed-responsive embed-responsive-16by9 mr-2" style="width: 200px">
                        <video class="embed-responsive-item"  poster="<?php echo $similarVideo->getThumbnailLink() ?>" src="<?php echo $viewModel->video->getVideoLink() ?> " ></video>
                    </div>
                </a>
                <div class="media-body">
                    <h6 class="m-0"><?php echo $similarVideo->title ?></h6>
                    <div class="text-muted">
                        <p class="m-0">
                            <?php echo Html::a($similarVideo->createdBy->username,[
                                'channel/view','username' => $similarVideo->createdBy->username
                            ]) ?>                        </p>
                        <small> <?php echo $similarVideo->getViews()->count() ?> views • <?php echo Yii::$app->formatter->asDate($similarVideo->created_at) ?></small>
                    </div>
                </div>
            </div>

        <?php endforeach;?>
    </div>
</div>
<div class="mt-3">
    <p><?php echo Html::a($viewModel->video->createdBy->username,[
        'channel/view','username' => $viewModel->video->createdBy->username
        ]) ?></p>
    <?php echo Html::encode($viewModel->video->description )?>
</div>