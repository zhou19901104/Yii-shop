<?php

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

$this->title = '修改产品分类';
?>

<?= $this->render('_form', ['model' => $model]) ?>