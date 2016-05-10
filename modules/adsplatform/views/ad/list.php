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
                        return Datadict::getDataValue('ad_provider', $data->provider);
                    },
                    'options' => [
                        'colgroup' => ['col' => 2]
                    ]
                ],
                [
                    'attribute' => 'status',
                    'value' => function ($data) {
                        return Datadict::getDataValue('strategy_list_status', $data->status);
                    }
                ],
                [
                    'attribute' => 'create_time',
                    'label' => '创建时间',
                    'format' => ['date', 'php:Y-m-d']
                ],
                [
                    'class' => 'app\extensions\grid\HodoActionColumn',
                    'template' => ' {update} {delete} {switch-status}',
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            $options = array_merge([
                                'title' => Yii::t('yii', 'Update'),
                                'aria-label' => Yii::t('yii', 'Update'),
                                'data-pjax' => '0',
                            ], []);
                            return Html::a('编辑', Url::toRoute(['ad-update', 'id' => $model->id]), $options);
                        },
                        'delete' => function ($url, $model, $key) {
                            $options = array_merge([
                                'title' => Yii::t('yii', 'Delete'),
                                'aria-label' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ], []);
                            return Html::a('删除', Url::toRoute(['ad-delete', 'id' => $model->id]), $options);
                        }
                    ]
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end() ?>
</div>







