<?php

use yii\helpers\Html;
use app\extensions\grid\HodoGridView;
use app\modules\adsplatform\models\Datadict;
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
             'status',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return Datadict::getDataValue('admin_user_status', $data->status);
                }
            ],

            ['class' => 'app\extensions\grid\HodoActionColumn'],
        ],
    ]); ?>
   </div>
</div>
