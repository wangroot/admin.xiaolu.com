<?php

use yii\helpers\Html;
use app\extensions\grid\HodoGridView;
use app\modules\adsplatform\models\Datadict;
use yii\widgets\Pjax;
use app\modules\adsplatform\models\Ad;
use yii\helpers\Url;
use app\modules\adsplatform\models\Strategy;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\adsplatform\models\StrategyAdListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '策略广告列表';
$this->params['breadcrumbs'][] = ['label' => '策略广告列表', 'iconClass' => 'fa fa-table'];

?>
<div class="panel panel-success strategy-ad-list-index">

    <div class="panel-heading">
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
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
                    'attribute' => 'strategy_id',
                    'value' => function($data){
                        $result = Strategy::findOne($data->strategy_id);
                        return  $data->strategy_id.'-'.$result['name'];

                    }
                ],
                [
                    'attribute' => 'ad_id',
                    'format' => 'html',
                    'value' => function($data){
                        $result = Ad::findOne($data->ad_id);
                        return  Html::a('#'.($data->ad_id)."-".$result['title'], Url::to(['ad/index', 'AdSearch[id]'=>$data->ad_id],['data-pjax' => '0',]));
                    }
                ],
                'weight',
                [
                    'attribute' => 'create_time',
                    'format' => ['date','php:Y-m-d']
                ],            // 'update_time:datetime',
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



