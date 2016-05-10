<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\adsplatform\models\Datadict;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Position */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="position-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除嘛?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'platform',
                'value' => Datadict::getDataValue('position_platform', $model->platform)
            ],
            [
                'attribute' => 'type',
                'value' => Datadict::getDataValue('position_type', $model->type)
            ],
            'total',
            'width',
            'height',
            'create_time:datetime',
            'update_time:datetime',
            [
                'attribute' => 'status',
                'value' => Datadict::getDataValue('position_status', $model->status)
            ],
        ],
    ]) ?>

</div>
