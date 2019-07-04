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
                                    'visible' => Yii::$app->user->can('viewSetups'),
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Zones', 'visible' => Yii::$app->user->can('viewZones'), "icon" => "circle text-blue", 'url' => ['/zone/index']],

                                        ['label' => 'Mikoa', 'visible' => Yii::$app->user->can('viewRegions'),"icon" => "circle text-blue", 'url' => ['/mkoa/index']],
                                        [
                                            'visible' => Yii::$app->user->can('viewDistricts'),
                                            "label" => "Wilaya",
                                            "url" => ["/wilaya/index"],
                                            "icon" => "circle text-blue",
                                        ],

                                        [
                                            'visible' => Yii::$app->user->can('viewWards'),
                                            "label" => "Shehia",
                                            "url" => ["/shehia/index"],
                                            "icon" => "circle text-blue",
                                        ],

                                        [
                                            'label' => 'Vitengo vya kazi',
                                            'icon' => 'circle text-blue',
                                            'visible' => Yii::$app->user->can('viewJobs'),
                                            'url' => ['kazi/index'],

                                        ],
                                        [
                                            'label' => 'Departments',
                                            'visible' => Yii::$app->user->can('viewDepartments'),
                                            'icon' => 'folder-open-o',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Department Mpya',   'visible' => Yii::$app->user->can('createDepartment'),'icon' => 'circle text-blue', 'url' => ['/department/create'],],
                                                ['label' => 'Orodha ya departments', 'icon' => 'circle text-blue', 'url' => ['/department/index'],],


                                            ],
                                        ],
                                        [

                                            'label' => 'Wafanyakazi',
                                            'visible' => Yii::$app->user->can('viewStaffs'),
                                            'icon' => 'folder-open-o',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Mfanyakazi Mpya', 'visible' => Yii::$app->user->can('createStaff'), 'icon' => 'user-plus text-blue', 'url' => ['/wafanyakazi/create'],],
                                                ['label' => 'Orodha ya Wafanyakazi', 'icon' => 'circle text-blue', 'url' => ['/wafanyakazi/index'],],


                                            ],
                                        ],
                                        [
                                            'label' => 'Sheha',
                                            'visible' => Yii::$app->user->can('viewSheha'),
                                            'icon' => 'folder-open-o',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Sheha Mpya', 'visible' => Yii::$app->user->can('createSheha'), 'icon' => 'user-plus text-blue', 'url' => ['/sheha/create'],],
                                                ['label' => 'Orodha ya Masheha','visible' => Yii::$app->user->can('viewSheha'), 'icon' => 'circle text-blue', 'url' => ['/sheha/index'],],


                                            ],
                                        ],
                                        [
                                            'label' => 'Vituo vya malipo',
                                            'visible' => Yii::$app->user->can('viewPayPoints'),
                                            'icon' => 'folder-open-o',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Kituo kipya',  'visible' => Yii::$app->user->can('createPayPoint'),'icon' => 'money text-blue', 'url' => ['/vituo/create'],],
                                                ['label' => 'Orodha ya Vituo', 'visible' => Yii::$app->user->can('viewPayPoints'), 'icon' => 'circle text-blue', 'url' => ['/vituo/index'],],
                                                ['label' => 'Shehia ndani ya vituo',  'visible' => Yii::$app->user->can('viewPayPoints'),'icon' => 'circle text-blue', 'url' => ['/kituo-shehia/index'],],


                                            ],
                                        ],


                                    ],


                                ],


                                [
                                    'label' => 'Wazee',
                                    'icon' => 'folder-open-o',
                                    'visible' => Yii::$app->user->can('viewBeneficiary'),
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Mzee Mpya','visible' => Yii::$app->user->can('createBeneficiary'), 'icon' => 'user-plus text-blue', 'url' => ['/mzee/create'],],
                                        ['label' => 'Hamisha Mzee','visible' => Yii::$app->user->can('transferBeneficiary'), 'icon' => 'reply text-warning', 'url' => ['/hamisha-mzee/create'],],
                                        ['label' => 'Wazee wapya','visible' => Yii::$app->user->can('viewRegistered'), 'icon' => 'circle text-orange', 'url' => ['/mzee/pending'],],
                                        ['label' => 'Wazee Waliohakikiwa','visible' => Yii::$app->user->can('viewVetted'), 'icon' => 'circle text-orange', 'url' => ['/mzee/vetted'],],
                                        ['label' => 'Wazee Wanaosubiri Malipo','visible' => Yii::$app->user->can('viewEligibles'), 'icon' => 'circle text-green', 'url' => ['/mzee/index'],],
                                        ['label' => 'Wazee Waliokubaliwa ', 'visible' => Yii::$app->user->can('viewEligibles'), 'icon' => 'circle text-green', 'url' => ['/mzee/wazee-wote'],],
                                        ['label' => 'Wenye Fingerprint ', 'visible' => Yii::$app->user->can('viewFingerPrint'),'icon' => 'circle text-green', 'url' => ['/mzee/with-finger'],],
                                        ['label' => 'Waliokataliwa ','visible' => Yii::$app->user->can('viewRejected'), 'icon' => 'circle text-red', 'url' => ['/mzee/rejected'],],
                                        ['label' => 'Waliositishwa ', 'visible' => Yii::$app->user->can('viewSuspended'),'icon' => 'circle text-red', 'url' => ['/mzee/suspended'],],
                                        ['label' => 'Ingiza Mzee aliyefariki', 'visible' => Yii::$app->user->can('inputDeadBeneficiary'),'icon' => 'user-plus text-red', 'url' => ['/mzee/new-dead'],],
                                        ['label' => 'Wazee Waliofariki ','visible' => Yii::$app->user->can('viewDead'), 'icon' => 'circle text-red', 'url' => ['/mzee/died'],],
                                        ['label' => 'Wazee Waliohamishwa ','visible' => Yii::$app->user->can('viewTransfered'), 'icon' => 'circle text-warning', 'url' => ['/hamisha-mzee/index'],],
                                        [
                                            'label' => 'Watu wa karibu',
                                            'icon' => 'folder-open-o',
                                            'visible' => Yii::$app->user->can('viewNextOfKin'),
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'mtu wa karibu Mpya',  'visible' => Yii::$app->user->can('createNextOfKin'), 'icon' => 'circle text-blue', 'url' => ['/msaidizi-mzee/create'],],
                                                ['label' => 'Orodha ya watu wa karibu', 'icon' => 'money text-blue', 'url' => ['/msaidizi-mzee/index'],],
                                                ['label' => 'Wenye Fingerprint ',  'icon' => 'circle text-green', 'url' => ['/msaidizi-mzee/with-finger'],],


                                            ],
                                        ],

                                        [
                                            'label' => 'Mpangilio',
                                            'icon' => 'folder-open-o',
                                            'visible' => Yii::$app->user->can('viewBeneficiarySettings'),
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Aina ya viambatanisho', 'icon' => 'circle text-blue', 'url' => ['/viambatanisho/index'],],
                                                [
                                                    'label' => 'Uhusiano',
                                                    'icon' => 'circle text-blue',

                                                    'url' => ['uhusiano/index'],

                                                ],

                                                [
                                                    'label' => 'Kazi za wazee',
                                                    'icon' => 'circle text-blue',
                                                    // 'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                                    'url' => ['kazi-mzee/index'],

                                                ],
                                                [
                                                    'label' => 'Magonjwa ya wazee',
                                                    'icon' => 'circle text-blue',
                                                    // 'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                                    'url' => ['magonjwa/index'],

                                                ],
                                                [
                                                    'label' => 'Aina za ulemavu',
                                                    'icon' => 'circle text-blue',
                                                    // 'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                                    'url' => ['ulemavu/index'],

                                                ],
                                                [
                                                    'label' => 'Vipato vya wazee',
                                                    'icon' => 'circle text-blue',
                                                    // 'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                                    'url' => ['vipato/index'],

                                                ],

                                                [
                                                    'label' => 'Pension Zingine',
                                                    'icon' => 'circle text-blue',
                                                    // 'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                                    'url' => ['pension-nyingine/index'],

                                                ],

                                                [
                                                    'label' => 'Aina ya Vitambulisho',
                                                    'icon' => 'circle text-blue',
                                                    // 'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                                    'url' => ['aina-ya-kitambulisho/index'],

                                                ],
                                                [
                                                    'label' => 'Blood group',
                                                    'icon' => 'circle text-blue',
                                                    // 'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('DataClerk'),
                                                    'url' => ['blood-group/index'],

                                                ],
                                            ]
                                        ]


                                    ],
                                ],


                                [
                                    'visible' => Yii::$app->user->can('viewBudget'),
                                    'label' => 'Bajeti',
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'items' => [
                                        [
                                            'label' => 'Bajeti Mpya',
                                            'visible' => Yii::$app->user->can('createBudget'),
                                            'icon' => 'circle text-blue', 'url' => ['/budget/create'],

                                        ],
                                        [
                                            'label' => 'Thibitisha Bajeti',  'icon' => 'circle text-blue',
                                            'url' => ['/budget/pending'],
                                            'visible' => Yii::$app->user->can('approveBudget'),

                                        ],
                                        [
                                            'label' => 'Fund Bajeti',
                                            'icon' => 'circle text-blue',
                                            'visible' => Yii::$app->user->can('fundBudget'),
                                            'url' => ['/fund-budget/create'],

                                        ],

                                        [
                                            'label' => 'Orodha ya Bajeti',
                                            'icon' => 'circle text-blue',
                                            // 'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('Accountant'),
                                            'url' => ['/budget/index'],
                                        ],
                                        ['label' => 'Bajeti zilizofungwa mahesabu', 'visible' => Yii::$app->user->can('viewBudgetBalance'), 'icon' => 'circle text-blue', 'url' => ['/budget-monthly-balance/index'],],


                                        [
                                            'label' => 'Orodha ya Bajeti kuu',
                                            'icon' => 'circle text-blue',
                                            'visible' => Yii::$app->user->can('viewMainBudget'),
                                            'url' => ['/zups-budget/index'],

                                        ],
                                        [
                                            'label' => 'Vocha',
                                            'icon' => 'folder-open-o',
                                            'visible' => Yii::$app->user->can('viewVoucher'),
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Orodha ya Vocha', 'icon' => 'circle text-blue', 'url' => ['/voucher/index'],],
                                                ['label' => 'Print Vocha', 'visible' => Yii::$app->user->can('printVoucher'), 'icon' => 'print text-blue', 'url' => ['/voucher/kituo-voucher'],],
                                                ['label' => 'Eligibles', 'visible' => Yii::$app->user->can('viewEligibles'),'icon' => 'print text-blue', 'url' => ['/mzee/eligibles'],],


                                            ],
                                        ],
                                        [
                                            'label' => 'Mahitaji mbalimbali',
                                            'icon' => 'folder-open-o',
                                            'url' => '#',
                                            'visible' => Yii::$app->user->can('viewBudgetSettings'),
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
                                    'visible' => Yii::$app->user->can('viewAccounting'),
                                    "url" => "#",
                                    "icon" => "fa fa-clock-o",
                                    "items" => [
                                        [
                                            'visible' => Yii::$app->user->can('viewGls'),
                                            "label" => Yii::t('app', 'System General Ledgers'),
                                            "url" => ["/general-ledger/index"],
                                            "icon" => "fa fa-angle-double-right",
                                        ],
                                        [
                                            'visible' => yii::$app->User->can('superadmin'),
                                            "label" => Yii::t('app', 'Types'),
                                            "url" => ["/gl-type/index"],
                                            "icon" => "fa fa-angle-double-right",
                                        ],
                                        [
                                            'visible' => yii::$app->User->can('superadmin'),
                                            "label" => Yii::t('app', 'Category'),
                                            "url" => ["/gl-category/index"],
                                            "icon" => "fa fa-angle-double-right",
                                        ],
                                        [

                                            'visible' => yii::$app->User->can('viewGlBalance'),
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

                                    ],


                                ],


                                [
                                    'label' => 'Miamala ya Kifedha',
                                    'visible' => yii::$app->User->can('viewTransaction'),
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'items' => [


                                        [
                                            'label' => 'Makarani',
                                            //'visible' => yii::$app->User->can('viewCashierTransaction'),
                                            'icon' => 'folder-open-o',
                                            'url' => '#',
                                            'items' => [

                                                ['label' => 'Muamala Mpya', 'visible' => yii::$app->User->can('assignCashCashier'), 'icon' => 'money text-blue', 'url' => ['/teller/create'],],
                                                ['label' => 'Isiyohakikiwa bado', 'icon' => 'money text-blue', 'url' => ['/teller/pending'],],
                                                ['label' => 'Orodha ya miamala', 'icon' => 'money text-blue', 'url' => ['/teller/index'],],
                                            ],
                                        ],

                                        [
                                            'label' => 'Watendaji',
                                            // 'visible' => yii::$app->User->can('viewCashierTransaction'),

                                            'icon' => 'folder-open-o',
                                            'url' => '#',
                                            'items' => [

                                                ['label' => 'Muamala Mpya',  'visible' => yii::$app->User->can('payCashier'),'icon' => 'money text-blue', 'url' => ['/miamala-watendaji/create'],],
                                                ['label' => 'Orodha ya miamala', 'icon' => 'money text-blue', 'url' => ['/miamala-watendaji/index'],],
                                                ['label' => 'Watendaji waliolipwa', 'icon' => 'money text-blue', 'url' => ['/malipo-watendaji/index'],],

                                            ],
                                        ],
                                        [
                                            'label' => 'Malipo ya Maafisa',
                                            // 'visible' => yii::$app->User->can('viewCashierTransaction'),
                                            'icon' => 'folder-open-o',
                                            'url' => '#',
                                            'items' => [

                                                ['label' => 'muamala mpya', 'visible' => yii::$app->User->can('payCashier'), 'icon' => 'circle text-blue', 'url' => ['/malipo-maafisa/create'],],
                                                ['label' => 'Orodha ya miamala', 'icon' => 'circle text-blue', 'url' => ['/malipo-maafisa/index'],],
                                                ['label' => 'Miamala iliyopakiwa', 'icon' => 'circle text-blue', 'url' => ['/uploaded-files/index'],],
                                                ['label' => 'Malipo template', 'icon' => 'circle text-blue', 'url' => ['/vituo/list'],],

                                            ],
                                        ],
                                        [
                                            'label' => 'Malipo ya bidhaa',
                                            // 'visible' => yii::$app->User->can('viewCashierTransaction'),
                                            'icon' => 'folder-open-o',
                                            'url' => '#',
                                            'items' => [

                                                ['label' => 'Muamala Mpya','visible' => yii::$app->User->can('payVendor'), 'icon' => 'money text-blue', 'url' => ['/matumizi-mengine/create-batch'],],
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
                                            //  'visible' => yii::$app->User->can('viewCashierTransaction'),
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
                                    'visible' => yii::$app->User->can('viewTransaction'),
                                    "url" => "#",
                                    "icon" => "fa fa-clock-o",
                                    "items" => [
                                        [
                                            //'visible' => yii::$app->User->can('Accountant') || yii::$app->User->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || yii::$app->User->can('admin'),
                                            "label" => Yii::t('app', 'Miamala yote'),
                                            "url" => ["/today-entry/index"],
                                            "icon" => "fa fa-angle-double-right",
                                        ],

                                    ],

                                ],
                                [
                                    'label' => 'Kufunga Mahesabu',
                                    'icon' => 'folder-open-o',
                                    'visible' => yii::$app->User->can('viewKufungaMahesabu'),
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Rejesha fedha', 'icon' => 'money text-orange', 'url' => ['/kituo-monthly-balances /pending'],],
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
                                    'visible' => yii::$app->User->can('viewInventory'),
                                    'icon' => 'folder-open-o',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Toa bidhaa',  'visible' => yii::$app->User->can('distributeInventory'),'icon' => 'money text-blue', 'url' => ['/bidhaa-zilizotolewa/create'],],
                                        ['label' => 'Zinazosubiriwa kuingia', 'icon' => 'money text-blue', 'url' => ['/matumizi-mengine/ordered'],],
                                        ['label' => 'Zilizoingia', 'icon' => 'money text-blue', 'url' => ['/bidhaa-zilizoingia/index'],],
                                        ['label' => 'Zilizotoka', 'icon' => 'money text-blue', 'url' => ['/bidhaa-zilizotolewa/index'],],
                                        ['label' => 'Zilizobaki store', 'icon' => 'money text-blue', 'url' => ['/bidhaa-zilizobaki/index'],],
                                    ],
                                ],


                                [
                                    'label' => 'Akaunti za makarani',
                                    'icon' => 'folder-open-o',
                                    'visible' => yii::$app->User->can('viewAccount'),
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'akaunti mpya', 'visible' => yii::$app->User->can('createAccount'), 'icon' => 'money text-blue', 'url' => ['/cashier-account/create'],],
                                        ['label' => 'Orodha ya akaunti', 'icon' => 'money text-blue', 'url' => ['/cashier-account/index'],],


                                    ],
                                ],



                                [
                                    'label' => 'Document management',
                                    'icon' => 'folder-open-o',
                                    'visible' => yii::$app->User->can('viewDocument'),
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'New Folder', 'visible' => yii::$app->User->can('createFolder'), 'icon' => 'money text-orange', 'url' => ['/folder/create'],],
                                        ['label' => 'Orodha ya folders', 'icon' => 'money text-success', 'url' => ['/folder/index'],],


                                    ],
                                ],
                                [
                                    'label' => 'Magari na Mafuta',
                                    'icon' => 'folder-open-o',
                                    'visible' => Yii::$app->user->can('viewFuel'),
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Toa Mafuta', 'icon' => 'money text-orange', 'url' => ['/toa-mafuta/create'],],
                                        ['label' => 'Mafuta yaliyotolewa', 'icon' => 'money text-orange', 'url' => ['/toa-mafuta/index'],],
                                        ['label' => 'Orodha ya magari', 'icon' => 'money text-success', 'url' => ['/vehicle-management/index'],],


                                    ],
                                ],


                                [
                                    'label' => 'Complaints Management',
                                    'icon' => 'folder-open-o',
                                    'visible' => yii::$app->User->can('viewComplaints'),
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Orodha ya complaints', 'icon' => 'money text-success', 'url' => ['/complains/index'],],


                                    ],
                                ],


                                [
                                    'label' => 'Ripoti',
                                    'visible' => yii::$app->User->can('viewReport'),
                                    'icon' => 'sitemap',
                                    'url' => '#',
                                    'items' => [
                                        [
                                            'label' => 'Ripoti za budget',
                                            'icon' => 'clock-o',
                                            'visible' => yii::$app->User->can('viewBudgetReport'),
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'bajeti',  'icon' => 'file-o', 'url' => ['/report/budget'],],
                                                ['label' => 'bajeti bakaa', 'icon' => 'file-o', 'url' => ['/report/budget-bakaa'],],
                                                ['label' => 'voucher', 'icon' => 'file-o', 'url' => ['/report/voucher'],],

                                            ],
                                        ],
                                        [
                                            'label' => 'Ripoti za malipo',
                                            'visible' => yii::$app->User->can('viewTransactionsReport'),
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
                                            'visible' => yii::$app->User->can('viewBeneficiaryReport'),
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
                                    'visible' => yii::$app->User->can('viewSettings'),
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
                                            'visible' => yii::$app->User->can('createUser'),
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
                                            'visible' => Yii::$app->user->can('admin'),
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




