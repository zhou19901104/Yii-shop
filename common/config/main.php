<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
        ],
        'pingpp' => [
            'class' => '\idarex\pingppyii2\PingppComponent',
            'apiKey' => 'sk_test_9K048G1urnfTPenrT4erjTK0',
            'appId' => 'app_vvXjHCiTiPSGifjr',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        // ...
                    ],
                ],
            ],
        ],
        'fileStorage'=>[
            'class' => 'trntv\filekit\Storage',
            'baseUrl' => 'http://upload.itcast-shop.dev',
            'filesystem'=> [
                'class' => 'common\components\LocalFlysystemBuilder',
                'path' => dirname(dirname(__DIR__)) . '/upload',
            ],
        ],
        'xunsearch' => [
            'class' => 'hightman\xunsearch\Connection', // 此行必须
            'iniDirectory' => '@common/config',    // 搜索 ini 文件目录，默认：@vendor/hightman/xunsearch/app
            'charset' => 'utf-8',   // 指定项目使用的默认编码，默认即时 utf-8，可不指定
        ],
    ],
];
