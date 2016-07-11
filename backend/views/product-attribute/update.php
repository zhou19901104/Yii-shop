<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductAttribute */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('app', 'Product Attribute'),
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-attribute-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
