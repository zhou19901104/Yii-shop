<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductAttributeCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Product Attribute Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-attribute-category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create Product Attribute Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'status',
                'value' => 'statusLabel',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>

</div>
