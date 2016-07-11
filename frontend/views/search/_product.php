<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<li>
    <dl>
        <dt><a href="<?= Url::to(['product/view', 'id' => $model->id]) ?>"><img src="<?= $model->logoAccessUrl ?>" alt="" /></a></dt>
        <dd><a href=""><?= Html::encode($model->name) ?></a></dt>
        <dd><strong>￥<?= Html::encode($model->our_price) ?></strong></dt>
        <dd><a href="javascript:;"><em>已有<?= Html::encode($model->comment_count) ?>人评价</em></a></dt>
    </dl>
</li>
