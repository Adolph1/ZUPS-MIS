<?php
//$lang=\backend\models\Language::getDefaultLang();
return [
    'language' => 'en',
    'timeZone' => 'Africa/Dar_eS_Salaam',
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
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                /*'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'sw',
                    'basePath' => '@app/messages'
                ],*/
            ],
        ],




    ],
    'modules'    => [
        'backup' => [
            'class' => 'spanjeta\modules\backup\Module',
        ],
    ],

];
