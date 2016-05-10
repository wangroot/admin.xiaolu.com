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

$this->title = '流量策略列表';
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
//                'id',
                'name',
                [
                    'attribute' => 'position_id',
                    'value' => function($data){
                        $result = Position::findOne($data->position_id);
                        return $result['name'];
                    },
                ],
                'weight',
//                [
//                    'label'=>'匹配类型',
//                    'attribute' => 'strategyList',
//                    'value' => function($model){
//                    return Datadict::getDataValue('strategy_list_type', $model->strategyList->type);
//                },
//                ],
//                [
//                    'label'=>'规则',
//                    'attribute' => 'strategyList',
//                    'value' => function($model){
//                        return Datadict::getDataValue('strategy_list_rule', $model->strategyList->rule);
//                    },
//                ],
//                [
//                    'label'=>'策略规则状态',
//                    'attribute' => 'strategyList',
//                    'value' => function($model){
//                        return Datadict::getDataValue('strategy_list_status', $model->strategyList->status);
//                    },
//                ],
//                [
//                    'label'=>'广告绑定权重',
//                    'attribute' => 'strategyAdList',
//                    'value' => 'strategyAdList.weight',
//                ],
//                [
//                    'label'=>'广告标题',
//                    'attribute' => 'strategyAdList',
//                    'value' => function($model ){
//                        $db = Yii::$app->db;
//                        $result = $db->cache(function($db) use($model){
//                            $result = Ad::find()->select('title')->where('id=:a', [':a'=>$model->strategyAdList->ad_id])->one();
//                            return $result;
//                        }, 3600);
//                        return $result->title;
//                    },
//                ],

                [
                    'attribute' => 'status',
                    'value' => function($data){
                        return Datadict::getDataValue('strategy_list_status', $data->status);
                    },
                ],

                [
                    'attribute' => 'create_time',
                    'format' => ['date','php:Y-m-d H:i:s']
                ],

//                [
//                    'class' => 'app\extensions\grid\HodoActionColumn',
//                    'template' => '{strategyListView} {strategyAdListView} {strategyList} {strategyAdList} ',
//                    'buttons' => [
//                        'strategyListView' => function($url,$model){
//                            return Html::a(Html::tag('span','策略规则', ['class'=>'glyphicon glyphicon-sunglasses', 'title'=>'策略规则查看']).Html::endTag('span'), Url::to(['strategy-list/index','strategy_id' => $model->id]),['data-pjax' => '0',]);
//                        },
//                        'strategyAdListView' => function($url, $model){
//                            return Html::a(Html::tag('span','策略广告', ['class'=>'glyphicon glyphicon-leaf', 'title'=>'广告绑定查看']).Html::endTag('span'),  Url::to(['strategy-ad-list/index','strategy_id' => $model->id]),['data-pjax' => '0',]);
//                        },
//                        'strategyList' => function($url,$model){
//                            return Html::a(Html::tag('span','广告类型增加', ['class'=>'glyphicon glyphicon-send', 'title'=>'策略规则']).Html::endTag('span'), Url::to(['strategy-list/create','strategy_id' => $model->id]),['data-pjax' => '0',]);
//                        },
//                        'strategyAdList' => function($url, $model){
//                            return Html::a(Html::tag('span','广告内容增加', ['class'=>'glyphicon glyphicon-font', 'title'=>'广告绑定']).Html::endTag('span'),  Url::to(['strategy-ad-list/create','strategy_id' => $model->id]),['data-pjax' => '0',]);
//                        }
//                    ]
//                ],
                [
                    'header' => '操作',
                    'class' => 'app\extensions\grid\HodoActionColumn',
                    'template' => '{view} {delete} {update} {switch-status}',
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end()?>
</div>

