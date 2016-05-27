<?php

use app\extensions\grid\HodoGridView;
use yii\widgets\Pjax;
use app\models\AdminUser;
use app\modules\adsplatform\models\AdminLog;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\adsplatform\models\OperatingRecordLog */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\modules\adsplatform\models\OperatingRecordLog*/

$this->title = '操作日志列表';
$this->params['breadcrumbs'][] = ['label'=>$this->title,'iconClass' => 'fa fa-table'];
?>

<div class="panel panel-success">

    <div class="panel-heading">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="panel-body">
        <?= HodoGridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                [
                    'attribute' => 'create_time',
                    'format' => ['date','php:Y-m-d H:i']
                ],
                [
                    'attribute' => 'user_id',
                    'value' => function($model){
                        return AdminUser::findOne((int)$model->user_id)->username;
                    }
                ],
                'ip',
                [
                    'attribute' => 'type',
                    'value' => function($model){
                        return AdminLog::getTypeValue($model->type);
                    },
                ],
                [
                    'attribute' => 'remark',
                    'format' => 'html',
                    'value' => function($model){
                        $namespace = $model->model_name;
                        if(!class_exists($namespace))
                            return '末到结果';
                        $queryModel = $namespace::findOne($model->field_id);
                        $str = '<span class="not-set">(未设置)</span>';
                        if (isset($queryModel->name)) {
                            $str = $queryModel->name;
                        } elseif(isset($queryModel->title)){
                            $str = $queryModel->title;
                        }
                        return $model->remark.':'.$str."(#{$model->field_id})";
                    }
                ]
            ],
        ]); ?>
    </div>
</div>


