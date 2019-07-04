<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MalipoWatendaji */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Malipo Watendajis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malipo-watendaji-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'muamala_id',
            'tarehe_ya_kulipwa',
            'jina_kamili',
            'kiasi_alichopewa',
            'kazi_yake',
        ],
    ]) ?>

</div>
