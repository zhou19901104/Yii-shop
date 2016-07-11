<?php

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');

$this->title = '添加产品分类';
?>

<?= $this->render('_form', ['model' => $model]) ?>