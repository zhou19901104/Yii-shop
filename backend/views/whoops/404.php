<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

AppAsset::register($this);

$this->context->layout = false;
$this->title = '传智播客-商城系统-登录';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="bg-dark">
    <head>
        <meta charset="<?= Yii::$app->charset ?>" />
        <title><?= $this->title ?></title>
        <meta name="description" content="<?= $this->title ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <?= Html::csrfMetaTags() ?>
        <?= $this->head() ?>
    </head>
    <body class="">
    <?php $this->beginBody() ?>
        <section id="content">
            <div class="row m-n">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="text-center m-b-lg">
                        <h1 class="h text-white animated fadeInDownBig">404</h1>
                    </div>
                    <div class="list-group bg-info auto m-b-sm m-b-lg">
                        <a href="<?= Yii::$app->homeUrl ?>" class="list-group-item">
                        <i class="fa fa-chevron-right icon-muted"></i>
                        <i class="fa fa-fw fa-home icon-muted"></i> 回首页
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- footer -->
        <footer id="footer">
            <div class="text-center padder">
                <p>
                    <small>传智播客<br /> &copy; <?= date('Y') ?></small>
                </p>
            </div>
        </footer>
        <!-- / footer -->
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>