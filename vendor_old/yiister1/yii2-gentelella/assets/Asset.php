<?php
/**
 * @copyright Copyright (c) 2015 Yiister
 * @license https://github.com/yiister/yii2-gentelella/blob/master/LICENSE
 * @link http://gentelella.yiister.ru
 */

namespace yiister\gentelella\assets;

class Asset extends \yii\web\AssetBundle
{
    public $depends = [
        'yiister1\gentelella\assets\ThemeAsset',
        'yiister1\gentelella\assets\ExtensionAsset',
    ];
}
