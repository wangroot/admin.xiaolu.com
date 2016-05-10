<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DatadictSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Datadicts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datadict-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Datadict', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type',
            'key',
            'value',
            'sort',
            // 'status',
            // 'group',
            // 'control',
            // 'default',
            // 'apps',
            // 'component',
            // 'display',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
