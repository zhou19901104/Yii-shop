<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\components\ActiveRecord;
use common\models\ProductAttribute;
use common\models\ProductAttributeCategory;

/* @var $this yii\web\View */
/* @var $model common\models\ProductAttribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-attribute-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(ProductAttributeCategory::getList(), 'id', 'name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(ProductAttribute::getTypeLabels()) ?>

    <?= $form->field($model, 'option')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(ActiveRecord::getStatusLabels()) ?>
    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-block btn-success' : 'btn btn-block btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<<'JS'
uiLoad.load(jp_config["bootstrap-tokenfield"]).then(function() {
    $('#productattribute-option').tokenfield({
        typeahead: [null]
    });
});
JS;
$this->registerJs($js);
?>