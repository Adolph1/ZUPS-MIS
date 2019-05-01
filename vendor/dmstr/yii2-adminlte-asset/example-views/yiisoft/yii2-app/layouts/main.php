<?php

use common\models\LoginForm;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
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
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper" style="font-size: 12px; font-family: Tahoma, sans-serif">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>
<?php if(!Yii::$app->user->isGuest) { ?>
            <?= $this->render(
                'content.php',
                ['content' => $content, 'directoryAsset' => $directoryAsset]
            ) ?>
            <?php
        }else{
            $model = new LoginForm();
           // echo  $this->render(['site/login',   'model' => $model]);
           return  Yii::$app->response->redirect(Url::to(['site/login', 'model' => $model]));

        }
        ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>

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


    $("#data-clerk-id").change(function(){
        document.getElementById("loader1").style.display = "block";
        alert('yes bro');
        setTimeout(listShehers, 500);

    });
    function listShehers() {
        var id =document.getElementById("data-clerk-id").value;

        alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['shehia/get-sheha', 'id' => '']);?>" + id, function (data) {


            document.getElementById("mzee-mchukua_taarifa_id").innerHTML = data;
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
        $.get("<?php echo Yii::$app->urlManager->createUrl(['shehia/load-remained', 'id' => '']);?>" + id, function (data) {


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

        $.get("<?php echo Yii::$app->urlManager->createUrl(['kituo-monthly-balances/get-breakdown','id'=>'']);?>"+id,function(data) {
            //alert(data);
            document.getElementById("pendings").innerHTML =data;
           // $("#prodid").html('');

        });


    });


    $("#mzee-shehia_id").change(function(){

        document.getElementById("loader1").style.display = "block";
        setTimeout(listShehas(), 500);
        //alert('Yes bro');


    });

    function listShehas() {
        var id =document.getElementById("mzee-shehia_id").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['sheha/load-shehas', 'id' => '']);?>" + id, function (data) {


            document.getElementById("mzee-mchukua_taarifa_id").innerHTML = data;
            document.getElementById("loader1").style.display = "none";



        });


    }


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
    $("#search-mzee-id").change(function () {
        document.getElementById("loader1").style.display = "block";
        setTimeout(showWazee1, 500);

    });
    function showWazee1() {
        var id = document.getElementById("search-mzee-id").value;
        if(id != '') {
            $.get("<?php echo Yii::$app->urlManager->createUrl(['mzee/load-mzee', 'id' => '']);?>" + id, function (data) {

                if (data != null) {
                    document.getElementById("loader1").style.display = "none";
                    document.getElementById("confirm-mzee-msaidizi").style.display = "block";
                    document.getElementById("mzee-to-confirm-msaidizi").style.display = "block";
                    $("#confirm-mzee-msaidizi").html(data);

                } else {
                    alert(data);
                    document.getElementById("loader1").style.display = "none";
                    document.getElementById("confirm-mzee-msaidizi").style.display = "none";
                    document.getElementById("mzee-to-confirm-msaidizi").style.display = "none";

                }

            });
        }else {
            document.getElementById("loader1").style.display = "none";
            document.getElementById("confirm-mzee-msaidizi").style.display = "none";
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
        var id=document.getElementById("inventorymanagement-inventory_type").value;
        $.get("<?php echo Yii::$app->urlManager->createUrl(['inventory-management/get-balance', 'id' => '']);?>"+ id, function (data) {

            document.getElementById("loader1").style.display = "none";
           document.getElementById("inventorymanagement-bakia").value = data;

        });
    }

    $("#matumizimengine-aina_ya_matumizi").change(function () {
        document.getElementById("loader1").style.display = "block";
        document.getElementById("matumizimengine-budget_idadi").value = ' ';
        document.getElementById("matumizimengine-bei").value = ' ';
        setTimeout(showBudgetBalance, 500);

    });


    function showBudgetBalance() {

        var id=document.getElementById("matumizimengine-aina_ya_matumizi").value;
        $.get("<?php echo Yii::$app->urlManager->createUrl(['gharama-mahitaji/get-balance', 'id' => '']);?>"+ id, function (data) {

            document.getElementById("loader1").style.display = "none";
            document.getElementById("matumizimengine-budget_idadi").value = data;

        });

        $.get("<?php echo Yii::$app->urlManager->createUrl(['gharama-mahitaji/get-bei', 'id' => '']);?>"+ id, function (data1) {

            document.getElementById("loader1").style.display = "none";
            document.getElementById("matumizimengine-bei").value = data1;

        });
    }





    $("#msaidizimzee-mkoa_id").change(function(){
        document.getElementById("loader1").style.display = "block";

        setTimeout(listMikoa1, 500);

    });
    function listMikoa1() {
        var id =document.getElementById("msaidizimzee-mkoa_id").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['wilaya/load-all', 'id' => '']);?>" + id, function (data) {


            document.getElementById("msaidizimzee-wilaya_id").innerHTML = data;
            document.getElementById("loader1").style.display = "none";



        });


    }



    $(document).ready(function(){


       // document.getElementById("loader1").style.display = "block";
        setTimeout(listshehias, 500);
    });
    function listshehias() {
        var id =document.getElementById("sheha-wilaya_id").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['shehia/load-all', 'id' => '']);?>" + id, function (data) {


            document.getElementById("sheha-shehia_id").innerHTML = data;
            //document.getElementById("loader1").style.display = "none";



        });


    }


    $("#sheha-wilaya_id").change(function(){
        document.getElementById("loader1").style.display = "block";

        setTimeout(listshehias1, 500);

    });
    function listshehias1() {
        var id =document.getElementById("sheha-wilaya_id").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['shehia/load-all', 'id' => '']);?>" + id, function (data) {


            document.getElementById("sheha-shehia_id").innerHTML = data;
            document.getElementById("loader1").style.display = "none";



        });


    }


    $("#search-mzee").change(function(){


        setTimeout(searchResult, 500);

    });

    function searchResult() {
        var id =document.getElementById("search-mzee").value;

        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['mzee/search', 'id' => '']);?>" + id, function (data) {



        });

        }




    $("#fundbudget-budget_id").change(function(){

        document.getElementById("loader1").style.display = "block";
        setTimeout(searchBudget, 500);

    });

    function searchBudget() {
        var id =document.getElementById("fundbudget-budget_id").value;
        //alert(id);

        $.get("<?php echo Yii::$app->urlManager->createUrl(['budget/get-wazee','id'=>'']);?>"+id,function(data) {
           // alert(data);
            document.getElementById("fundbudget-wazee").value =data;
            //$("#prodid").html('');

        });

        $.get("<?php echo Yii::$app->urlManager->createUrl(['budget/get-uendeshaji','id'=>'']);?>"+id,function(data) {
            //alert(data);
            document.getElementById("fundbudget-uendeshaji").value =data;
          //  $("#prodid").html('');

        });

        $.get("<?php echo Yii::$app->urlManager->createUrl(['budget/get-jumla','id'=>'']);?>"+id,function(data) {
            //alert(data);
            document.getElementById("fundbudget-jumla").value =data;
            //  $("#prodid").html('');

        });
        document.getElementById("loader1").style.display = "none";


    }






</script>

<script>

    $("#bidhaazilizotolewa-bidhaa_id").change(function () {
        document.getElementById("loader1").style.display = "block";
        document.getElementById("bidhaazilizotolewa-jumla").value = ' ';
        document.getElementById("bidhaazilizotolewa-idadi").value = ' ';
        setTimeout(showOutBalance, 500);

    });


    function showOutBalance() {

        var id=document.getElementById("bidhaazilizotolewa-bidhaa_id").value;
        $.get("<?php echo Yii::$app->urlManager->createUrl(['bidhaa-zilizobaki/get-balance', 'id' => '']);?>"+ id, function (data) {

            document.getElementById("loader1").style.display = "none";
            document.getElementById("bidhaazilizotolewa-jumla").value = data;

        });


    }
</script>



