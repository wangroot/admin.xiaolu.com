<?php

use app\extensions\grid\HodoGridView;
use yii\widgets\Pjax;
use app\modules\adsplatform\models\OperatingRecordLog;
use app\models\AdminUser;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\adsplatform\models\OperatingRecordLog */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\modules\adsplatform\models\OperatingRecordLog*/

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
                'create_time:datetime',
                [
                    'attribute' => 'user_id',
                    'value' => function($model){
                        return AdminUser::findOne((int)$model->user_id)->username;
                    }
                ],
                [
                    'attribute' => 'type',
                    'value' => function($model){
                        return OperatingRecordLog::getTypeValue($model->type);
                    },
                ],
                [
                    'attribute' => 'detail',
                    'value' => function($model){
                       return OperatingRecordLog::handleFieldNameToRealName($model);
                    }
                ]

            ],
        ]); ?>
    </div>
    <?php Pjax::end()?>
</div>


