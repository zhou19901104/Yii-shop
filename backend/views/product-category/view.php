<?php

use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->title = '查看产品分类-' . $model->name;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'View');
?>
<div class="row">
    <div class="col-md-12">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                [
                    'attribute' => 'parent_id',
                    'value' => ArrayHelper::getValue($model->parent, 'name'),
                ],
                'slug',
                'icon_class',
                'display_order',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
    <div class="col-md-12">
        <a class="btn btn-info pull-right" href="<?= Url::to(['product-category/update', 'id' => $model->id]) ?>">修改分类</a>
    </div>
</div>
