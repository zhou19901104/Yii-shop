<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductAttributeCategory */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('app', 'Product Attribute Category'),
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Attribute Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-attribute-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
