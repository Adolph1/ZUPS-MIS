<aside class="main-sidebar" style="font-size: 12px; font-family: Tahoma, sans-serif">>

    <section class="sidebar" >


        <?= dmstr\widgets\Menu::widget(
            [

                "items" => [
                    ["label" =>Yii::t('app','Home'), "url" =>  Yii::$app->homeUrl, "icon" => "home"],

                    [

                        'label' => 'Zups',
                        'icon' => 'building',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),
                        'url' => '#',
                        'items' => [
                            ['label' => 'Zones', "icon" => "circle text-blue", 'url' => ['/zone/index']],

                            ['label' => 'Mikoa', "icon" => "circle text-blue", 'url' => ['/mkoa/index']],
                            [
                                // 'visible' => (Yii::$app->user->identity->username == 'admin'),
                                "label" => "Wilaya",
                                "url" => ["/wilaya/index"],
                                "icon" => "circle text-blue",
                            ],

                            [
                                //'visible' => (Yii::$app->user->identity->username == 'admin'),
                                "label" => "Shehia",
                                "url" => ["/shehia/index"],
                                "icon" => "circle text-blue",
                            ],

                            [
                                'label' => 'Vitengo vya kazi',
                                'icon' => 'circle text-blue',
                                //'visible' => Yii::$app->user->can('admin'),
                                'url' => ['kazi/index'],

                            ],
                            [
                                'label' => 'Departments',
                                'icon' => 'folder-open-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Department Mpya',  'icon' => 'circle text-blue', 'url' => ['/department/create'],],
                                    ['label' => 'Orodha ya departments',  'icon' => 'circle text-blue', 'url' => ['/department/index'],],


                                ],
                            ],
                            [

                                'label' => 'Wafanyakazi',
                                'icon' => 'folder-open-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Mfanyakazi Mpya',  'icon' => 'user-plus text-blue', 'url' => ['/wafanyakazi/create'],],
                                    ['label' => 'Orodha ya Wafanyakazi',  'icon' => 'circle text-blue', 'url' => ['/wafanyakazi/index'],],


                                ],
                            ],
                            [
                                'label' => 'Sheha',
                                'icon' => 'folder-open-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Sheha Mpya',  'icon' => 'user-plus text-blue', 'url' => ['/sheha/create'],],
                                    ['label' => 'Orodha ya Masheha',  'icon' => 'circle text-blue', 'url' => ['/sheha/index'],],


                                ],
                            ],
                            [
                                'label' => 'Vituo vya malipo',
                                'icon' => 'folder-open-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Kituo kipya',  'icon' => 'money text-blue', 'url' => ['/vituo/create'],],
                                    ['label' => 'Orodha ya Vituo',  'icon' => 'circle text-blue', 'url' => ['/vituo/index'],],
                                    ['label' => 'Shehia ndani ya vituo',  'icon' => 'circle text-blue', 'url' => ['/kituo-shehia/index'],],



                                ],
                            ],


                        ],


                    ],


                    [
                        'label' => 'Wazee',
                        'icon' => 'folder-open-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Mzee Mpya',  'icon' => 'user-plus text-blue', 'url' => ['/mzee/create'],],
                            ['label' => 'Wazee wanaosubiri uhakiki',  'icon' => 'circle text-orange', 'url' => ['/mzee/pending'],],
                            ['label' => 'Wazee Waliohakikiwa',  'icon' => 'circle text-orange', 'url' => ['/mzee/vetted'],],
                            ['label' => 'Wazee Waliokubaliwa ',  'icon' => 'circle text-green', 'url' => ['/mzee/index'],],

                            [
                                'label' => 'Mpangilio',
                                'icon' => 'folder-open-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Aina ya viambatanisho', 'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),  'icon' => 'circle text-blue', 'url' => ['/viambatanisho/index'],],
                                    [
                                        'label' => 'Uhusiano',
                                        'icon' => 'circle text-blue',
                                        'visible' => Yii::$app->user->can('admin'),
                                        'url' => ['uhusiano/index'],

                                    ],

                                    [
                                        'label' => 'Kazi za wazee',
                                        'icon' => 'circle text-blue',
                                        'visible' => Yii::$app->user->can('admin'),
                                        'url' => ['kazi-mzee/index'],

                                    ],
                                    [
                                        'label' => 'Magonjwa ya wazee',
                                        'icon' => 'circle text-blue',
                                        'visible' => Yii::$app->user->can('admin'),
                                        'url' => ['magonjwa/index'],

                                    ],
                                    [
                                        'label' => 'Aina za ulemavu',
                                        'icon' => 'circle text-blue',
                                        'visible' => Yii::$app->user->can('admin'),
                                        'url' => ['ulemavu/index'],

                                    ],
                                    [
                                        'label' => 'Vipato vya wazee',
                                        'icon' => 'circle text-blue',
                                        'visible' => Yii::$app->user->can('admin'),
                                        'url' => ['vipato/index'],

                                    ],

                                    [
                                        'label' => 'Pension Zingine',
                                        'icon' => 'circle text-blue',
                                        'visible' => Yii::$app->user->can('admin'),
                                        'url' => ['pension-nyingine/index'],

                                    ],

                                    [
                                        'label' => 'Aina ya Vitambulisho',
                                        'icon' => 'circle text-blue',
                                        'visible' => Yii::$app->user->can('admin'),
                                        'url' => ['aina-ya-kitambulisho/index'],

                                    ],
                                ]
                            ]


                        ],
                    ],
                    [
                        'label' => 'Wasaidizi wa wazee',
                        'icon' => 'folder-open-o',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),
                        'url' => '#',
                        'items' => [
                            ['label' => 'Msaidizi Mpya',  'icon' => 'circle text-blue', 'url' => ['/msaidizi-mzee/create'],],
                            ['label' => 'Orodha ya wasaidizi',  'icon' => 'money text-blue', 'url' => ['/msaidizi-mzee/index'],],


                        ],
                    ],

                    [
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),
                        'label' => 'Budgets',
                        'icon' => 'folder-open-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Budget Mpya',  'icon' => 'circle text-blue', 'url' => ['/budget/create'],],
                            ['label' => 'Orodha ya Budgets',  'icon' => 'circle text-blue', 'url' => ['/budget/index'],],
                            ['label' => 'Summary ya budget',  'icon' => 'circle text-blue', 'url' => ['/budget/summary'],],
                            [
                                'label' => 'Mahitaji mbalimbali',
                                'icon' => 'folder-open-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Hitaji Jipya',  'icon' => 'circle text-blue', 'url' => ['/mahitaji/create'],],
                                    ['label' => 'Orodha ya Mahitaji yote',  'icon' => 'circle text-blue', 'url' => ['/mahitaji/index'],],
                                    ['label' => 'Mahitaji ya wilaya',  'icon' => 'circle text-blue', 'url' => ['/mahitaji-wilaya/index'],],
                                    ['label' => 'Mahitaji ya ofisi',  'icon' => 'circle text-blue', 'url' => ['/mahitaji-wilaya/index'],],


                                ],
                            ],


                        ],
                    ],

                    [
                        'label' => 'Vouchers',
                        'icon' => 'folder-open-o',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),
                        'url' => '#',
                        'items' => [
                            ['label' => 'Orodha ya vouchers',  'icon' => 'circle text-blue', 'url' => ['/voucher/index'],],
                            ['label' => 'Jumla ya fedha kwa kituo',  'icon' => 'money text-blue', 'url' => ['/kituo-monthly-balances/index'],],


                        ],
                    ],
                    [
                        'label' => 'Miamala ya Kifedha',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('Accountant'),
                        'icon' => 'folder-open-o',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Wazee',
                               // 'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),
                                'icon' => 'folder-open-o',
                                'url' => '#',
                                'items' => [

                            ['label' => 'Muamala Mpya',  'icon' => 'money text-blue', 'url' => ['/teller/create'],],
                            ['label' => 'Orodha ya miamala',  'icon' => 'money text-blue', 'url' => ['/teller/index'],],
                            ],
                                ],

                            [
                                'label' => 'Watendaji',
                                //'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),
                                'icon' => 'folder-open-o',
                                'url' => '#',
                                'items' => [

                                    ['label' => 'Muamala Mpya',  'icon' => 'money text-blue', 'url' => ['/miamala-watendaji/create'],],
                                    ['label' => 'Orodha ya miamala',  'icon' => 'money text-blue', 'url' => ['/miamala-watendaji/index'],],
                                    ['label' => 'Watendaji waliolipwa',  'icon' => 'money text-blue', 'url' => ['/malipo-watendaji/index'],],
                                ],
                            ],
                            [
                                'label' => 'Matumizi mengine',
                                //'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),
                                'icon' => 'folder-open-o',
                                'url' => '#',
                                'items' => [

                                    ['label' => 'Muamala Mpya',  'icon' => 'money text-blue', 'url' => ['/matumizi-mengine/create'],],
                                    ['label' => 'Orodha ya miamala',  'icon' => 'money text-blue', 'url' => ['/matumizi-mengine/index'],],
                                ],
                            ],

                        ],
                    ],

                    [
                        'label' => 'Malipo ya wazee',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),
                        'icon' => 'folder-open-o',
                        'url' => '#',
                        'items' => [

                            ['label' => 'Wanaosubiri kulipwa',  'icon' => 'circle text-blue', 'url' => ['/malipo/index'],],
                            ['label' => 'Waliolipwa',  'icon' => 'circle text-blue', 'url' => ['/malipo/leo'],],
                            ['label' => 'Report ya malipo kwa ufupi',  'icon' => 'circle text-blue', 'url' => ['/malipo/malipo-vituoni'],],
                            ['label' => 'Malipo yalioisha muda wake',  'icon' => 'circle text-blue', 'url' => ['/malipo/expired'],],


                        ],
                    ],




                    [
                        'label' => 'Akaunti za makarani',
                        'icon' => 'folder-open-o',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('Accountant'),
                        'url' => '#',
                        'items' => [
                            ['label' => 'akaunti mpya',  'icon' => 'money text-blue', 'url' => ['/cashier-account/create'],],
                            ['label' => 'Orodha ya akaunti',  'icon' => 'money text-blue', 'url' => ['/cashier-account/index'],],


                        ],
                    ],

                    [
                        'label' => 'Ratiba za ma-clerk vituoni',
                        'icon' => 'folder-open-o',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('Accountant'),
                        'url' => '#',
                        'items' => [
                            ['label' => 'Ratiba mpya',  'icon' => 'money text-blue', 'url' => ['/clerk-kituo/create'],],
                            ['label' => 'Ratiba za ma-clerks',  'icon' => 'money text-blue', 'url' => ['/clerk-kituo/index'],],


                        ],
                    ],
                    [
                        'label' => 'Kufunga Mahesabu',
                        'icon' => 'folder-open-o',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('Accountant'),
                        'url' => '#',
                        'items' => [
                            ['label' => 'Mahesabu ya kufungwa',  'icon' => 'money text-orange', 'url' => ['/mahesabu-yaliofungwa/pending'],],
                            ['label' => 'Mahesabu yaliyofungwa',  'icon' => 'money text-success', 'url' => ['/mahesabu-yaliofungwa/closed'],],


                        ],
                    ],

                    [
                        'label' => 'Document management',
                        'icon' => 'folder-open-o',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('Accountant'),
                        'url' => '#',
                        'items' => [
                            ['label' => 'New Folder',  'icon' => 'money text-orange', 'url' => ['/folder/create'],],
                            ['label' => 'Orodha ya folders',  'icon' => 'money text-success', 'url' => ['/folder/index'],],


                        ],
                    ],
                    [
                        'label' => 'Complaints management',
                        'icon' => 'folder-open-o',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('Accountant'),
                        'url' => '#',
                        'items' => [
                            ['label' => 'Orodha ya complaints',  'icon' => 'money text-success', 'url' => ['/complains/index'],],


                        ],
                    ],



                    [
                        'label' => 'Ripoti',
                        'icon' => 'sitemap',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Ripoti za mwezi',
                                'icon' => 'clock-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Malipo ya wazee kiwilaya',  'icon' => 'file-o', 'url' => ['/report/kiwilaya'],],
                                    ['label' => 'Malipo ya wazee kimkoa',  'icon' => 'file-o', 'url' => ['/report/kimkoa'],],
                                    ['label' => 'Wazee waliofariki kiwilaya',  'icon' => 'file-o', 'url' => ['/report/new-dead'],],


                                ],
                            ],
                            [
                                'label' => 'Custom Reports',
                                'icon' => 'clock-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Custom Reports',  'icon' => 'file-o', 'url' => ['/reportico'],],



                                ],
                            ],
                            [
                                'label' => 'Ripoti za wazee',
                                'icon' => 'clock-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Waliofariki',  'icon' => 'file-o', 'url' => '#',],
                                    ['label' => 'Waliokataliwa Ombi',  'icon' => 'file-o', 'url' => '#',],
                                    ['label' => 'Waliositishwa huduma',  'icon' => 'file-o', 'url' => '#',],
                                    ['label' => 'Wanaosubiri uhakiki',  'icon' => 'file-o', 'url' => '#',],
                                    ['label' => 'Wasiojiweza',  'icon' => 'file-o', 'url' => '#',],
                                    ['label' => 'Waliochukuliwa finger print',  'icon' => 'file-o', 'url' => '#',],


                                ],
                            ],



                        ],
                    ],






                    [
                        'visible' => Yii::$app->user->can('Registrar') || Yii::$app->user->can('admin'),
                        "label" =>Yii::t('app','Mpangilio'),
                        "url" => "#",
                        "icon" => "fa fa-lock",
                        "items" => [
                            [
                                'label' => 'Automation Settings',
                                'icon' => 'lock',
                                'visible' => Yii::$app->user->can('admin'),
                                'url' => ['automation-settings/index'],

                            ],
                            [
                                'visible' => Yii::$app->user->can('admin'),
                                'label' => Yii::t('app', 'Audit Trail'),
                                'url' => ['/audit/index'],
                                'icon' => 'fa fa-lock',
                            ],

                            [
                                'label' => 'ZUPS settings',
                                'icon' => 'lock',
                                'visible' => Yii::$app->user->can('admin'),
                                'url' => ['zups-product/index'],

                            ],


                            [
                                'visible' => (Yii::$app->user->identity->username == 'admin'),
                                "label" => "Users",
                                "url" => ["/user/index"],
                                "icon" => "fa fa-user",
                            ],

                            [
                                'visible' => (Yii::$app->user->identity->username == 'admin'),
                                'label' => Yii::t('app', 'Manager Permissions'),
                                'url' => ['/auth-item/index'],
                                'icon' => 'fa fa-lock',
                            ],
                            [
                                'visible' => (Yii::$app->user->identity->username == 'admin'),
                                'label' => Yii::t('app', 'Manage User Roles'),
                                'url' => ['/role/index'],
                                'icon' => 'fa fa-lock',
                            ],

                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
