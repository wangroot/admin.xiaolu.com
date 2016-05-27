<?php

use yii\helpers\Html;
use app\modules\adsplatform\models\Datadict;
use app\components\HodoActiveForm;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Provider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provider-form">


    <?php $form = HodoActiveForm::begin([
//        'options' => [
//            'class' => 'form-horizont'
//        ],
    ]); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'name') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textArea($model, 'remark' ,['labelOptions' => ['class' => 'control-label col-md-3']],['placeholder' => '选填'])?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->dropDownList($model,'status',[], Datadict::getDataList('position_status'))?>

        </div>
    </div>

    <div class="row">
        <div class="text-right col-md-6">
            <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php HodoActiveForm::end(); ?>

</div>
