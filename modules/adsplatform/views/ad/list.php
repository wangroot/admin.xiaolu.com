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

$this->title = '代码位';
$this->params['breadcrumbs'][] = ['label' => '联盟广告管理列表', 'iconClass' => 'fa fa-table'];
?>

<div class="panel panel-success">

    <div class="panel-heading">
        <?php echo $this->render('_ad_position_search', ['model' => $searchModel]); ?>
    </div>

    <?php Pjax::begin(['id' => 'hodo-grid-view', 'formSelector' => false]) ?>
    <div class="panel-body">
        <?= HodoGridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'label' => 'ID',
                    'attribute' => 'id',
                ],
                'title',
                [
                    'attribute' => 'position_id',
                    'value' => function ($data) {
                        $result = Position::findOne($data->position_id);
                        return $result['name'];
                    },
                    'options' => [
                        'colgroup' => ['col' => 2]
                    ]
                ],
                [
                    'attribute' => 'provider',
                    'value' => function ($data) {
                        return \app\modules\adsplatform\models\Provider::findOne($data->provider)->name;
                    },
                    'options' => [
                        'colgroup' => ['col' => 2]
                    ]
                ],
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
                [
                    'attribute' => 'create_time',
                    'label' => '创建时间',
                    'format' => ['date', 'php:Y-m-d H:i']
                ],
                [
                    'class' => 'app\extensions\grid\HodoActionColumn',
                    'template' => ' {update} {switch-status} {delete}',
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            $options = array_merge([
                                'title' => Yii::t('yii', 'Update'),
                                'aria-label' => Yii::t('yii', 'Update'),
                                'data-pjax' => '0',
                            ], ['class' => 'buttonOptions']);
                            if(Yii::$app->user->can('/adsplatform/ad/ad-update')){
                                return Html::a('编辑', Url::toRoute(['ad-update', 'id' => $model->id]), $options);
                            }
                            return false;
                        },
                        'delete' => function ($url, $model, $key) {
                            $options = array_merge([
                                'title' => Yii::t('yii', 'Delete'),
                                'aria-label' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                                'style' => 'color:#ff5c41'
                            ], []);
                            if(Yii::$app->user->can('/adsplatform/ad/ad-update')) {
                                return Html::a('删除', Url::toRoute(['ad-delete', 'id' => $model->id]), $options);
                            }
                            return false;
                        },
                        'switch-status' => function ($url, $model, $key)  {
                            $parameter = '';
                            if (isset($model->status)) {
                                $parameter .= '&status='.($model->status?0:1);
                                $confirm = $model->status?'关闭':'开启';
                            }
                            $options = array_merge([
                                'title' => '开启或关闭',
                                'aria-label' => '更改状态',
                                'data-confirm' => '您确定要'.$confirm,
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ], []);
                            if(Yii::$app->user->can('/adsplatform/ad/status')){
                                return Html::a($confirm, Url::toRoute(['status', 'id' => $model->id]).$parameter, $options);
                            }
                            return false;
                        }
                    ]
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end() ?>
</div>







