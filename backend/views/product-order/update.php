<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductOrder */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('app', 'Product Order'),
]) . ' ' . $model->user->username . ' #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->username . ' #' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-order-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
