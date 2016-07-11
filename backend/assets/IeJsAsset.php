<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class IeJsAsset extends AssetBundle {
    public $basePath = '@webroot/scale';
    public $baseUrl = '@web/scale';

    public $jsOptions = [
        'condition' => 'lte IE 9',
        'position' => View::POS_HEAD,
    ];

    public $js = [
        'js/ie/respond.min.js',
        'js/ie/html5shiv.js',
        'js/ie/excanvas.js',
    ];
}
