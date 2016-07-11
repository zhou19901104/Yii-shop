<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Product;
use common\models\ProductCategory;
use common\models\ProductAttributeCategory;
use common\models\ProductAttribute;
use yii\jui\DatePicker;
use trntv\filekit\widget\Upload;
use kucha\ueditor\UEditor;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('app', 'Product Attributes'),
]) . ' ' . $model->product->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product->name . ': ' . Yii::t('app', 'Product Attributes'), 'url' => ['view', 'id' => $model->product->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?php $form = ActiveForm::begin(); ?>
    <?php if ($productAttributeCategory = ProductAttributeCategory::softFind()->andWhere(['id' => $categoryId])->one()): ?>
    <?php elseif ($model->product->attributeCategory): ?>
        <?php $productAttributeCategory = $model->product->attributeCategory; ?>
    <?php else: ?>
        <?php $productAttributeCategory = ProductAttributeCategory::softFind()->one(); ?>
    <?php endif; ?>
    <?php $assignmentProductIdMap = $model->product->attributeAssignmentsAttributeIdMap; ?>
    <div class="col-md-12 update-attributes">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td width="10%" colspan="5">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-1">
                                <style>
								   .checkbox {
										position: relative;
										display: block;
										margin-top: 5px;
										margin-bottom: 5px;
									} 
                                </style>
<?php
$js = <<<'JS'
$(document).on('click', '#lock-attribute-category', function() {
   $('#product-attribute-category').prop('disabled', $(this).is(':checked')).trigger("chosen:updated"); 
});
JS;
$this->registerJs($js);
?>
                                <div class="checkbox i-checks">
                                    <label>
                                        <input id='lock-attribute-category' type="checkbox" checked><i></i> 锁定/编辑
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <?= Html::dropDownList('product-attribute-category', $categoryId ? $categoryId : $productAttributeCategory->id, ArrayHelper::map(ProductAttributeCategory::getList(), 'id', 'name'), ['class' => 'chosen-select', 'id' => 'product-attribute-category', 'disabled' => true]) ?>
                            </div>
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody class="container">
                <?php foreach($productAttributeCategory->subAttributes as $index => $productAttribute): ?>
                    <?php if(isset($assignmentProductIdMap[$productAttribute->id]) && $assignmentProductIdMap[$productAttribute->id]): ?>
                        <?php $initialIndex = $index * 100; ?>
                        <?php $startIndex = $initialIndex + count($assignmentProductIdMap[$productAttribute->id]) ?>
                        <?php foreach($assignmentProductIdMap[$productAttribute->id] as $innerIndex => $assignmentProductIdMapItem): ?>
                            <?php $elementIndex = $initialIndex + $innerIndex; ?>
                            <tr class="row" <?php if ($innerIndex == 0): ?> data-index-initial="<?= $initialIndex?>" data-index-start="<?= $startIndex; ?>" <?php endif; ?>>
                                <td width="20%">
                                    <?= $productAttribute->name ?>
                                    <?= Html::hiddenInput($model->formName() . '[attribute_assignments][' . $elementIndex . '][attribute_id]', $productAttribute->id) ?>
                                </td>
                                <td width="30%">
                                    <?php if ($productAttribute->isMultiple): ?>
                                        <?= Html::dropDownList($model->formName() . '[attribute_assignments][' . $elementIndex . '][attribute_option]', ArrayHelper::getValue($assignmentProductIdMapItem, 'attribute_option'), $productAttribute->optoinIdNames) ?>
                                    <?php else: ?>
                                        <?= Html::input('text', $model->formName() . '[attribute_assignments][' . $elementIndex . '][attribute_option]', ArrayHelper::getValue($assignmentProductIdMapItem, 'attribute_option')) ?>
                                    <?php endif; ?>
                                </td>
                                <td width="40%">
                                    <?= Html::input('number', $model->formName() . '[attribute_assignments][' . $elementIndex . '][price]', ArrayHelper::getValue($assignmentProductIdMapItem, 'price'), ['disabled' => !$productAttribute->isMultiple]) ?>
                                </td>
                                <td width="10%">
                                    <?php if ($productAttribute->isMultiple): ?>
                                        <?php if ($innerIndex == 0): ?>
                                            <span class="add btn btn-info">加新</span>
                                        <?php else: ?>
                                            <span class="delete btn btn-danger">删除</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="row" data-index-initial="<?= $index * 100?>" data-index-start="<?= $index * 100; ?>">
                            <td width="20%">
                                <?= $productAttribute->name ?>
                                <?= Html::hiddenInput($model->formName() . '[attribute_assignments][' . $index * 100 . '][attribute_id]', $productAttribute->id) ?>
                            </td>
                            <td width="30%">
                                <?php if ($productAttribute->isMultiple): ?>
                                    <?= Html::dropDownList($model->formName() . '[attribute_assignments][' . $index * 100 . '][attribute_option]', null, $productAttribute->optoinIdNames) ?>
                                <?php else: ?>
                                    <?= Html::input('text', $model->formName() . '[attribute_assignments][' . $index * 100 . '][attribute_option]', null) ?>
                                <?php endif; ?>
                            </td>
                            <td width="40%">
                                <?= Html::input('number', $model->formName() . '[attribute_assignments][' . $index * 100 . '][price]', 0, ['disabled' => !$productAttribute->isMultiple]) ?>
                            </td>
                            <td width="10%">
                                <?php if ($productAttribute->isMultiple): ?>
                                    <span class="add btn btn-info">加新</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary btn-block']) ?>
    </div>
<?php ActiveForm::end(); ?>

<div id='page-parameters' data-product-id="<?= $model->product->id ?>" data-form-name="<?= $model->formName() ?>"></div>

<?php
$js = <<<'JS'
var $pageParameters = $('#page-parameters');
uiLoad.load(jp_config['chosen']).then(function() {
    $("#product-attribute-category").chosen({
        allow_single_deselect: false,
        no_results_text: '没有记录匹配',
        placeholder_text_single: '请选择一个分类(不选择即表示顶级分类)',
        width: "95%"
    }).change(function(e) {
        window.location.href = window.location.protocol + '//' + window.location.host + '/product/update-attributes?id=' + $pageParameters.data('product-id') + '&categoryId=' + $(e.target).val();
    });
});

$(document).on('click', '.update-attributes .add', function(e) {
    var $tr = $(e.target).parent().parent();
    var initialIndex = $tr.data('index-initial');
    var currentIndex = $tr.data('index-start') + 1;
    $tr.data('index-start', currentIndex);
    
    var $newTr = $tr.clone();
    $newTr.find('.add').removeClass('add').addClass('delete').removeClass('btn-info').addClass('btn-danger').text('删除');
    // 改name里的索引
    $newTr.find('[name^="ProductAttributesEditForm"]').each(function(idx, elem) {
        $(elem).attr('name', $(elem).attr('name').replace("[" + initialIndex + "]", "[" + currentIndex + "]"))
    });
    
    $newTr.insertAfter($tr);
})
.on('click', '.update-attributes .delete', function(e) {
    $(e.target).parent().parent().remove();
});
JS;
$this->registerJs($js);
?>
