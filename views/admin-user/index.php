<?php

use yii\helpers\Html;
use app\extensions\grid\HodoGridView;
use app\modules\adsplatform\models\Datadict;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '后台账号管理';
$this->params['breadcrumbs'][] = ['label' => '后台账号列表', 'url' => ['index'], 'iconClass' => 'fa fa-table'];
?>
<div class="admin-user-index panel panel-success">

    <div class="panel-heading">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    </div>

   <div class="panel-body">
    <?= HodoGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
            [
                'format' => 'html',
                'attribute'=>'status',
                'value' => function($data){
                    $style = ['style'=>'color:#738186'];
                    if($data->status)
                        $style = ['style'=>'color:#22bf6c'];
                    return Html::tag('div', Datadict::getDataValue('admin_user_status', $data->status),$style);
                }
            ],

            [
                'class' => 'app\extensions\grid\HodoActionColumn',
                'template' => '{assignment} {role} {view} {update} {switch-status} {delete}',
                'buttons' => [
                    'assignment' => function ($url, $model, $key) {
                        return Html::a('分配角色',Url::to(['/admin/assignment/view', 'id' => $model->id]), ['class' => 'buttonOptions',]);
                    },
                    'role' => function () {
                        return Html::a('角色列表',Url::to(['/admin/role/index']), ['class' => 'buttonOptions',]);
                    },
                ],
            ],
        ],
    ]); ?>
   </div>
</div>
