<?php

namespace backend\assets;

use yii\web\AssetBundle;

class UtilsAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $webroot = '@web';

    public $js = [
        'js/cookie.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}