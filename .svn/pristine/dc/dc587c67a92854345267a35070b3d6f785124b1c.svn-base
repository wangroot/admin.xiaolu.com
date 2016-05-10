<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\StrategyList */
/* @var $form app\components\HodoActiveForm */
$model = new \app\modules\adsplatform\models\StrategyList();
$model->strategy_id = $id;
?>

<div class="strategy-list-form">

    <?php $form = HodoActiveForm::begin([
        'action' => 'javascript:void(0)',
        'is_search' => false,
        'options' => [
            'data-url' => Url::to(['strategy-list/create', 'strategy_id' => $id])
        ]
    ]); ?>

    <?= $form->hiddenInput($model,'strategy_id' )?>

    <?= $form->dropDownList($model, 'type',[], Datadict::getDataList('strategy_list_type')) ?>

    <?= $form->dropDownList($model, 'rule',[], Datadict::getDataList('strategy_list_rule')) ?>

    <?= $form->textarea($model, 'rule_content',[], ['min-height'=>'200px']) ?>

    <?= $form->dropDownList($model, 'status',[], Datadict::getDataList('strategy_list_status')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '下一步' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php HodoActiveForm::end(); ?>

</div>
