<?php

use yii\helpers\Html;
use app\extensions\grid\HodoGridView;
use app\modules\adsplatform\models\Datadict;
use yii\widgets\Pjax;
use app\modules\adsplatform\models\Ad;
use yii\helpers\Url;
use app\modules\adsplatform\models\Position;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\adsplatform\models\StrategySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '策略验证列表';
$this->params['breadcrumbs'][] = ['label'=>$this->title,'iconClass' => 'fa fa-table'];
?>
<div class="panel panel-success">

    <div class="panel-heading">
        <?php  echo $this->render('_form',['model' => $model]); ?>
    </div>

    <?php Pjax::begin(['id' => 'hodo-grid-view' ,'formSelector' => false])?>
    <div class="panel-body">
        <?= HodoGridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                  'attribute' => 'id',
                    'label' => 'ID',
                ],

                [
                    'attribute' =>'name',
                    'label' => '名称',
                ],
                [
                    'attribute' => 'position_id',
                    'label' => '广告类型',
                    'value' => function($data){
                        $result = Position::findOne($data['position_id']);
                        return $result['name'];
                    },
                ],
                [
                    'attribute' =>'weight',
                    'label' => '权重',
                ],
                [
                    'format' => 'html',
                    'attribute' => 'status',
                    'label' => '状态',
                    'value' => function($data){

                        $style = ['style'=>'color:#738186'];
                        if($data['status'])
                            $style = ['style'=>'color:#22bf6c'];
                        return Html::tag('div',Datadict::getDataValue('strategy_list_status', $data['status']),$style);
                    },
                ],

                [
                    'attribute' => 'create_time',
                    'label' => '创建时间',
                    'format' => ['date','php:Y-m-d H:i']
                ],
                [
                    'header' => '操作',
                    'class' => 'app\extensions\grid\HodoActionColumn',
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end()?>
</div>

