<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\adsplatform\models\Datadict;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\StrategyList */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Strategy Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="strategy-list-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'strategy_id',
            [
                'attribute' => 'type',
                'value' => Datadict::getDataValue('strategy_list_type', $model->type),
            ],
            [
                'attribute' => 'rule',
                'value' => Datadict::getDataValue('strategy_list_rule', $model->rule),
            ],
            'rule_content',
            [
                'attribute' => 'status',
                'value' => Datadict::getDataValue('strategy_list_status', $model->status),
            ],
            [
                'attribute' => 'create_time',
                'format' => ['date','php:Y-m-d']
            ],

            [
                'attribute' => 'update_time',
                'format' => ['date','php:Y-m-d']
            ],
        ],
    ]) ?>

</div>
