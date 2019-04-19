Alternative yii\grid\ActionColumn for yii2
=================================

[Russian readme](https://github.com/microinginer/yii2-dropdown-action-column/blob/master/README-RU.md)

##Default buttons

```php
echo \yii\grid\GridView::widget([
    ...
    'columns'      => [
        ...
        [
            'class' => \microinginer\dropDownActionColumn\DropDownActionColumn::className(),
        ],
    ],
]);
```

![alternative yii\grid\ActionColumn default buttons](https://raw.githubusercontent.com/microinginer/yii2-dropdown-action-column/master/screenshots/default-buttons.png "alternative yii\grid\ActionColumn default buttons")


##Custom buttons

```php
echo \yii\grid\GridView::widget([
    ...
    'columns'      => [
        ...
        [
            'class' => \microinginer\dropDownActionColumn\DropDownActionColumn::className(),
            'items' => [
                [
                    'label' => 'View',
                    'url'   => ['view'],
                ],
                [
                    'label' => 'Export',
                    'url'   => ['expert'],
                ],
                [
                    'label'   => 'Disable',
                    'url'     => ['disable'],
                    'linkOptions' => [
                        'data-method' => 'post'
                    ],
                ],
            ]
        ],
    ],
]);
```

![alternative yii\grid\ActionColumn custom buttons](https://raw.githubusercontent.com/microinginer/yii2-dropdown-action-column/master/screenshots/custom-buttons.png "alternative yii\grid\ActionColumn custom buttons")


##Install

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist microinginer/yii2-dropdown-action-column "dev-master"
```

or add

```json
"microinginer/yii2-dropdown-action-column": "dev-master"
```
to the require section of your composer.json file.
