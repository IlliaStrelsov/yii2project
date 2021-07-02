<?php
/** @var $channel */
/** @var $user */

use yii\helpers\Url;

?>

<p>Hello <?php echo $channel->username ?></p>
<p>user <?php echo \yii\helpers\Html::a($user->username,Url::to(['/channel/view', 'username' =>$user->username],true),['class'=>'text-dark']); ?> has subscribed to you</p>


<p>YouTubeClone</p>