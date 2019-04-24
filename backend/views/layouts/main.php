
<?php

/**
 * @var $content string
 */

use yii\helpers\Html;
use common\widgets\Alert;


yiister\adminlte\assets\Asset::register($this);


?>

<?php

/* @var $this \yii\web\View */
/* @var $content string */
/*
use yii\dependencies
*/
//Register class
if (class_exists('ramosisw\CImaterial\web\MaterialAsset')) {
    //ramosisw\CImaterial\web\MaterialAsset::register($this);
}
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <script>
        $("#language").click(function(){
            alert("clicked");
        });

    </script>
    <![endif]-->
    <?php $this->head() ?>
</head>
<style>
    /* The container */
    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 12px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #fff;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
        background-color: #fff;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked ~ .checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<style>
    #loader1 {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 30px;
        height: 30px;
        margin: -75px 0 0 -75px;
        border: 7px solid #e9ebee;
        border-radius: 50%;
        border-top: 7px solid #cccc;
        border-bottom: 7px solid #d8eefa;
        width: 100px;
        height: 100px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Add animation to "page content" */
    .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
        from { bottom:-100px; opacity:0 }
        to { bottom:0px; opacity:1 }
    }

    @keyframes animatebottom {
        from{ bottom:-100px; opacity:0 }
        to{ bottom:0; opacity:1 }
    }
</style>
<style>
    .break { page-break-before: always; }
</style>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini" style="font-size: 12px; font-family: Georgia, "Times New Roman", Times, serif">>
<?php $this->beginBody() ?>

