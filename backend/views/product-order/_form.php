<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\ProductOrder;

/* @var $this yii\web\View */
/* @var $model common\models\ProductOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-order-form">

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
]); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
	
	<style>
		.controls.readonly
		{
			padding-top: 7px;
		}
	</style>

	<div class="form-group">
		<label class="control-label col-sm-3"><?= Yii::t('app', 'Paid Time') ?></label>
		<div class="col-sm-6">
			<div class="controls readonly">
                <?= $model->paid_time ? Yii::$app->formatter->asDatetime($model->paid_time) : ''; ?>
			</div>
		</div>
	</div>

    <?= $form->field($model, 'total_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(ProductOrder::getStatusLabels()) ?>

    <?= $form->field($model, 'payment')->dropDownList(ProductOrder::$paymentList) ?>

    <?= $form->field($model, 'shipment')->dropDownList(ProductOrder::$shipmentList) ?>

	<div class="form-group">
		<label class="control-label col-sm-3"><?= Yii::t('app', 'Out Order No') ?></label>
		<div class="col-sm-6">
			<div class="controls readonly">
                <?= $model->out_order_no; ?>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-sm-3"><?= Yii::t('app', 'Charge Id') ?></label>
		<div class="col-sm-6">
			<div class="controls readonly">
                <?= $model->charge_id; ?>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-6 col-sm-offset-3">
        	<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
        </div>
	</div>

    <?php ActiveForm::end(); ?>

</div>
