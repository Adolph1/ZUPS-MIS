<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        /*'request' => [
            'csrfParam' => '_csrf-frontend',
        ],*/
        /* 'user' => [
             'identityClass' => 'common\models\User',
             'enableAutoLogin' => true,
             'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
         ],*/
        'user' => [
            'identityClass' => 'common\models\User',
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'request' => [
            'class' => '\yii\web\Request',
            'enableCookieValidation' => false,

             'enableCsrfValidation' => false,
<<<<<<< HEAD
            'enableCsrfValidation' => false,
=======

>>>>>>> ca4906fb2036137392ccfaa209da31894906c1a8
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'urlManager' => [
            'enablePrettyUrl' => true,
            //'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['widgetmodule/widget']
                ]
            ],
        ],
    ],
    'params' => $params,
];
