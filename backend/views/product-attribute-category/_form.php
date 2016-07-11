<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\ProductAttributeCategory;

/* @var $this yii\web\View */
/* @var $model common\models\ProductAttributeCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-attribute-category-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(ProductAttributeCategory::getStatusLabels()) ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-block btn-success' : 'btn btn-block btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
