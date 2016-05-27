<?php

use yii\helpers\Html;
use app\extensions\grid\HodoGridView;
use app\modules\adsplatform\models\Datadict;
use app\extensions\grid\HodoActionColumn;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\adsplatform\models\ProviderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '渠道';
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

                'value',
                
                [
                    'attribute' => 'create_time',
                    'format' => ['date', 'php:Y-m-d H:i']
                ],
                // [
                //     'attribute' => 'status',
                //     'format' => 'html',
                //     'value' => function($data){
                //         $style = ['style'=>'color:#738186'];
                //         if($data->status)
                //             $style = ['style'=>'color:#22bf6c'];
                //         return Html::tag('div',Datadict::getDataValue('strategy_list_status', $data->status),$style);
                //     },
                // ],
                // [
                //     'class' => 'app\extensions\grid\HodoActionColumn','template' =>' {update}  {switch-status} {delete}',
                // ],
            ],
        ]); ?>
    </div>
</div>
