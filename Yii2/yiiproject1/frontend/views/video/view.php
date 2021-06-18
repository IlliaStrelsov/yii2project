<?php
/** @var $model \common\models\Video */

?>

<div class="row">
    <div class="col-sm-8">
        <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item" controls poster="<?php use yii\helpers\Html;
            use yii\helpers\Url;

            echo $model->getThumbnailLink() ?>" src="<?php echo $model->getVideoLink() ?> " ></video>
        </div>
        <h5 class="mt-3"><?php echo $model->title ?></h5>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <?php echo $model->getViews()->count() ?> views • <?php echo Yii::$app->formatter->asDate($model->created_at) ?>
            </div>
        </div>
        <div>
            <?php \yii\widgets\Pjax::begin() ?>
                <?php echo $this->render('_buttons',[
                        'model'=>$model
            ])?>
            <?php \yii\widgets\Pjax::end() ?>
        </div>
    </div>

    <div class="col-sm-4">

    </div>
</div>
<div class="mt-3">
    <p><?php echo Html::a($model->createdBy->username,[
        'channel/view','username' => $model->createdBy->username
        ]) ?></p>
    <?php echo Html::encode($model->description )?>
</div>