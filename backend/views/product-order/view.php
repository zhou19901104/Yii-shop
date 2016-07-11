<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ProductOrder */

$this->title = $model->user->username . ' #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-order-view">

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
                'attribute' => 'user_id',
                'value' => ArrayHelper::getValue($model, 'user.username'),
            ],
            'address',
            [
                'attribute' => 'paid_time',
                'value' => $model->paid_time ? Yii::$app->formatter->asDatetime($model->paid_time) : '',
            ],
            'total_price',
            'contact',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'status',
                'value' => ArrayHelper::getValue($model, 'statusLabel'),
            ],
            [
                'attribute' => 'payment',
                'value' => ArrayHelper::getValue($model, 'paymentLabel'),
            ],
            [
                'attribute' => 'shipment',
                'value' => ArrayHelper::getValue($model, 'shipmentLabel'),
            ],
            'out_order_no',
            'charge_id',
        ],
    ]) ?>

</div>
