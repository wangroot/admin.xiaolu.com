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
                [
                    'label' => 'ID',
                    'attribute' => 'id',
                ],
                'name',
//            'remark:ntext',
                //'update_time',
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
                    'attribute' => 'create_time',
                    'label' => '创建时间',
                    'format' => ['date', 'php:Y-m-d H:i']
                ],

                [
                    'class' => 'app\extensions\grid\HodoActionColumn',
                ],
            ],
        ]); ?>
    </div>
</div>
