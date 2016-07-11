<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;

$this->registerCssFile('style/login.css', ['depends' => ['frontend\assets\AppAsset']]);

$this->title = '用户注册';
?>
<?= $this->render('/layouts/partials/_bodyHead') ?>
<!-- 注册主体部分start -->
<div class="login w990 bc mt10 regist">
    <div class="login_hd">
        <h2>用户注册</h2>
        <b></b>
    </div>
    <div class="login_bd">
        <div class="error">
            <?= Html::errorSummary($model) ?>
        </div>
        <div class="login_form fl">
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'id' => 'register-form',
            ]) ?>
                <ul>
                    <li>
                        <?= Html::activeLabel($model, 'email') ?>
                        <?= Html::activeInput('text', $model, 'email', ['class' => 'txt']) ?>
                        <p>.com, .cn等主流邮箱</p>
                    </li>
                    <li>
                        <?= Html::activeLabel($model, 'username') ?>
                        <?= Html::activeInput('text', $model, 'username', ['class' => 'txt']) ?>
                        <p>3-20位字符，可由中文、字母、数字和下划线组成</p>
                    </li>
                    <li>
                        <?= Html::activeLabel($model, 'password') ?>
                        <?= Html::activeInput('password', $model, 'password', ['class' => 'txt']) ?>
                        <p>6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号</p>
                    </li>
                    <li>
                        <label for="">确认密码：</label>
                        <input type="password" class="txt" name="password_repeat" />
                        <p> <span>请再次输入密码</p>
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
                        <input type="checkbox" class="chb" checked="checked" /> 我已阅读并同意《用户注册协议》
                    </li>
                    <li>
                        <label for="">&nbsp;</label>
                        <input type="submit" value="" class="login_btn" />
                    </li>
                </ul>
            <?php ActiveForm::end() ?>
            
        </div>
        
        <div class="mobile fl">
            <h3>手机快速注册</h3>           
            <p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
            <p><strong>1069099988</strong></p>
        </div>

    </div>
</div>
<!-- 注册主体部分end -->
<?php
$js = <<<'JS'
    $(document).on('click', '#refresh-captcha', function() {
        $('#captcha-image').trigger('click');
    }).on('submit', '#register-form', function() {
        var password = $('[name="RegisterForm[password]"]').val(),
            passwordRepeat = $('[name="password_repeat"]').val(); 
        if (password !== passwordRepeat) {
            alert('两次输入密码不一致，请修复。');
            return false;
        }
    });
JS;
$this->registerJs($js);
?>
