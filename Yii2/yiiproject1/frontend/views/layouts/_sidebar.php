<?php
?>
<aside class="shadow">
    <?php echo \yii\bootstrap4\Nav::widget([
    'options' => [
        'class' => 'd-flex flex-column'
    ],
    'items' => [
        [
            'label' => 'Home',
            'url' => ['/video/index']
        ],
        [
            'label' => 'History',
            'url' => ['/video/history']
        ]
    ]
]) ?>
</aside>
