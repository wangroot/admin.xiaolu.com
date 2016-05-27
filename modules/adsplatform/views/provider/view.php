<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\adsplatform\models\Datadict;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Provider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '广告商', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provider-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'name',
            'remark:ntext',
            'create_time:date',
            'update_time:date',
            [
                'attribute' => 'status',
                'value' => Datadict::getDataValue('position_status', $model->status)
            ],
        ],
    ]) ?>

</div>
