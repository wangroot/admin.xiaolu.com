<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\StrategyList */
/* @var $form app\components\HodoActiveForm */
?>

<div class="strategy-list-form">

    <?php $form = HodoActiveForm::begin(); ?>

    <?= $form->hiddenInput($model,'strategy_id' )?>

    <?= $form->dropDownList($model, 'type',[], Datadict::getDataList('strategy_list_type')) ?>

    <?= $form->dropDownList($model, 'rule',[], Datadict::getDataList('strategy_list_rule')) ?>

    <?= $form->textarea($model, 'rule_content',[]) ?>

    <?= $form->dropDownList($model, 'status',[], Datadict::getDataList('strategy_list_status')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php HodoActiveForm::end(); ?>

</div>
