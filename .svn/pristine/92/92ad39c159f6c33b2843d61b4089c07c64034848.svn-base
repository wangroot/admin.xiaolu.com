<?php

use yii\helpers\Html;
use app\extensions\grid\HodoGridView;
use yii\widgets\Pjax;
use app\modules\adsplatform\models\Datadict;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\apps\models\GameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '广告类型列表';
$this->params['breadcrumbs'][] = ['label'=>$this->title,'iconClass' => 'fa fa-table'];
?>

<div class="panel panel-success">

    <div class="panel-heading">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <?php Pjax::begin(['id' => 'hodo-grid-view' ,'formSelector' => false])?>
    <div class="panel-body">
        <?= HodoGridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'name',
                [
                    'attribute' => 'platform',
                    'value' => function($data){
                        return Datadict::getDataValue('position_platform', $data->platform);
                    },
                ],
                [
                    'attribute' => 'type',
                    'value' => function($data){
                        return Datadict::getDataValue('position_type', $data->type);
                    },
                ],
                'total',
                'height',
                'width',
                'create_time:date',
                [
                    'attribute' => 'status',
                    'value' => function($data){
                        return Datadict::getDataValue('strategy_list_status', $data->status);
                    },
                ],

                [
                    'class' => 'app\extensions\grid\HodoActionColumn',
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end()?>
</div>


