<?php
return [
    'components' => [
        'assetManager' => [
            'linkAssets' => true,
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=itcast-shop',
            'username' => 'root',
            'password' => 'hahaha',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            //'useFileTransport' => 'true',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mailgun.org',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'postmaster@sandbox82dfe3fbf0614ea28b17eadd5b0818f8.mailgun.org',
                'password' => 'aafbf3bb5ca03fc8261490f081675f98',
                'port' => '587', // Port 25 is a very common port too
                'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],
        ],
    ],
];
