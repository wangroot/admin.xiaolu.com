<?php

use yii\helpers\Html;
use app\extensions\grid\HodoGridView;
use app\modules\adsplatform\models\Datadict;
use app\extensions\grid\HodoActionColumn;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\adsplatform\models\ProviderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '广告商';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-success">

    <div class="panel-heading">

        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="panel-body">
      
        <?= HodoGridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
//            'remark:ntext',
                //'update_time',
                [
                    'attribute' => 'status',
                    'value' => function($data){
                        return Datadict::getDataValue('strategy_list_status', $data->status);
                    },
                ],
                'create_time:date',

                [
                    'class' => 'app\extensions\grid\HodoActionColumn',
                ],
            ],
        ]); ?>
    </div>
</div>
