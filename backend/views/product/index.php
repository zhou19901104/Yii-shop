<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <style type='text/css'>
        .product-category-grid-view {
            overflow: auto;
            overflow-y: hidden;
        }
    </style>
    <div class="col-md-12 product-category-grid-view">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
    
                'id',
                [
                    'attribute' => 'category_id',
                    'value' => 'category.name',
                ],
                'name',
                'inventory',
                [
                    'attribute' => 'logo',
                    'format' => ['image', ['width' => '50px']],
                    'value' => 'logoAccessUrl',
                    'filter' => false,
                ],
                [
                    'attribute' => 'our_price',
                    'filter' => false,
                ],
                [
                    'attribute' => 'market_price',
                    'filter' => false,
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {update-attributes} {delete}',
                    'buttons' => [
                        'update-attributes' => function ($url, $model, $key) {
                            $options = array_merge([
                                'title' => Yii::t('app', 'Update'),
                                'aria-label' => Yii::t('app', 'Update'),
                                'data-pjax' => '0',
                            ], []);
                            return Html::a('<span class="fa fa-pencil-square"></span>', $url);
                        },
                    ],
                ],
                [
                    'attribute' => 'promotion_price',
                    'filter' => false,
                ],
                [
                    'attribute' => 'promotion_start_time',
                    'value' => function($model) {
                        return $model->promotion_start_time ? Yii::$app->formatter->asDatetime($model->promotion_start_time) : '';
                    },
                ],
                [
                    'attribute' => 'promotion_end_time',
                    'value' => function($model) {
                        return $model->promotion_end_time ? Yii::$app->formatter->asDatetime($model->promotion_end_time) : '';
                    },
                ],
                [
                    'attribute' => 'is_new',
                    'value' => 'isNewLabel',
                ],
                [
                    'attribute' => 'is_hot',
                    'value' => 'isHotLabel',
                ],
                [
                    'attribute' => 'is_best',
                    'value' => 'isBestLabel',
                ],
                [
                    'attribute' => 'display_order',
                    'filter' => false,
                ],
                'score',
                [
                    'attribute' => 'status',
                    'value' => 'statusLabel',
                ],
            ],
        ]); ?>
    </div>

</div>
