<aside class="main-sidebar" style="font-size: 12px; font-family: Tahoma, sans-serif">>

    <section class="sidebar" >


        <?php
        if(!Yii::$app->user->isGuest) {
            echo dmstr\widgets\Menu::widget(
                [

                    "items" => [
                        ["label" => Yii::t('app', 'Home'), "url" => Yii::$app->homeUrl, "icon" => "home"],

                        [

                            'label' => 'Zups',
                            'icon' => 'building',
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer'),
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
                                        ['label' => 'Department Mpya', 'icon' => 'circle text-blue', 'url' => ['/department/create'],],
                                        ['label' => 'Orodha ya departments', 'icon' => 'circle text-blue', 'url' => ['/department/index'],],


                                    ],
                                ],
                                [

                                    'label' => 'Wafanyakazi',
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Mfanyakazi Mpya', 'icon' => 'user-plus text-blue', 'url' => ['/wafanyakazi/create'],],
                                        ['label' => 'Orodha ya Wafanyakazi', 'icon' => 'circle text-blue', 'url' => ['/wafanyakazi/index'],],


                                    ],
                                ],
                                [
                                    'label' => 'Sheha',
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Sheha Mpya', 'icon' => 'user-plus text-blue', 'url' => ['/sheha/create'],],
                                        ['label' => 'Orodha ya Masheha', 'icon' => 'circle text-blue', 'url' => ['/sheha/index'],],


                                    ],
                                ],
                                [
                                    'label' => 'Vituo vya malipo',
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Kituo kipya', 'icon' => 'money text-blue', 'url' => ['/vituo/create'],],
                                        ['label' => 'Orodha ya Vituo', 'icon' => 'circle text-blue', 'url' => ['/vituo/index'],],
                                        ['label' => 'Shehia ndani ya vituo', 'icon' => 'circle text-blue', 'url' => ['/kituo-shehia/index'],],


                                    ],
                                ],


                            ],


                        ],

                        [
                            'label' => 'Wazee',
                            'icon' => 'folder-open-o',
                            'url' => '#',
                            'visible' => Yii::$app->user->can('Cashier'),
                            'items' => [
                                ['label' => 'Ingiza Mzee aliyefariki', 'icon' => 'user-plus text-red', 'url' => ['/mzee/new-dead'],],
                                ['label' => 'Wazee Waliofariki ', 'icon' => 'circle text-red', 'url' => ['/mzee/died'],],
                            ],
                        ],


                        [
                            'label' => 'Wazee',
                            'icon' => 'folder-open-o',
                            'url' => '#',
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                            'items' => [
                                ['label' => 'Mzee Mpya', 'icon' => 'user-plus text-blue', 'url' => ['/mzee/create'],],
                                ['label' => 'Hamisha Mzee', 'icon' => 'reply text-warning', 'url' => ['/hamisha-mzee/create'],],
                                ['label' => 'Wazee wanaosubiri uhakiki', 'icon' => 'circle text-orange', 'url' => ['/mzee/pending'],],
                                ['label' => 'Wazee Waliohakikiwa', 'icon' => 'circle text-orange', 'url' => ['/mzee/vetted'],],
                                ['label' => 'Wazee Waliokubaliwa ', 'icon' => 'circle text-green', 'url' => ['/mzee/index'],],
                                ['label' => 'Wenye Fingerprint ', 'icon' => 'circle text-green', 'url' => ['/mzee/with-finger'],],
                                ['label' => 'Waliokataliwa ', 'icon' => 'circle text-red', 'url' => ['/mzee/rejected'],],
                                ['label' => 'Waliositishwa ', 'icon' => 'circle text-red', 'url' => ['/mzee/suspended'],],
                                ['label' => 'Ingiza Mzee aliyefariki', 'icon' => 'user-plus text-red', 'url' => ['/mzee/new-dead'],],
                                ['label' => 'Wazee Waliofariki ', 'icon' => 'circle text-red', 'url' => ['/mzee/died'],],
                                ['label' => 'Wazee Waliohamishwa ', 'icon' => 'circle text-warning', 'url' => ['/hamisha-mzee/index'],],
                                [
                                    'label' => 'Watu wa karibu',
                                    'icon' => 'folder-open-o',
                                    'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'mtu wa karibu Mpya', 'icon' => 'circle text-blue', 'url' => ['/msaidizi-mzee/create'],],
                                        ['label' => 'Orodha ya watu wa karibu', 'icon' => 'money text-blue', 'url' => ['/msaidizi-mzee/index'],],
                                        // ['label' => 'Wenye Fingerprint ',  'icon' => 'circle text-green', 'url' => ['/msaidizi-mzee/with-finger'],],


                                    ],
                                ],

                                [
                                    'label' => 'Mpangilio',
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Aina ya viambatanisho', 'icon' => 'circle text-blue', 'url' => ['/viambatanisho/index'],],
                                        [
                                            'label' => 'Uhusiano',
                                            'icon' => 'circle text-blue',
                                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                            'url' => ['uhusiano/index'],

                                        ],

                                        [
                                            'label' => 'Kazi za wazee',
                                            'icon' => 'circle text-blue',
                                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                            'url' => ['kazi-mzee/index'],

                                        ],
                                        [
                                            'label' => 'Magonjwa ya wazee',
                                            'icon' => 'circle text-blue',
                                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                            'url' => ['magonjwa/index'],

                                        ],
                                        [
                                            'label' => 'Aina za ulemavu',
                                            'icon' => 'circle text-blue',
                                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                            'url' => ['ulemavu/index'],

                                        ],
                                        [
                                            'label' => 'Vipato vya wazee',
                                            'icon' => 'circle text-blue',
                                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                            'url' => ['vipato/index'],

                                        ],

                                        [
                                            'label' => 'Pension Zingine',
                                            'icon' => 'circle text-blue',
                                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                            'url' => ['pension-nyingine/index'],

                                        ],

                                        [
                                            'label' => 'Aina ya Vitambulisho',
                                            'icon' => 'circle text-blue',
                                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                            'url' => ['aina-ya-kitambulisho/index'],

                                        ],
                                        [
                                            'label' => 'Blood group',
                                            'icon' => 'circle text-blue',
                                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                            'url' => ['blood-group/index'],

                                        ],
                                    ]
                                ]


                            ],
                        ],

                        [
                            'label' => 'Sheha',
                            'visible' => Yii::$app->user->can('DataClerk'),
                            'icon' => 'folder-open-o',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Sheha Mpya', 'icon' => 'user-plus text-blue', 'url' => ['/sheha/create'],],
                                ['label' => 'Orodha ya Masheha', 'icon' => 'circle text-blue', 'url' => ['/sheha/index'],],


                            ],
                        ],

                        [
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Accountant') || Yii::$app->user->can('reviewBudget') || Yii::$app->user->can('approveBudget') || Yii::$app->user->can('secondBudgetApprove'),
                            'label' => 'Budgets',
                            'icon' => 'folder-open-o',
                            'url' => '#',
                            'items' => [
                                [
                                        'label' => 'Budget Mpya',
                                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('createBudget'), 'icon' => 'circle text-blue', 'url' => ['/budget/create'],

                                 ],
                                [
                                        'label' => 'Thibitisha budget',  'icon' => 'circle text-blue',
                                        'url' => ['/budget/pending'],
                                        'visible' => Yii::$app->user->can('approveBudget'),

                                ],
                                ['label' => 'Fund budget',  'icon' => 'circle text-blue', 'url' => ['/fund-budget/create'],],

                                [
                                    'label' => 'Orodha ya Budget',
                                    'icon' => 'circle text-blue',
                                    'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Accountant'),
                                    'url' => ['/budget/index'],
                                ],

                                // ['label' => 'Pitia budget',  'icon' => 'circle text-blue', 'url' => ['/budget/review-budget'],],
                                [
                                    'label' => 'Orodha ya budget kuu',
                                    'icon' => 'circle text-blue',
                                    'visible' => Yii::$app->user->can('reviewBudget') || Yii::$app->user->can('approveBudget') || Yii::$app->user->can('secondBudgetApprove'),
                                    'url' => ['/zups-budget/index'],

                                ],
                                [
                                    'label' => 'Vouchers',
                                    'icon' => 'folder-open-o',
                                    'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Accountant'),
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Orodha ya vouchers', 'icon' => 'circle text-blue', 'url' => ['/voucher/index'],],
                                        ['label' => 'Print vouchers', 'icon' => 'print text-blue', 'url' => ['/voucher/kituo-voucher'],],
                                        ['label' => 'Eligibles', 'icon' => 'print text-blue', 'url' => ['/mzee/eligibles'],],


                                    ],
                                ],
                                [
                                    'label' => 'Mahitaji mbalimbali',
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer'),
                                    'items' => [
                                        ['label' => 'Hitaji Jipya', 'icon' => 'circle text-blue', 'url' => ['/mahitaji/create'],],
                                        ['label' => 'Orodha ya Mahitaji yote', 'icon' => 'circle text-blue', 'url' => ['/mahitaji/index'],],
                                        ['label' => 'Mahitaji ya wilaya', 'icon' => 'circle text-blue', 'url' => ['/mahitaji-wilaya/index'],],
                                        ['label' => 'Aina ya mahitaji', 'icon' => 'circle text-blue', 'url' => ['/mahitaji-category/index'],],


                                    ],
                                ],


                            ],
                        ],
                        [
                            "label" => Yii::t('app', 'Accounting'),
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Accountant'),
                            "url" => "#",
                            "icon" => "fa fa-clock-o",
                            "items" => [
                                [
                                    'visible' => yii::$app->User->can('Accountant') || yii::$app->User->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || yii::$app->User->can('admin'),
                                    "label" => Yii::t('app', 'System General Ledgers'),
                                    "url" => ["/general-ledger/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    'visible' => yii::$app->User->can('admin'),
                                    "label" => Yii::t('app', 'Types'),
                                    "url" => ["/gl-type/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    'visible' => yii::$app->User->can('admin'),
                                    "label" => Yii::t('app', 'Category'),
                                    "url" => ["/gl-category/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    'visible' => yii::$app->User->can('Accountant') || yii::$app->User->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer')|| yii::$app->User->can('admin'),
                                   // 'visible' => yii::$app->User->can('admin'),
                                    "label" => Yii::t('app', 'Daily Balances'),
                                    "url" => ["/gl-daily-balance/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    'visible' => yii::$app->User->can('admin'),
                                    'label' => 'System Products',
                                    'url' => ['/product/index'],
                                    'icon' => 'fa fa-lock',
                                ],
                                [
                                    'visible' => yii::$app->User->can('admin'),
                                    'label' => 'Accounting roles',
                                    'url' => ['/accrole/index'],
                                    'icon' => 'fa fa-lock',
                                ],

                                /*[
                                    'label' => 'Cashbook',
                                    // 'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'items' => [

                                        ['label' => 'Muamala Mpya', 'icon' => 'money text-blue', 'url' => ['/cash-book/create'],],
                                        ['label' => 'Orodha ya miamala', 'icon' => 'money text-blue', 'url' => ['/cash-book/index'],],
                                    ],
                                ],*/
                            ],


                        ],


                        [
                            'label' => 'Miamala ya Kifedha',
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Accountant'),
                            'icon' => 'folder-open-o',
                            'url' => '#',
                            'items' => [


                                [
                                    'label' => 'Makarani',
                                    // 'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'items' => [

                                        ['label' => 'Muamala Mpya', 'icon' => 'money text-blue', 'url' => ['/teller/create'],],
                                        ['label' => 'Isiyohakikiwa bado', 'icon' => 'money text-blue', 'url' => ['/teller/pending'],],
                                        ['label' => 'Orodha ya miamala', 'icon' => 'money text-blue', 'url' => ['/teller/index'],],
                                    ],
                                ],

                                [
                                    'label' => 'Watendaji',
                                    //'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'items' => [

                                        ['label' => 'Muamala Mpya', 'icon' => 'money text-blue', 'url' => ['/miamala-watendaji/create'],],
                                        ['label' => 'Orodha ya miamala', 'icon' => 'money text-blue', 'url' => ['/miamala-watendaji/index'],],
                                        ['label' => 'Watendaji waliolipwa', 'icon' => 'money text-blue', 'url' => ['/malipo-watendaji/index'],],

                                    ],
                                ],
                                [
                                    'label' => 'Malipo ya Maafisa',
                                    'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Accountant'),
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'items' => [

                                        ['label' => 'muamala mpya', 'icon' => 'circle text-blue', 'url' => ['/malipo-maafisa/create'],],
                                        ['label' => 'Orodha ya miamala', 'icon' => 'circle text-blue', 'url' => ['/malipo-maafisa/index'],],

                                    ],
                                ],
                                [
                                    'label' => 'Malipo ya bidhaa',
                                    'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Accountant'),
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'items' => [

                                        ['label' => 'Muamala Mpya', 'icon' => 'money text-blue', 'url' => ['/matumizi-mengine/create'],],
                                        ['label' => 'Orodha ya miamala', 'icon' => 'money text-blue', 'url' => ['/matumizi-mengine/index'],],
                                        [
                                            'label' => 'Suppliers',
                                            //'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),
                                            'icon' => 'folder-open-o',
                                            'url' => '#',
                                            'items' => [

                                                ['label' => 'supplier mpya', 'icon' => 'circle text-blue', 'url' => ['/supplier/create'],],
                                                ['label' => 'Orodha ya ma-suppliers', 'icon' => 'circle text-blue', 'url' => ['/supplier/index'],],

                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'label' => 'Malipo ya wazee',
                                    'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Accountant'),
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'items' => [

                                        ['label' => 'Wanaosubiri kulipwa', 'icon' => 'circle text-blue', 'url' => ['/malipo/index'],],
                                        ['label' => 'Waliolipwa', 'icon' => 'circle text-blue', 'url' => ['/malipo/leo'],],
                                        ['label' => 'Report ya malipo kwa ufupi', 'icon' => 'circle text-blue', 'url' => ['/malipo/malipo-vituoni'],],
                                        ['label' => 'Malipo yalioisha muda wake', 'icon' => 'circle text-blue', 'url' => ['/malipo/expired'],],


                                    ],
                                ],




                            ],
                        ],
                        [
                            'label' => 'Ripoti',
                            'visible' => Yii::$app->user->can('DataClerk'),
                            'icon' => 'folder-open-o',
                            'url' => '#',
                            'items' => [

                                ['label' => 'Wanaosubiri kulipwa', 'icon' => 'circle text-blue', 'url' => ['/malipo/index'],],
                                ['label' => 'Waliolipwa', 'icon' => 'circle text-blue', 'url' => ['/malipo/leo'],],
                                ['label' => 'Malipo yalioisha muda wake', 'icon' => 'circle text-blue', 'url' => ['/malipo/expired'],],
                                ['label' => 'Wazee wote', 'icon' =>'circle text-blue','url' => ['mzee/search-all'],],



                            ],
                        ],
                        [
                            "label" => Yii::t('app', 'Miamala ya mwezi'),
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Accountant'),
                            "url" => "#",
                            "icon" => "fa fa-clock-o",
                            "items" => [
                                [
                                    'visible' => yii::$app->User->can('Accountant') || yii::$app->User->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || yii::$app->User->can('admin'),
                                    "label" => Yii::t('app', 'Miamala yote'),
                                    "url" => ["/today-entry/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],

                            ],


                        ],
                        [
                            'label' => 'Kufunga Mahesabu',
                            'icon' => 'folder-open-o',
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Accountant'),
                            'url' => '#',
                            'items' => [
                                ['label' => 'Mahesabu ya kufungwa', 'icon' => 'money text-orange', 'url' => ['/mahesabu-yaliofungwa/pending'],],
                                ['label' => 'Mahesabu yaliyofungwa', 'icon' => 'money text-success', 'url' => ['/mahesabu-yaliofungwa/closed'],],
                                ['label' => 'Jumla ya fedha kwa kituo', 'icon' => 'money text-blue', 'url' => ['/kituo-monthly-balances/index'],],


                            ],
                        ],

                        [
                            'label' => 'Miamala yangu',
                            'visible' => Yii::$app->user->can('payBeneficiary'),
                            'icon' => 'folder-open-o',
                            'url' => '#',
                            'items' => [

                                ['label' => 'Lipa Mtendaji', 'icon' => 'money text-blue', 'url' => ['/malipo-watendaji/lipa-mtendaji'],],
                                ['label' => 'Watendaji waliolipwa', 'icon' => 'money text-blue', 'url' => ['/malipo-watendaji/index'],],
                                ['label' => 'Lipa Mzee', 'icon' => 'money text-blue', 'url' => ['/malipo/my-pending'],],
                                ['label' => 'Wazee Waliolipwa', 'icon' => 'money text-blue', 'url' => ['/malipo/leo'],],
                                ['label' => 'Orodha ya miamala', 'icon' => 'money text-blue', 'url' => ['/today-entry/cashier'],],
                            ],
                        ],


                        [
                            'label' => 'Bidhaa',
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('OSOfficer'),
                            'icon' => 'folder-open-o',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Toa bidhaa', 'icon' => 'money text-blue', 'url' => ['/bidhaa-zilizotolewa/create'],],
                                ['label' => 'Zinazosubiriwa kuingia', 'icon' => 'money text-blue', 'url' => ['/matumizi-mengine/ordered'],],
                                ['label' => 'Zilizoingia', 'icon' => 'money text-blue', 'url' => ['/bidhaa-zilizoingia/index'],],
                                ['label' => 'Zilizotoka', 'icon' => 'money text-blue', 'url' => ['/bidhaa-zilizotolewa/index'],],
                                ['label' => 'Zilizobaki store', 'icon' => 'money text-blue', 'url' => ['/bidhaa-zilizobaki/index'],],
                            ],
                        ],


                        [
                            'label' => 'Akaunti za makarani',
                            'icon' => 'folder-open-o',
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Accountant'),
                            'url' => '#',
                            'items' => [
                                ['label' => 'akaunti mpya', 'icon' => 'money text-blue', 'url' => ['/cashier-account/create'],],
                                ['label' => 'Orodha ya akaunti', 'icon' => 'money text-blue', 'url' => ['/cashier-account/index'],],


                            ],
                        ],

                        /*[
                            'label' => 'Ratiba za ma-clerk vituoni',
                            'icon' => 'folder-open-o',
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Accountant'),
                            'url' => '#',
                            'items' => [
                                ['label' => 'Ratiba mpya', 'icon' => 'money text-blue', 'url' => ['/clerk-kituo/create'],],
                                ['label' => 'Ratiba za ma-clerks', 'icon' => 'money text-blue', 'url' => ['/clerk-kituo/index'],],


                            ],
                        ],*/




                        [
                            'label' => 'Document management',
                            'icon' => 'folder-open-o',
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer'),
                            'url' => '#',
                            'items' => [
                                ['label' => 'New Folder', 'icon' => 'money text-orange', 'url' => ['/folder/create'],],
                                ['label' => 'Orodha ya folders', 'icon' => 'money text-success', 'url' => ['/folder/index'],],


                            ],
                        ],
                        [
                            'label' => 'Magari na Mafuta',
                            'icon' => 'folder-open-o',
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('OS'),
                            'url' => '#',
                            'items' => [
                                ['label' => 'Taarifa za kukodi gari', 'icon' => 'money text-orange', 'url' => ['/vehicle-management/create'],],
                                ['label' => 'Orodha ya magari', 'icon' => 'money text-success', 'url' => ['/vehicle-management/index'],],


                            ],
                        ],


                        [
                            'label' => 'Complaints Management',
                            'icon' => 'folder-open-o',
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer'),
                            'url' => '#',
                            'items' => [
                                ['label' => 'Orodha ya complaints', 'icon' => 'money text-success', 'url' => ['/complains/index'],],


                            ],
                        ],


                        [
                            'label' => 'Ripoti',
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Auditor') || Yii::$app->user->can('Accountant'),
                            'icon' => 'sitemap',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Ripoti za budget',
                                    'icon' => 'clock-o',
                                    'url' => '#',
                                    'items' => [

                                        ['label' => 'bajeti', 'icon' => 'file-o', 'url' => ['/report/budget'],],
                                        ['label' => 'bajeti bakaa', 'icon' => 'file-o', 'url' => ['/report/budget-bakaa'],],
                                        ['label' => 'voucher', 'icon' => 'file-o', 'url' => ['/report/voucher'],],


                                    ],
                                ],
                                [
                                    'label' => 'Ripoti za malipo',
                                    'icon' => 'clock-o',
                                    'url' => '#',
                                    'items' => [

                                        ['label' => 'Malipo ya watendaji', 'icon' => 'file-o', 'url' => ['/report/watendaji'],],
                                        ['label' => 'malipo ya maofisa', 'icon' => 'file-o', 'url' => ['/report/maofisa'],],
                                        ['label' => 'malipo ya bidhaa', 'icon' => 'file-o', 'url' => ['/report/bidhaa'],],
                                        ['label' => 'Malipo ya wazee', 'icon' => 'file-o', 'url' => ['malipo/search-all'],],


                                    ],
                                ],

                                [
                                    'label' => 'Ripoti za wazee',
                                    'icon' => 'clock-o',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Wazee Takwimu Kishehia', 'icon' => 'pie-chart text-blue', 'url' => ['/mzee/wazee-shehia'],],
                                        ['label' => 'Wazee wote', 'icon' => 'file-o', 'url' => ['mzee/search-all'],],
                                        ['label' => 'Wazee Waliotenguliwa', 'icon' => 'file-o', 'url' => ['report/restore'],],
                                        ['label' => 'Wazee waliohama', 'icon' =>'circle text-blue','url' => ['report/transferred'],],
                                        ['label' => 'Wazee waliohamia', 'icon' =>'circle text-blue','url' => ['report/received'],],



                                    ],
                                ],
                                [
                                    'label' => 'Takwimu',
                                    'icon' => 'clock-o',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Wazee kiwilaya', 'icon' => 'file-o', 'url' => ['report/wazee-kiwilaya'],],
                                        ['label' => 'Malipo ya wazee kiwilaya', 'icon' => 'file-o', 'url' => ['/report/kiwilaya'],],
                                        ['label' => 'Wazee kiwilaya kwa mwaka', 'icon' => 'file-o', 'url' => ['report/wazee-mwaka'],],
                                        ['label' => 'Wenye fingerprint kiwilaya', 'icon' => 'file-o', 'url' => ['report/with-finger-district'],],
                                        ['label' => 'Malipo ya wazee mwaka', 'icon' => 'file-o', 'url' => ['/report/mwaka'],],
                                        ['label' => 'Malipo ya wazee kimkoa', 'icon' => 'file-o', 'url' => ['/report/kimkoa'],],
                                        ['label' => 'Wazee waliofariki kiwilaya', 'icon' => 'file-o', 'url' => ['/report/dead-kiwilaya'],],


                                    ],
                                ],
                                [
                                    'label' => 'Custom Reports',
                                    'icon' => 'clock-o',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Custom Reports', 'icon' => 'file-o', 'url' => ['/reportico'],],


                                    ],
                                ],


                            ],
                        ],



                        [
                            'visible' => Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('admin'),
                            "label" => Yii::t('app', 'Mpangilio'),
                            "url" => "#",
                            "icon" => "fa fa-lock",
                            "items" => [
                                [
                                    'label' => 'Automation Settings',
                                    'icon' => 'lock',
                                    'visible' => Yii::$app->user->can('admin'),
                                    'url' => ['automation-settings/index'],

                                ],

                                /* [
                                     'visible' => yii::$app->User->can('PensionOfficer')|| yii::$app->User->can('admin'),
                                     "label" => Yii::t('app','Events'),
                                     "url" =>["/event-type/index"],
                                     "icon" => "fa fa-angle-double-right",
                                 ],*/
                                [
                                    'visible' => Yii::$app->user->can('admin') || yii::$app->User->can('Auditor'),
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
                                    'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer'),
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
                                    'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('HQ-PensionOfficer'),
                                    'label' => Yii::t('app', 'Manage User Roles'),
                                    'url' => ['/role/index'],
                                    'icon' => 'fa fa-lock',
                                ],

                            ],
                        ],
                    ],
                ]
            );
        }?>

    </section>

</aside>
