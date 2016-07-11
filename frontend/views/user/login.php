<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

$this->registerCssFile('/style/login.css', ['depends' => ['frontend\assets\AppAsset']]);

$this->title = '用户登录';
?>
<?= $this->render('/layouts/partials/_bodyHead') ?>
<!-- 登录主体部分start -->
<div class="login w990 bc mt10">
    <div class="login_hd">
        <h2>用户登录</h2>
        <b></b>
    </div>
    <div class='error'>
        <?= Html::errorSummary($model) ?>
    </div>
    <div class="login_bd">
        <div class="login_form fl">
            <?php $form = ActiveForm::begin([
                'method' => 'post',
            ]) ?>
                <ul>
                    <li>
                        <?= Html::activeLabel($model, 'email') ?>
                        <?= Html::activeInput('email', $model, 'email', ['class' => 'txt']) ?>
                    </li>
                    <li>
                        <?= Html::activeLabel($model, 'password') ?>
                        <?= Html::activeInput('password', $model, 'password', ['class' => 'txt']) ?>
                        <a href="">忘记密码?</a>
                    </li>
                    <li class="checkcode">
                        <label for="">验证码：</label>
                        <?= Captcha::widget([
                            'model' => $model,
                            'attribute' => 'captcha',
                            'template' => '{image} {input}',
                            'captchaAction' => 'user/captcha',
                            'options' => [
                                'id' => 'captcha',
                            ],
                        ]) ?>
                        <span>看不清？<a href="javascript:" id='refresh-captcha'>换一张</a></span>
                    </li>
                    <li>
                        <label for="">&nbsp;</label>
                        <?= Html::activeInput('checkbox', $model, 'rememberMe', ['class' => 'chb']) ?>
                        保存登录信息
                    </li>
                    <li>
                        <label for="">&nbsp;</label>
                        <input type="submit" value="" class="login_btn" />
                    </li>
                </ul>
            <?php ActiveForm::end() ?>

            <div class="coagent mt15">
                <dl>
                    <dt>使用合作网站登录商城：</dt>
                    <dd class="qq"><a href=""><span></span>QQ</a></dd>
                    <dd class="weibo"><a href=""><span></span>新浪微博</a></dd>
                    <dd class="yi"><a href=""><span></span>网易</a></dd>
                    <dd class="renren"><a href=""><span></span>人人</a></dd>
                    <dd class="qihu"><a href=""><span></span>奇虎360</a></dd>
                    <dd class=""><a href=""><span></span>百度</a></dd>
                    <dd class="douban"><a href=""><span></span>豆瓣</a></dd>
                </dl>
            </div>
        </div>
        
        <div class="guide fl">
            <h3>还不是商城用户</h3>
            <p>现在免费注册成为商城用户，便能立刻享受便宜又放心的购物乐趣，心动不如行动，赶紧加入吧!</p>

            <a href="<?= Url::to('register') ?>" class="reg_btn">免费注册 >></a>
        </div>

    </div>
</div>
<!-- 登录主体部分end -->
<?php
$js = <<<'JS'
    $(document).on('click', '#refresh-captcha', function() {
        $('#captcha-image').trigger('click');
    });
JS;
$this->registerJs($js);
?>
