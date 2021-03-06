<?php

use yii\helpers\Html;
use app\extensions\grid\HodoGridView;
use yii\widgets\Pjax;
use app\modules\adsplatform\models\Datadict;
use app\modules\adsplatform\models\Position;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\adsplatform\models\AdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '广告内容';
$this->params['breadcrumbs'][] = ['label' => '自主广告列表', 'iconClass' => 'fa fa-table'];
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
                    'label' => 'ID',
                    'attribute' => 'id',
                ],
                'title',
                //'subtitle',
                [
                    'attribute' => 'position_id',
                    'value' => function($data){
                        $result = Position::findOne($data->position_id);
                        return $result['name'];
                    },
                    'options' => [
                        'colgroup'=>['col'=>2]
                    ]
                ],
                [
                    'attribute'=>'type',
                    'value' => function($data){
                        return Datadict::getDataValue('ad_type', $data->type);
                    }
                ],
                [
                    'attribute'=>'target',
                    'value' => function($data){
                        return Datadict::getDataValue('ad_target', $data->target);
                    }
                ],
                // 'detail:ntext',
                // 'image:ntext',
                // 'image_vertical:ntext',
                // 'link:ntext',
                // 'channel',
                // 'package_name',
                // 'version_code',
                // 'app_id',
                // 'ad_id',
//                [
//                    'attribute' => 'start_time',
//                    'format' => ['date','php:Y-m-d']
//                ],
//                [
//                    'attribute' => 'end_time',
//                    'format' => ['date','php:Y-m-d']
//                ],
//                 'show_time',
//                 'collect_data',
//                 'ceiling_view',
//                 'ceiling_day_view',
//                 'ceiling_day_click',
//                 'ceiling_total_view',
//                 'ceiling_total_click',
//                 'total_view',
//                 'total_click',
//                 'total_download',
//                 'total_install',
//                 'total_failure',

                [
                    'format' => 'html',
                    'attribute'=>'status',
                    'value' => function($data){
                        $style = ['style'=>'color:#738186'];
                        if($data->status)
                            $style = ['style'=>'color:#22bf6c'];
                        return Html::tag('div', Datadict::getDataValue('strategy_list_status', $data->status),$style);
                    }
                ],
//                [
//                    'attribute' => 'id',
//                    'label' => '报表明细',
//                    'format' => 'raw',
//                    'value' => function($data){
//                        return Html::a('查看报表',Url::to(['ad-analysis/index', 'AnalysisEffect[ad_id]' => $data->id]), ['data-pjax' => '0',]);
//                    }
//                ],
                [
                    'attribute' => 'create_time',
                    'format' => ['date','php:Y-m-d H:i']
                ],      
                // 'update_time:datetime',
                [
                    'header' => '操作',
                    'class' => 'app\extensions\grid\HodoActionColumn',
                    'template' => ' {update}  {switch-status} {analysis} {delete}',
                    'buttons' => [
                        'analysis' => function ($url, $model, $key) {
                            if(Yii::$app->user->can('/adsplatform/ad-analysis/index')){
                                return Html::a('报表',Url::to(['ad-analysis/index', 'AnalysisEffect[ad_id]' => $model->id]), ['class' => 'buttonOptions',]);
                            }
                            return false;
                        }
                    ]
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end()?>
</div>







