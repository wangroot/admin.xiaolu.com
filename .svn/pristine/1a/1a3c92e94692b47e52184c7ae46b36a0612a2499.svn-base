<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Position */
/* @var $form app\components\HodoActiveForm */
?>

<div class="position-form">

    <?php $form = HodoActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'name') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->dropDownList($model,'platform',[], Datadict::getDataList('position_platform'), ['labelOption' => ['class' => 'control-label col-md-3']])?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->dropDownList($model,'type',[], Datadict::getDataList('position_type'))?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <?= $form->dropDownList($model,'status',[], Datadict::getDataList('position_status'))?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6"></div>
    </div>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-offset-3 col-md-6">
            <?= Html::submitButton($model->isNewRecord ? '完成' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a('取消', Url::toRoute('index') ,['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php HodoActiveForm::end(); ?>

</div>
