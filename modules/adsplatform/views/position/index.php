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
                [
                    'label' => 'id',
                    'attribute' => 'id'
                ],
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
                /*'total',
                'height',
                'width',*/

                [
                    'attribute' => 'create_time',
                    'format' => ['date','php:Y-m-d H:i']
                ],
                [
                    'format' => 'html',
                    'attribute' => 'status',
                    'value' => function($data){
                        $style = ['style'=>'color:#738186'];
                        if($data->status)
                            $style = ['style'=>'color:#22bf6c'];
                        return Html::tag('div',Datadict::getDataValue('strategy_list_status', $data->status),$style);
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


