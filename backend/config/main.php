<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [

        'dynagrid'=> [
            'class'=>'\kartik\dynagrid\Module',
            // other module settings
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],
        'backup' => [
            'class' => 'spanjeta\modules\backup\Module',
        ],

    ],

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'errorHandler' => [
            'maxSourceLines' => 20,
        ],
 /*       'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                ],
            ],
        ],*/

        'user' => [
            'identityClass' => 'backend\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 1800,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => false],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],


    ],
    'params' => $params,
];
