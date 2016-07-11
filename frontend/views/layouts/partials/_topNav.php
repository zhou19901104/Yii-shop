<?php
use yii\helpers\Url;
?>
<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w990 bc">
        <div class="topnav_left">
            
        </div>
        <div class="topnav_right fr">
            <ul>
                <?php if (Yii::$app->user->isGuest): ?>
                <li>您好，欢迎来到京西！[<a href="<?= Url::to(['user/login']) ?>">登录</a>] [<a href="<?= Url::to(['user/register']) ?>">免费注册</a>] </li>
                <?php else: ?>
                <li><?= Yii::$app->user->identity->username ?> 您好，欢迎来到京西！[<a href="<?= Url::to(['user/logout']) ?>">退出</a>]</li>
                <?php endif; ?>
                <li class="line">|</li>
                <li>我的订单</li>
                <li class="line">|</li>
                <li>客户服务</li>

            </ul>
        </div>
    </div>
</div>
<!-- 顶部导航 end -->
