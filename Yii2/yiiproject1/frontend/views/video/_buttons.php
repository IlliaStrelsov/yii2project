<?php


use frontend\modelviews\VideoModelView;
use yii\helpers\Url;


/** @var  $viewModel VideoModelView */
?>

<a href="<?php echo  $viewModel->urlTo('/video/like',$viewModel->getVideo())  ?>" class="btn btn-sm <?php echo $viewModel->isLiked() ? 'btn-outline-primary' : 'btn-outline-secondary' ?> " data-method="post" data-pjax="1">
    <i class="far fa-thumbs-up"></i> <?php echo $viewModel->getLikesCount() ?>
</a>

<a href="<?php echo $viewModel->urlTo('/video/dislike',$viewModel->getVideo()) ?>" class="btn btn-sm <?php echo $viewModel->isDisliked() ? 'btn-outline-primary' : 'btn-outline-secondary' ?> " data-method="post" data-pjax="1">
    <i class="far fa-thumbs-down"></i> <?php echo $viewModel->getDislikesCount() ?>
</a>


