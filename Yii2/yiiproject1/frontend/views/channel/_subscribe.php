<?php
/** @var $channel \common\models\User*/
/** @var $viewModel */
?>

<a class="btn <?php echo $viewModel->isSubscribedUser(Yii::$app->user->id) ? 'btn-secondary' : 'btn-danger' ?>" href="<?php echo $viewModel->urlTo() ?>" data-method="post" data-pjax="1">
    Subscribe <i class="fas fa-bell"></i>
</a> <?php echo $viewModel->countSubscribers() ?>
