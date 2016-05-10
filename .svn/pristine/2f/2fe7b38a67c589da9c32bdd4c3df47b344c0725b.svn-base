<?php

use yii\helpers\Html;
use app\extensions\grid\HodoGridView;
use app\modules\adsplatform\models\Datadict;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\adsplatform\models\StrategyListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '策略规则列表';
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
            'id',
            'strategy_id',
            [
                'attribute' => 'type',
                'value' => function($data){
                    return Datadict::getDataValue('strategy_list_type', $data->type);
                },
            ],
            [
                'attribute' => 'rule',
                'value' => function($data){
                    return Datadict::getDataValue('strategy_list_rule', $data->rule);
                },
            ],
            'rule_content',
            // 'create_time:datetime',
            // 'update_time:datetime',
            // 'status',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return Datadict::getDataValue('strategy_list_status', $data->status);
                },
            ],
            [
                'attribute' => 'create_time',
                'format' => ['date','php:Y-m-d']
            ], [
                'class' => 'app\extensions\grid\HodoActionColumn',
                'template' => '{view} {update} {delete} <br/>{switch-status}',
            ],
        ],
    ]); ?>

    </div>
    <?php Pjax::end()?>
</div>
