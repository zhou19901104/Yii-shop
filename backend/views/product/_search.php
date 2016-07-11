<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'inventory') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'our_price') ?>

    <?php // echo $form->field($model, 'market_price') ?>

    <?php // echo $form->field($model, 'promotion_price') ?>

    <?php // echo $form->field($model, 'promotion_start_time') ?>

    <?php // echo $form->field($model, 'promotion_end_time') ?>

    <?php // echo $form->field($model, 'is_new') ?>

    <?php // echo $form->field($model, 'is_hot') ?>

    <?php // echo $form->field($model, 'is_best') ?>

    <?php // echo $form->field($model, 'display_order') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
