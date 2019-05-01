<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GlCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gl Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gl-category-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'cate_id',
            'category_description',
            'category_name',
            'maker_id',
            'maker_stamptime',
            // 'checker_id',
            // 'checker_stamptime',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>

</div>
