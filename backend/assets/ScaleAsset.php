<?php
/**
 * @link http://php.itcast.cn/
 * @copyright Copyright (c) 2015 itcast
 * @license all rights reserved
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author 苏小林 <suxiaolin@mail.com>
 * @since 2.0
 */
class ScaleAsset extends AssetBundle
{
    public $baseUrl = '@web/scale';
    public $css = [
        "css/animate.css",
        "css/font-awesome.min.css",
        "css/icon.css",
        "css/font.css",
        "css/app.css",
    ];
    public $js = [
        "js/app.js",
        "js/slimscroll/jquery.slimscroll.min.js",
        //"js/app.plugin.js",
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'backend\assets\IeJsAsset',
    ];
}
