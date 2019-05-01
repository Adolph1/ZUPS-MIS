<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 1/16/17
 * Time: 11:56 AM
 */
return [
    'sourcePath' => '..' . '/messages',
    'languages' => ['sw'], //Add languages to the array for the language files to be generated.
    'translator' => 'Yii::t',
    'sort' => false,
    'removeUnused' => false,
    'only' => ['*.php'],
    'except' => [
        '.svn',
        '.git',
        '.gitignore',
        '.gitkeep',
        '.hgignore',
        '.hgkeep',
        '/messages',
        '/vendor',
    ],
    'format' => 'php',
    'messagePath' => __DIR__ . 'messages',
    'overwrite' => true,
];
