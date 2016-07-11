<?php

namespace backend\assets;

use yii\web\AssetBundle;

class UiLoadAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $js = [
        'js/ui-load.js',
        'js/ui-jp.config.js',
        'js/ui-jp.js',
    ];
}
