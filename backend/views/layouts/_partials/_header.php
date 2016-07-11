<?php

use yii\helpers\Url;

?>
<header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
    <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
        <i class="fa fa-bars"></i>
        </a>
        <a href="<?= Yii::$app->homeUrl ?>" class="navbar-brand">
        <img src="/scale/images/logo.png" class="m-r-sm" alt="scale">
        <span class="hidden-nav-xs"><?= Yii::$app->name ?></span>
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
        <i class="fa fa-cog"></i>
        </a>
    </div>
    <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
            <img src="<?= Yii::$app->user->identity->avatar ?>" alt="头像">
            </span>
            <?= Yii::$app->user->identity->username ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">
                <li>
                    <a href="<?= Url::to(['user/logout']) ?>" data-method="post" >退出</a>
                </li>
            </ul>
        </li>
    </ul>
</header>