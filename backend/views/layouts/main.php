<?php
use yii\helpers\Html;
use backend\assets\AppAsset;

AppAsset::register($this);

$this->context->layout = false;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="app">
    <head>
        <meta charset="<?= Yii::$app->charset ?>" />
        <title><?= $this->title ?></title>
        <meta name="description" content="<?= $this->title ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <?= Html::csrfMetaTags() ?>
        <?= $this->head() ?>
    </head>
    <body class="container">
        <?php $this->beginBody() ?>
        <section class="vbox">
            <!-- .header -->
                <?= $this->render('_partials/_header') ?>
            <!-- /.header -->
            <section>
                <section class="hbox stretch">
                    <!-- .aside -->
                        <?= $this->render('_partials/_aside') ?>
                    <!-- /.aside -->
                    <section id="content">
                        <section class="vbox">
                            <section class="scrollable wrapper">
                                <?= $this->render('_partials/_breadcrumbs') ?>
                                <div class="m-b-md">
                                    <h3 class="m-b-none">
                                        <i class="i i-arrow-left3"></i>
                                        <?= $this->title ?>
                                    </h3>
                                </div>
                                <?= $content ?>
                            </section>
                        </section>
                        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
                    </section>
                </section>
            </section>
        </section>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>