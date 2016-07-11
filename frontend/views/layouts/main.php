<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= Yii::$app->charset ?>">
<?= $this->render('partials/_head') ?>
<body>
    <?php $this->beginBody() ?>
    <?= $this->render('partials/_topNav') ?>
    
    <?= $content ?> 
    
    <?= $this->render('partials/_footerCopyright') ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
