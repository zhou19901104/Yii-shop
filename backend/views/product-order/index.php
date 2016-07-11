<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ProductOrder;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Product Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-order-index">
    <style type='text/css'>
        .product-order-grid-view {
            overflow: auto;
            overflow-y: hidden;
        }
    </style>
    <div class='product-order-grid-view'>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                [
                    'attribute' => 'user_id',
                    'value' => 'user.username',
                    'filter' => false,
                ],
                'address',
                [
                    'attribute' => 'paid_time',
                    'value' => function($model) {
                        return $model->paid_time ? Yii::$app->formatter->asDatetime($model->paid_time) : '';
                    },
                    'filter' => false,
                ],
                'total_price',
                'contact',
                [
                    'attribute' => 'updated_at',
                    'format' => 'datetime',
                    'filter' => false,
                ],
                [
                    'attribute' => 'status',
                    'value' => 'statusLabel',
                    'filter' => false,
                    'filter' => Html::activeDropDownList($searchModel, 'status', ProductOrder::getStatusLabels(), ['class' => 'form-control', 'prompt' => '请选择']),
                ],
                [
                    'attribute' => 'payment',
                    'value' => 'paymentLabel',
                    'filter' => false,
                    'filter' => Html::activeDropDownList($searchModel, 'payment', ProductOrder::$paymentList, ['class' => 'form-control', 'prompt' => '请选择']),
                ],
                [
                    'attribute' => 'shipment',
                    'value' => 'shipmentLabel',
                    'filter' => Html::activeDropDownList($searchModel, 'shipment', ProductOrder::$shipmentList, ['class' => 'form-control','prompt' => '请选择']),
                ],
                'out_order_no',
                'charge_id',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
