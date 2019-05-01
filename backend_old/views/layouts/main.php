
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
        font-size: 22px;
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
<body class="hold-transition skin-blue sidebar-mini">
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
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>ZUPS</b>MIS</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>ZUPS MIS</b></span>
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


                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">
                                <?php
                                if (!Yii::$app->user->isGuest) {
                                   echo Yii::$app->user->identity->username;
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
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
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
                            'url' => '#',
                            'items' => [
                                ['label' => 'Zones', "icon" => "circle text-blue", 'url' => ['/zone/index']],

                                ['label' => 'Mikoa', "icon" => "circle text-blue", 'url' => ['/mkoa/index']],
                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "Wilaya",
                                    "url" => ["/wilaya/index"],
                                    "icon" => "circle text-blue",
                                ],

                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "Shehia",
                                    "url" => ["/shehia/index"],
                                    "icon" => "circle text-blue",
                                ],


                            ],


                        ],

                        [
                            'label' => 'Departments',
                            'icon' => 'folder',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Department Mpya',  'icon' => 'user-plus text-blue', 'url' => ['/department/create'],],
                                ['label' => 'Orodha ya departments',  'icon' => 'circle text-blue', 'url' => ['/department/index'],],


                            ],
                        ],

                        [
                            'label' => 'Wafanyakazi',
                            'icon' => 'user',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Mfanyakazi Mpya',  'icon' => 'user-plus text-blue', 'url' => ['/wafanyakazi/create'],],
                                ['label' => 'Orodha ya Wafanyakazi',  'icon' => 'circle text-blue', 'url' => ['/wafanyakazi/index'],],


                            ],
                        ],
                        [
                            'label' => 'Sheha',
                            'icon' => 'user',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Sheha Mpya',  'icon' => 'user-plus text-blue', 'url' => ['/sheha/create'],],
                                ['label' => 'Orodha ya Masheha',  'icon' => 'circle text-blue', 'url' => ['/sheha/index'],],


                            ],
                        ],

                        [
                            'label' => 'Wazee',
                            'icon' => 'user',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Mzee Mpya',  'icon' => 'user-plus text-blue', 'url' => ['/mzee/create'],],
                                ['label' => 'Orodha ya wazee',  'icon' => 'circle text-blue', 'url' => ['/mzee/index'],],


                            ],
                        ],

                        [
                            'label' => 'Vouchers',
                            'icon' => 'money',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Voucher Mpya',  'icon' => 'circle text-blue', 'url' => ['/voucher/index'],],
                                ['label' => 'Orodha ya vouchers',  'icon' => 'circle text-blue', 'url' => ['/voucher/index'],],


                            ],
                        ],

                        [
                            'label' => 'Malipo ya wazee',
                            'icon' => 'bank',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Malipo mapya',  'icon' => 'money text-blue', 'url' => ['/malipo/create'],],
                                ['label' => 'Orodha ya malipo',  'icon' => 'circle text-blue', 'url' => ['/malipo/index'],],


                            ],
                        ],




                        [
                            'visible' => Yii::$app->user->can('Registrar') || Yii::$app->user->can('admin'),
                            "label" =>Yii::t('app','Mpangilio'),
                            "url" => "#",
                            "icon" => "fa fa-gears",
                            "items" => [

                                [
                                    'label' => 'Uhusiano',
                                    'icon' => 'circle text-blue',
                                    'visible' => Yii::$app->user->can('admin'),
                                    'url' => ['uhusiano/index'],

                                ],
                                [
                                    'label' => 'Vitengo vya kazi',
                                    'icon' => 'circle text-blue',
                                    'visible' => Yii::$app->user->can('admin'),
                                    'url' => ['kazi/index'],

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
        <section class="content" style="background: #f9fafc">
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

        setTimeout(loadShehas, 3000);

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

        setTimeout(loadZones, 3000);

    });
    function loadZones() {
        var id =document.getElementById("wafanyakazi-zone_id").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['mkoa/load-all', 'id' => '']);?>" + id, function (data) {


            document.getElementById("wafanyakazi-mkoa_id").innerHTML = data;
            document.getElementById("loader1").style.display = "none";



        });


    }

    $("#wafanyakazi-mkoa_id").change(function(){
        document.getElementById("loader1").style.display = "block";

        setTimeout(loadMikoa, 3000);

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

        setTimeout(listMikoa, 3000);

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

        setTimeout(listWilaya, 3000);

    });
    function listWilaya() {
        var id =document.getElementById("mzee-wilaya_id").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['shehia/load-all', 'id' => '']);?>" + id, function (data) {


            document.getElementById("mzee-shehia_id").innerHTML = data;
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

            alert("Hakuna mawasiliano na NIDA");
        }
    });






</script>


