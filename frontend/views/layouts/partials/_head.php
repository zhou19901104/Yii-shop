<?php
use yii\helpers\Html;
?>
<head>
    <meta charset="<?= Yii::$app->charset ?>" >
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <?= $this->head() ?>
</head>
