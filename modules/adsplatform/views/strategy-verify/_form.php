<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Position;
/* @var $this yii\web\View */
/* @var $model app\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="strategy-verify-form">

    <?php $form = HodoActiveForm::begin(); ?>
    <div class="row">
<!--        <div class="col-lg-4">--><?//= $form->textInput($model, 'position_id') ?><!-- </div>-->
        <div class="col-lg-4"> <?=
            $form->select2($model, 'position_id',[
                'language' => Yii::$app->language,
                'data' => ['' => '全部'] + Position::getList() ,
                'options' => [],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => false
                ],
            ]);
            ?>
        </div>
        <div class="col-lg-4"><?= $form->textInput($model, 'channel') ?></div>
        <div class="col-lg-4"><?= $form->textInput($model, 'brand') ?></div>

    </div>
    <div class="row">
        <div class="col-lg-4"><?= $form->textInput($model, 'package_name') ?></div>
        <div class="col-lg-4"><?= $form->textInput($model, 'version') ?></div>
        <div class="col-lg-4"></div>
    </div>
    <div class="form-group text-right">
        <div class="col-lg-12">
            <?= Html::submitButton('验证', ['class' => 'btn btn-success'])?>
        </div>
    </div>

    <?php HodoActiveForm::end(); ?>

</div>
