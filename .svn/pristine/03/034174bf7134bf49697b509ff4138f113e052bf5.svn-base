<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\StrategyAdListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="strategy-ad-list-search">

    <?php $form = HodoActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'weight') ?>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <?= Html::a('返回流量策略管理', ['strategy/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('策略广告增加', ['strategy-ad-list/create', 'strategy_id'=>$model->strategy_id], ['class' => 'btn btn-success']) ?>

    </div>

    <?php HodoActiveForm::end(); ?>

</div>
