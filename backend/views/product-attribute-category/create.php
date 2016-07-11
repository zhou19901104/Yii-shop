<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductAttributeCategory */

$this->title = Yii::t('app', 'Create Product Attribute Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Attribute Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-attribute-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
