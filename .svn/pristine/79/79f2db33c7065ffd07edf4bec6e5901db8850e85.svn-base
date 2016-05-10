<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Ad;
use app\modules\adsplatform\models\Datadict;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\StrategyAdList */
/* @var $form app\components\HodoActiveForm */
?>

<div class="strategy-ad-list-form">

    <?php $form = HodoActiveForm::begin(); ?>

    <?= $form->hiddenInput($model, 'strategy_id') ?>

    <?=
    $form->select2($model, 'ad_id',[
        'language' => Yii::$app->language,
        'data' => Ad::getAdList() ,
        'options' => [],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => false
        ],
    ]);
    ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->dropDownList($model, 'status', [], Datadict::getDataList('strategy_list_status'))?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php HodoActiveForm::end(); ?>

</div>
