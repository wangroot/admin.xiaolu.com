<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\EffectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="effect-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ad_id') ?>

    <?= $form->field($model, 'result') ?>

    <?= $form->field($model, 'result_time') ?>

    <?= $form->field($model, 'device_id') ?>

    <?php // echo $form->field($model, 'device_model') ?>

    <?php // echo $form->field($model, 'device_mac') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
