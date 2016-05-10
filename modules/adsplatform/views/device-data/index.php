<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\adsplatform\models\DeviceDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Device Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Device Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ad_id',
            'uuid',
            'mac',
            'channel',
            // 'package_name:ntext',
            // 'brand',
            // 'model',
            // 'longitude',
            // 'latitude',
            // 'create_time:datetime',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
