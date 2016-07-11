<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'paid_time') ?>

    <?= $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'contact') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'payment') ?>

    <?php // echo $form->field($model, 'shipment') ?>

    <?php // echo $form->field($model, 'out_order_no') ?>

    <?php // echo $form->field($model, 'charge_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
