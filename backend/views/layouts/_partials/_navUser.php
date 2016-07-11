<?php

use yii\helpers\Url;
?>
<div class="clearfix wrapper dk nav-user hidden-xs">
    <div class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="thumb avatar pull-left m-r">
        <img src="<?= Yii::$app->user->identity->avatar ?>" alt="头像">
        <i class="on md b-black"></i>
        </span>
        <span class="hidden-nav-xs clear">
        <span class="block m-t-xs">
        <strong class="font-bold text-lt"><?= Yii::$app->user->identity->username ?></strong>
        <b class="caret"></b>
        </span>
        <span class="text-muted text-xs block"><?= Yii::$app->user->identity->email ?></span>
        </span>
        </a>
        <ul class="dropdown-menu animated fadeInRight m-t-xs">
            <li>
                <span class="arrow top hidden-nav-xs"></span>
                <a href="<?= Url::to(['user/logout']) ?>" data-method='post'>退出</a>
            </li>
        </ul>
    </div>
</div>