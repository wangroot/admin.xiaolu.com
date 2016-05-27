<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
/* @var $this yii\web\View */
/* @var $model app\models\TmpIncome */
/* @var $form app\components\HodoActiveForm */
?>

<div class="tmp-income-form">

    <?php $form = HodoActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'ad_type')?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'show_total')?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'click_total')?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'income')?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?=
            $form->select2($model, 'channel',[
                'language' => Yii::$app->language,
                'data' => Datadict::getDataList('strategy_list_channels'),
                'options' => [],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => false
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->dropDownList($model, 'status', [], [0 => '关闭' , 1 => '开启'])?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '上传' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php HodoActiveForm::end(); ?>

</div>



