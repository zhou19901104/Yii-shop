<?php
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\helpers\Url;
use nterms\pagesize\PageSize;
use mickgeek\actionbar\Widget as ActionBar;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'List');

$this->title = '产品分类';
?>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <?= PageSize::widget(['label' => '行/页']); ?>
            </div>
            <div class="col-md-6">
                <?= ActionBar::widget([
                    'grid' => 'w2',
                    'templates' => [
                        '{bulk-actions}' => ['class' => 'col-xs-4'],
                    ],
                    'bulkActionsItems' => [
                        '常规' => ['general-delete' => '删除'],
                    ],
                    'bulkActionsOptions' => [
                        'options' => [
                            'general-delete' => [
                                'url' => Url::toRoute('delete-multiple'),
                                'data-confirm' => '确定吗?',
                            ],
                        ],
                        'class' => 'form-control',
                    ],
                ]) ?>
            </div>
            <div class="col-md-3">
                <a class="btn btn-info pull-right btn-block" href="<?= Url::to(['product-category/create']) ?>"><i class="fa fa-plus"></i> <?= Yii::t('app', 'Create') ?></a>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <?= GridView::widget([
            'pager' => [
                'options' => [
                    'class' => 'pagination pull-right',
                ],
            ],
            'dataProvider' => $dataProvider,
            'filterSelector' => 'select[name="per-page"]',
            'filterModel' => $filterModel,
            'columns' => [
                [
                    'class' => CheckboxColumn::className(),
                ],
                'id',
                'name',
                'level',
                [
                    'label' => Yii::t('app', 'Product Category Parent'),
                    'attribute' => 'parent.name',
                ],
                'updated_at:datetime',
                [
                    'class' => ActionColumn::className(),
                    // you may configure additional properties here
                ],
            ],
        ]) ?>
    </div>
</div>
