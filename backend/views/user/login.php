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
        <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
            <div class="container aside-xl">
                <a class="navbar-brand block" href="<?= Url::to('/') ?>">传智播客-商城系统-后台</a>
                <section class="m-b-lg">
                    <header class="wrapper text-center">
                        <strong>登入后台</strong>
                    </header>
                    <?= Html::errorSummary($adminUserLoginForm, ['class' => 'alert alert-danger']) ?>
                    <?php $form = ActiveForm::begin(['enableClientValidation'=>false, 'options' => ['class' => 'panel-body']]) ?>
                        <div class="list-group">
                            <div class="list-group-item">
                                <?= Html::activeInput('email', $adminUserLoginForm, 'email', ['placeholder' => 'test@example.com', 'class' => 'form-control no-border']) ?>
                            </div>
                            <div class="list-group-item">
                                <?= Html::activeInput('password', $adminUserLoginForm, 'password', ['placeholder' => '请输入密码', 'class' => 'form-control no-border']) ?>
                            </div>
                            <div class="list-group-item">
                                <?= $form->field($adminUserLoginForm, 'captcha', ['options' => ['class' => '']])->widget(Captcha::className(), [
                                    'captchaAction' => ['user/captcha'],
                                ]) ?>
                            </div>
                            <div class="list-group-item">
                                <label class="checkbox-inline i-checks">
                                    <?= Html::activeInput('checkbox', $adminUserLoginForm, 'rememberMe', ['checked' => $adminUserLoginForm->rememberMe ? 'checked' : '']) ?><i></i> 这是私人电脑
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary btn-block">登录</button>
                        <div class="text-center m-t m-b">
                            <a href="javascript:" class="pull-right m-t-xs" data-toggle="tooltip" data-placement="top" title="请联系系统管理员"><small>忘记密码?</small></a>
                        </div>
                    <?php ActiveForm::end() ?>
                </section>
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
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>