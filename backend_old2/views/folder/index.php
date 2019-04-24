<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FolderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Folders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-index">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA FOLDERS</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> Folder Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Folders'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>


    <?php
    $folders = \backend\models\Folder::find()->where(['zone_id' => \backend\models\Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)])->all();
    if($folders != null) {
        foreach ($folders as $folder) {

            ?>
            <div class="gallery text-center">
                <i class="fa fa-folder text text-yellow" style="font-size:60px;color:red;"></i>
               <?php
                if($folder->department_id == \backend\models\Wafanyakazi::getDepartmentID(Yii::$app->user->identity->user_id)) { ?>

                    <div class="desc"><?= Html::a($folder->jina, ['view', 'id' => $folder->id]) ?>
                        <?php if(!file_exists('uploads/' . $folder->jina)){
                        mkdir(Url::to('uploads/' . $folder->jina),0777,true);
                        ?>
                        (<?= count(\yii\helpers\FileHelper::findFiles('uploads/' . $folder->jina)); ?>)
                        <?php }
                        else{
                            ?>
                            (<?= count(\yii\helpers\FileHelper::findFiles('uploads/' . $folder->jina)); ?>)
                        <?php } ?>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="desc"><?= $folder->jina?>
                        <?php if(!file_exists('uploads/' . $folder->jina)){
                        mkdir(Url::to('uploads/' . $folder->jina),0777,true);
                        ?>
                        (<?= count(\yii\helpers\FileHelper::findFiles('uploads/' . $folder->jina)); ?>)
                        <?php }
                        else{
                        ?>
                        (<?= count(\yii\helpers\FileHelper::findFiles('uploads/' . $folder->jina)); ?>)
                        <?php } ?>
                    </div>
                <?php
                }
                ?>
            </div>
            <?php
        }
    }else{
        echo 'Hakuna folder lilitengenezwa';
    }
    ?>
</div>

<style>
    div.gallery {
        margin: 5px;
        border: 1px solid #ccc;
        float: left;
        width: 180px;
    }

    div.gallery:hover {
        border: 1px solid #777;
    }

    div.gallery img {
        width: 100%;
        height: auto;
    }

    div.desc {
        padding: 15px;
        text-align: center;
    }
</style>