<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\growl\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>ZUPS</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg margin:200px"> <?php



                echo Html::img('uploads/logo-zanzibar.jpg',
                    ['width' => '40px', 'height' => '40px', 'class' => 'img-circle']);
                ?>
            ZUPS - MIS
            </span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>

                  <?php
                                if (!Yii::$app->user->isGuest) {
                                    echo 'Cheo: ';
                                   echo Yii::$app->user->identity->role;
                                   echo ' @ ';
                                   echo \backend\models\Zone::getZoneNameByuserId(Yii::$app->user->identity->user_id);
                                }?>
            </a>

            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Languages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->

                        <ul class="dropdown-menu">

                            <li>
                                <!-- inner menu: contains the messages -->
                                <ul class="menu">
                                    <?php
                                    /*$languages=\backend\models\Language::getAll();
                                    foreach ($languages as $language)
                                    {
                                        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><li style="padding: 10px" id="language">
                                                <i class="fa fa-angle-double-right"></i>
                                            '.$language->title.'
                                            </li></a>';
                                    }*/
                                    ?>
                                </ul><!-- /.menu -->
                            </li>

                        </ul>
                    </li><!-- /.Languages-menu -->
                    <?php
                    if (!Yii::$app->user->isGuest && Yii::$app->User->can('admin')) {
                        //echo Yii::$app->user->identity->username;

                        ?>
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell text-yellow"></i>
                                <?php
                                $incart=\backend\models\Mzee::getApplied();
                                ?>
                                <span class="label label-warning"><?= $incart;?></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li class="header"><i class="fa fa-th text-aqua"></i> Kuna wazee <?= $incart;?> Wanaohitaji uhakiki</li>
                                <?php
                                if($incart>0){
                                    echo  '<li><div class="col-sm-12 text-center" style="padding: 10px">'.Html::a(Yii::t('app', 'Fungua'), ['mzee/pending'], ['class' => 'btn btn-primary']).'</div></li>';
                                }
                                ?>

                            </ul>

                        </li><!-- /.messages-menu -->
                    <?php }?>


                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">
                                <?php
                                if (!Yii::$app->user->isGuest) {
                                   echo 'Habari, '. Yii::$app->user->identity->username;
                                }
                                ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="http://placehold.it/160x160" class="img-circle" alt="User Image">
                                <p>
                                    <?php
                                   if (!Yii::$app->user->isGuest) {

                                       echo Yii::$app->user->identity->username;
                                         $user_id=Yii::$app->user->identity->id;
                                   }

                                    ?>

                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?php
                                    if(!Yii::$app->user->isGuest) {
                                        $user_id=Yii::$app->user->identity->id;
                                        echo Html::beginForm(['/user/profile','id' => $user_id], 'post');
                                        echo Html::submitButton(
                                            'My profile',
                                            ['class' => 'btn btn-link logout']
                                        );
                                        echo Html::endForm();
                                    }?>
                                </div>
                                <div class="pull-right">
                                    <?php
                                    if(!Yii::$app->user->isGuest) {
                                        echo Html::beginForm(['/site/logout'], 'post');
                                        echo Html::submitButton(
                                            'Logout (' . Yii::$app->user->identity->username . ')',
                                            ['class' => 'btn btn-link logout']
                                        );
                                        echo Html::endForm();
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">


            <!-- Sidebar Menu -->
            <?php if (!Yii::$app->user->isGuest) {?>
            <?=

            \yiister\adminlte\widgets\Menu::widget(
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
                                ['label' => 'Wazee Waliosajiliwa',  'icon' => 'circle text-orange', 'url' => ['/mzee/pending'],],
                                ['label' => 'Wazee Waliohakikiwa',  'icon' => 'circle text-orange', 'url' => ['/mzee/vetted'],],
                                ['label' => 'Wazee Waliokubaliwa ',  'icon' => 'circle text-green', 'url' => ['/mzee/index'],],
                                ['label' => 'Wazee Waliokataliwa ',  'icon' => 'circle text-red', 'url' => ['/mzee/rejected'],],
                                ['label' => 'Waliositishiwa huduma ',  'icon' => 'circle text-red', 'url' => ['/mzee/suspended'],],
                                //['label' => 'Walio na umri chini ya 70 ',  'icon' => 'circle text-blue', 'url' => ['/mzee/underage'],],
                                ['label' => 'Wazee Waliofariki ',  'icon' => 'circle text-gray', 'url' => ['/mzee/died'],],
                                ['label' => 'Wazee Walio na fingerprint ',  'icon' => 'circle text-gray', 'url' => ['/mzee/with-finger'],],

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
                            'label' => 'Miamala ya Malipo ya wazee',
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('Accountant'),
                            'icon' => 'folder-open-o',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Muamala Mpya',  'icon' => 'money text-blue', 'url' => ['/teller/create'],],
                                ['label' => 'Orodha ya miamala',  'icon' => 'money text-blue', 'url' => ['/teller/index'],],


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
                            'label' => 'Miamala ya fedha zote',
                            'icon' => 'folder-open-o',
                            'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('SocialWelfareManager'),
                            'url' => '#',
                            'items' => [
                                ['label' => 'Mwamala Mpya',  'icon' => 'money text-blue', 'url' => ['/miamala-fedha/create'],],
                                ['label' => 'Orodha ya miamala',  'icon' => 'money text-blue', 'url' => ['/miamala-fedha/index'],],


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
                            'label' => 'Ripoti',
                            'icon' => 'sitemap',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Takwimu',
                                    'icon' => 'clock-o',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Malipo ya wazee kiwilaya',  'icon' => 'file-o', 'url' => ['/report/kiwilaya'],],
                                        ['label' => 'Malipo ya wazee kimkoa',  'icon' => 'file-o', 'url' => ['/report/kimkoa'],],


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
            )
            ?>
            <?php }?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php // Html::encode(isset($this->params['h1']) ? $this->params['h1'] : $this->title) ?>
            </h1>
            <?php if (isset($this->params['breadcrumbs'])): ?>
                <?=
                \yii\widgets\Breadcrumbs::widget(
                    [
                        'encodeLabels' => false,
                        'homeLink' => [
                            'label' => new \rmrevin\yii\fontawesome\component\Icon('home') .Yii::t('app','Home'),
                            "url" =>  Yii::$app->homeUrl,
                        ],
                        'links' => $this->params['breadcrumbs'],
                    ]
                )
                ?>
            <?php endif; ?>
        </section>

        <!-- Main content -->
        <section class="content" style="font-size: 12px; font-family: Tahoma, sans-serif">
            <div style="padding-top: 10px"><?= Alert::widget() ?></div>

            <?= $content ?>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">

        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; ZUPS MIS <?= date("Y") ?></strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

            </div><!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                            Some information about this general settings option
                        </p>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script>
    $("#shehia-wilaya_id").change(function(){
        document.getElementById("loader1").style.display = "block";

        setTimeout(loadShehas, 500);

    });
    function loadShehas() {
        var id =document.getElementById("shehia-wilaya_id").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['sheha/load-all', 'id' => '']);?>" + id, function (data) {


            document.getElementById("shehia-sheha_id").innerHTML = data;
            document.getElementById("loader1").style.display = "none";



        });


    }




    $("#wafanyakazi-zone_id").change(function(){
        document.getElementById("loader1").style.display = "block";

        setTimeout(loadZones, 500);

    });
    function loadZones() {
        var id =document.getElementById("wafanyakazi-zone_id").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['mkoa/load-all', 'id' => '']);?>" + id, function (data) {


            document.getElementById("wafanyakazi-mkoa_id").innerHTML = data;
            document.getElementById("wafanyakazi-wilaya_id").innerHTML = '<option value=\'--Select--\'>--Chagua Wilaya-- </option>';
            document.getElementById("loader1").style.display = "none";



        });


    }

    $("#wafanyakazi-mkoa_id").change(function(){
        document.getElementById("loader1").style.display = "block";

        setTimeout(loadMikoa, 500);

    });
    function loadMikoa() {
        var id =document.getElementById("wafanyakazi-mkoa_id").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['wilaya/load-all', 'id' => '']);?>" + id, function (data) {


            document.getElementById("wafanyakazi-wilaya_id").innerHTML = data;
            document.getElementById("loader1").style.display = "none";



        });


    }




    $("#mzee-mkoa_id").change(function(){
        document.getElementById("loader1").style.display = "block";

        setTimeout(listMikoa, 500);

    });
    function listMikoa() {
        var id =document.getElementById("mzee-mkoa_id").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['wilaya/load-all', 'id' => '']);?>" + id, function (data) {


            document.getElementById("mzee-wilaya_id").innerHTML = data;
            document.getElementById("loader1").style.display = "none";



        });


    }




    $("#mzee-wilaya_id").change(function(){
        document.getElementById("loader1").style.display = "block";

        setTimeout(listWilaya, 500);

    });
    function listWilaya() {
        var id =document.getElementById("mzee-wilaya_id").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['shehia/load-all', 'id' => '']);?>" + id, function (data) {


            document.getElementById("mzee-shehia_id").innerHTML = data;
            document.getElementById("loader1").style.display = "none";



        });


    }

    $("#wilaya-cashier-id").change(function(){
        document.getElementById("loader1").style.display = "block";

        setTimeout(listKituoWilaya, 500);

    });
    function listKituoWilaya() {
        var id =document.getElementById("wilaya-cashier-id").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['shehia/load-all', 'id' => '']);?>" + id, function (data) {


            document.getElementById("kituo-shehia-id").innerHTML = data;
            document.getElementById("loader1").style.display = "none";



        });


    }




    $("#tar-kuz-id").keyup(function(){

        var date1 = document.getElementById('tar-kuz-id').value;



//alert(date1);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['mzee/get-years', 'id' => '']);?>" + date1 , function (data) {


            //  window.location.reload(true);
            //alert(data);
            document.getElementById("mzee-umri_kusajiliwa").value = data;
            document.getElementById("mzee-umri_sasa").value = data;
        });
    });

    $("#mzee-mzawa_zanzibar").change(function(){
        var origin = document.getElementById("mzee-mzawa_zanzibar").value;
        //alert(origin);
        if(origin == 'Y'){
            document.getElementById("mzee-tarehe_kuingia_zanzibar").disabled = true;
            document.getElementById("mzee-tarehe_kuingia_zanzibar").value = ' ';
        }else if(origin == 'N'){
            document.getElementById("mzee-tarehe_kuingia_zanzibar").disabled = false;
        }else{
            document.getElementById("mzee-tarehe_kuingia_zanzibar").disabled = false;
        }
    });

    $("#mzee-pension_nyingine").change(function(){
        var pension = document.getElementById("mzee-pension_nyingine").value;
        //alert(pension);
        if(pension == 'Y'){
            document.getElementById("mzee-aina_ya_pension").disabled = false;

        }else if(pension == 'N'){
            document.getElementById("mzee-aina_ya_pension").disabled = true;
            document.getElementById("mzee-aina_ya_pension").value = ' ';
        }else{
            document.getElementById("mzee-aina_ya_pension").disabled = false;
        }
    });
    $("#mzee-njia_upokeaji").change(function(){
        var pension = document.getElementById("mzee-njia_upokeaji").value;
       // alert(pension);
        if(pension == 2){
            document.getElementById("malipo-benki-id").style.display = 'block';
            document.getElementById("malipo-simu-id").style.display = 'none';
        }else if(pension == 3){
            document.getElementById("malipo-benki-id").style.display = 'none';
            document.getElementById("malipo-simu-id").style.display = 'block';
        }else{
            document.getElementById("malipo-benki-id").style.display = 'none';
            document.getElementById("malipo-simu-id").style.display = 'none';
        }
    });

    $("#zenji-id").click(function(){
        var zid = document.getElementById("mzee-zanzibar_id").value;
        // alert(pension);
        if(zid == ''){
            alert("Ingiza nambari ya kitambulisho kwanza tafadhari");
        }else{

            alert("Hakuna mawasiliano na ZANID");
        }
    });




    $("#voucher-shehia_id").change(function(){
        document.getElementById("loader1").style.display = "block";

        setTimeout(loadWazee, 500);


    });

    function loadWazee() {
        var id = document.getElementById("voucher-shehia_id").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['mzee/load-all', 'id' => '']);?>" + id, function (data) {


            document.getElementById("voucher-active_wazee_jumla").value = data;
            $.get("<?php echo Yii::$app->urlManager->createUrl(['mzee/calculate-total', 'id' => '']);?>" + data, function (data1) {
                document.getElementById("voucher-jumla_fedha").value = data1;
            });
            document.getElementById("loader1").style.display = "none";



        });




    }


    //load products and set product group
    $("#teller-product").change(function(){
        var id =document.getElementById("teller-product").value;
        //alert(id);
        $("#prodid").html('<i class="fa fa-spinner fa-spin"></i> Looding....');
        $.get("<?php echo Yii::$app->urlManager->createUrl(['product/reference','id'=>'']);?>"+id,function(data) {
            //alert(data);
            document.getElementById("teller-reference").value =data;
            $("#prodid").html('');

        });

        $.get("<?php echo Yii::$app->urlManager->createUrl(['product-event-entry/offset','id'=>'']);?>"+id,function(data) {
            //alert(data);
            document.getElementById("teller-offset_account").value =data;
            $("#prodid").html('');

        });


    });




    $("#cashier-id").change(function(){
        var id =document.getElementById("cashier-id").value;
        $.get("<?php echo Yii::$app->urlManager->createUrl(['cashier-account/get-account','id'=>'']);?>"+id,function(data) {
            //alert(data);
            document.getElementById("teller-txn_account").value =data;
            $("#prodid").html('');

        });


    });

    $("#kituo-id").change(function(){
        var id =document.getElementById("kituo-id").value;
        $.get("<?php echo Yii::$app->urlManager->createUrl(['kituo-monthly-balances/get-balance','id'=>'']);?>"+id,function(data) {
            //alert(data);
            document.getElementById("teller-kituo_balance").value =data;
            document.getElementById("teller-amount").value =data;
            document.getElementById("teller-offset_amount").value =data;
            $("#prodid").html('');

        });


    });

    $("#mzee-nambar").blur(function(){
        var id =document.getElementById("mzee-aina_ya_kitambulisho").value;
        var nid =document.getElementById("mzee-nambar").value;
        $.get("<?php echo Yii::$app->urlManager->createUrl(['mzee/validate-id','id'=>'']);?>"+id +'&nid='+nid,function(data) {
            if(data == true){
                alert('Kitambulisho hiki kimeshatumika');
                document.getElementById("mzee-nambar").value = '';

            }

        });


    });

    $("#mzee-aina_ya_kitambulisho").change(function(){
        var id =document.getElementById("mzee-aina_ya_kitambulisho").value;
        var nid =document.getElementById("mzee-nambar").value;
        if(nid != null) {
            $.get("<?php echo Yii::$app->urlManager->createUrl(['mzee/validate-id', 'id' => '']);?>" + id + '&nid=' + nid, function (data) {
                if (data == true) {
                    alert('Kitambulisho hiki kimeshatumika');
                    document.getElementById("mzee-nambar").value = '';

                }

            });

        }
    });

    $("#msaidizimzee-aina_ya_kitambulisho").change(function(){
        var id =document.getElementById("msaidizimzee-aina_ya_kitambulisho").value;
        var nid =document.getElementById("msaidizimzee-nambari_ya_kitambulisho").value;
        if(nid != null) {
            $.get("<?php echo Yii::$app->urlManager->createUrl(['mzee/validate-id', 'id' => '']);?>" + id + '&nid=' + nid, function (data) {
                if (data == true) {
                    alert('Kitambulisho hiki kimeshatumika');
                    document.getElementById("msaidizimzee-nambari_ya_kitambulisho").value = '';

                }

            });

        }
    });

    $("#msaidizimzee-nambari_ya_kitambulisho").blur(function(){
        var id =document.getElementById("msaidizimzee-aina_ya_kitambulisho").value;
        var nid =document.getElementById("msaidizimzee-nambari_ya_kitambulisho").value;
        if(nid != null) {
            $.get("<?php echo Yii::$app->urlManager->createUrl(['mzee/validate-id', 'id' => '']);?>" + id + '&nid=' + nid, function (data) {
                if (data == true) {
                    alert('Kitambulisho hiki kimeshatumika');
                    document.getElementById("msaidizimzee-nambari_ya_kitambulisho").value = '';

                }

            });

        }
    });


    $("#msaidiz-aina").change(function(){
        var id =document.getElementById("msaidiz-aina").value;
        var nid =document.getElementById("msaidiz-id").value;
        if(nid != null) {
            $.get("<?php echo Yii::$app->urlManager->createUrl(['mzee/validate-id', 'id' => '']);?>" + id + '&nid=' + nid, function (data) {
                if (data == true) {
                    alert('Kitambulisho hiki kimeshatumika');
                    document.getElementById("msaidiz-id").value = '';

                }

            });

        }
    });

    $("#msaidiz-id").blur(function(){
        var id =document.getElementById("msaidiz-aina").value;
        var nid =document.getElementById("msaidiz-id").value;
        if(nid != null) {
            $.get("<?php echo Yii::$app->urlManager->createUrl(['mzee/validate-id', 'id' => '']);?>" + id + '&nid=' + nid, function (data) {
                if (data == true) {
                    alert('Kitambulisho hiki kimeshatumika');
                    document.getElementById("msaidiz-id").value = '';

                }

            });

        }
    });

    $("#teller-amount").blur(function(){
        var amnt =document.getElementById("teller-amount").value;
        var kb =document.getElementById("teller-kituo_balance").value;
        if(amnt > kb) {
          alert('Kiasi unachompa cashier hakitakiwi kuzid balance ya kituo');

            document.getElementById("teller-amount").value='';
            document.getElementById("teller-offset_amount").value='';
        }
    });



    $("#load-schedule").click(function () {
        document.getElementById("loader1").style.display = "block";
        setTimeout(showPage, 500);

    });
    function showPage() {

        var mz=document.getElementById("report-mwezi").value;
        var mk=document.getElementById("report-mwaka").value;
        alert(mz);
        if(mz == ' '){
            alert('Chagua mwezi tafadhari');
            document.getElementById("loader1").style.display = "none";

        }
        if(mk == ' '){
            alert(mk);
            document.getElementById("loader1").style.display = "none";

        }
        $.get("<?php echo Yii::$app->urlManager->createUrl(['report/report-wilaya', 'mz' => '']);?>"+ mz +'&mk='+ mk, function (data) {

            document.getElementById("loader1").style.display = "none";
            $("#malipo-kwa-mwezi").html(data);

        });
    }

    $("#search-form-id").change(function () {
        document.getElementById("loader1").style.display = "block";
        setTimeout(showWazee, 500);

    });
    function showWazee() {
        var id = document.getElementById("search-form-id").value;
        if(id != '') {
            $.get("<?php echo Yii::$app->urlManager->createUrl(['mzee/load-mzee', 'id' => '']);?>" + id, function (data) {

                if (data != null) {
                    document.getElementById("loader1").style.display = "none";
                    document.getElementById("confirm-mzee").style.display = "block";
                    document.getElementById("mzee-to-confirm").style.display = "block";
                    $("#confirm-mzee").html(data);

                } else {
                    alert(data);
                    document.getElementById("loader1").style.display = "none";
                    document.getElementById("confirm-mzee").style.display = "none";
                    document.getElementById("mzee-to-confirm").style.display = "none";

                }

            });
        }else {
            document.getElementById("loader1").style.display = "none";
            document.getElementById("confirm-mzee").style.display = "none";
            //alert(id);
        }
    }

    $("#confirm-mzee-id").click(function () {
        var id=document.getElementById("mzee-id").innerHTML;
        var msid=document.getElementById("msaidizi-id").innerHTML;
        $.get("<?php echo Yii::$app->urlManager->createUrl(['mzee/update-msaidizi', 'id' => '']);?>"+ id +'&msid='+ msid, function (data) {

          if(data == 1){
              alert('Umefanikiwa kumingiza mzee katika kuchukuliwa na msaidizi huyu');
          }else{
             // alert(msid);
              //alert(id);
              alert('Haujafanikiwa zoezi hil');
          }

        });
    });

    $("#inventorymanagement-inventory_type").change(function () {
        document.getElementById("loader1").style.display = "block";
        setTimeout(showInventoryBalance, 500);

    });

    function showInventoryBalance() {
        alert('yes bro');
    }





</script>


