<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => ArrayHelper::getValue($model, 'category.name'),
            ],
            'name',
            'inventory',
            'description:html',
            [
                'attribute' => 'logo',
                'format' => ['image', ['width' => '100px']],
                'value' => $model->logoAccessUrl,
            ],
            'our_price',
            'market_price',
            'promotion_price',
            [
                'attribute' => 'promotion_start_time',
                'value' => $model->promotion_start_time ? Yii::$app->formatter->asDatetime($model->promotion_start_time) : '',
            ],
            [
                'attribute' => 'promotion_end_time',
                'value' => $model->promotion_end_time ? Yii::$app->formatter->asDatetime($model->promotion_end_time) : '',
            ],
            [
                'attribute' => 'is_new',
                'value' => ArrayHelper::getValue($model, 'isNewLabel'),
            ],
            [
                'attribute' => 'is_hot',
                'value' => ArrayHelper::getValue($model, 'isHotLabel'),
            ],
            [
                'attribute' => 'is_best',
                'value' => ArrayHelper::getValue($model, 'isBestLabel'),
            ],
            'display_order',
            'score',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'status',
                'value' => $model->statusLabel,
            ],
        ],
    ]) ?>

</div>
