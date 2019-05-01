<?php
//$lang=\backend\models\Language::getDefaultLang();
return [
    'language' => 'sw',
    'timeZone' => 'Africa/Dar_es_Salaam',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            //'defaultRoles' => ['guest'],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'consoleRunner' => [
            'class' => 'vova07\console\ConsoleRunner',
            'file' => 'yii'
        ],

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
                   'basePath' => '@app/messages'
                ],
            ],
        ],




    ],
    'modules'    => [
        'backup' => [
            'class' => 'spanjeta\modules\backup\Module',
        ],
    ],

];
