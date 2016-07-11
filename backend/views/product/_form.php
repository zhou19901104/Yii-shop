<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\Product;
use common\models\ProductCategory;
use common\models\ProductAttributeCategory;
use common\models\ProductAttribute;
use yii\jui\DatePicker;
use trntv\filekit\widget\Upload;
use xj\ueditor\Ueditor;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
    ]); ?>
    <section class="panel panel-default">
        <header class="panel-heading bg-light">
            <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#basic" data-toggle="tab" aria-expanded="true"><i class="fa fa-comments text-muted"></i> 基本信息</a></li>
            <li class=""><a href="#description" data-toggle="tab" aria-expanded="false"><i class="fa fa-user text-muted"></i> 描述</a></li>
            <li class=""><a href="#picture" data-toggle="tab" aria-expanded="false"><i class="fa fa-cog text-muted"></i> 图片</a></li>
            </ul>
            <span class="hidden-sm"><?= $this->title ?></span>
        </header>
        <div class="panel-body">
            <div class="tab-content">              
            <div class="tab-pane active" id="basic">
                <?= $form->field($model, 'category_id')->dropDownList(ProductCategory::getTreeIdNameList(), ['class' => ['class' => 'chosen-select form-control']]) ?>
            
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'inventory')->input('number') ?>
            
                <?= $form->field($model, 'logo')->widget(
                    Upload::className(),
                    [
                        'url' => ['upload'],
                        'sortable' => true,
                        'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
                        'maxNumberOfFiles' => 1,
                        'clientOptions' => [],
                    ]
                ) ?>
            
                <?= $form->field($model, 'our_price')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'market_price')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'promotion_price')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'promotion_start_time')->widget(DatePicker::classname(), [
                    'dateFormat' => 'yyyy-MM-dd',
                ])  ?>
            
                <?= $form->field($model, 'promotion_end_time')->widget(DatePicker::classname(), [
                    'dateFormat' => 'yyyy-MM-dd',
                ])  ?>
            
                <?= $form->field($model, 'is_new')->dropDownList(Product::getIsNewLabels()) ?>
            
                <?= $form->field($model, 'is_hot')->dropDownList(Product::getIsHotLabels()) ?>
            
                <?= $form->field($model, 'is_best')->dropDownList(Product::getIsBestLabels()) ?>
            
                <?= $form->field($model, 'score')->textInput() ?>
            
                <?= $form->field($model, 'status')->dropDownList(Product::getStatusLabels()) ?>
            
                <?= $form->field($model, 'display_order')->textInput() ?>
            </div>
            <div class="tab-pane" id="description">
                <?= $form->field($model, 'description')->widget(Ueditor::className(), [
                    'style' => 'width:100%;height:400px',
                    'renderTag' => true,
                    'readyEvent' => 'console.log("example2 ready")',
                    'jsOptions' => [
                        'serverUrl' => Url::to(['ueditor-upload']),
                        'autoHeightEnable' => true,
                        'autoFloatEnable' => true
                    ],
                ]) ?>
            </div>
            <div class="tab-pane" id="picture">
                <style type='text/css'>
                    .upload-kit .upload-kit-item {
                        height: 50px;
                        border: none;
                        border-radius: 0;
                    }
                    
                    .upload-kit .upload-kit-item.image > img {
                        border-radius: 0;
                    }
                    
                    
                    .upload-kit .upload-kit-input {
                        height: 50px;
                        width: 50px;
                    }
                    
                    .upload-kit .upload-kit-item .remove {
                        font-size: 2em;
                        top: 35%;
                        left: 60%;
                        width: 40px;
                        height: 40px;
                        line-height: 33px;
                        background-color: rgba(73, 112, 255, 0.8);
                    }
                </style>
                <?= $form->field($model, 'pictures')->widget(
                    Upload::className(),
                    [
                        'url' => ['upload'],
                        'sortable' => true,
                        'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
                        'maxNumberOfFiles' => 10,
                        'clientOptions' => [],
                    ]
                ) ?>
            </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-3">
                <?= Html::submitButton($model->product->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->product->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </section>
    <?php ActiveForm::end(); ?>
</div>
