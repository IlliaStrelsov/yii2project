<?php
/** @var $channel \common\models\User */
/**@var $viewModel */
?>


<div class="jumbotron">
    <h1 class="display-4"><?php echo $viewModel->channel->username ?></h1>
    <hr class="my-4">
    <?php \yii\widgets\Pjax::begin() ?>
    <?php echo $this->render('_subscribe', [
        'viewModel' => $viewModel
    ]) ?>
    <?php \yii\widgets\Pjax::end() ?>
</div>