<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'Сокращение ссылок',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'as hostControl' => [
        'class' => 'yii\filters\HostControl',
        'allowedHosts' => [
            $params['allowed_host'],
            '*.' . $params['allowed_host'],
            'localhost',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/<hash:\w+>' => 'shortlink/shortlink/go',
                '/' => 'shortlink/shortlink/create',
                'shortlink/shortlink/view/<hash:\w+>' => 'shortlink/shortlink/view',

                '<controller>/<id:\d+>' => '<controller>/view',
                '<controller>/<action>' => '<controller>/<action>',
                '<controller>/<action>/<id:\d+>' => '<controller>/<action>',

                '<module>/<controller>/index' => '<module>/<controller>/index',
                'OPTIONS <module>/<controller>/<action>' => '<module>/<controller>/options',
                '<module>/<controller>/<action>' => '<module>/<controller>/<action>',
                '<module>/<controller>/<action>/<id:\d+>' => '<module>/<controller>/<action>',
                '<module>/<controller>/<slug:[A-Za-z0-9 -_.]+>' => '<module>/<controller>/view',
            ],
        ],
    ],
    'params' => $params,
];
