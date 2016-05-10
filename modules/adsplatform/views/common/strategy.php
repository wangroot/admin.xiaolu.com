<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
use app\modules\adsplatform\models\Strategy;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Strategy */
/* @var $form app\components\HodoActiveForm */
if (($model = Strategy::findOne($id)) !== null) {
} else {
    throw new NotFoundHttpException('缺少id.');
}
?>
<div class="strategy-form">

    <?php $form = HodoActiveForm::begin([
        'action' => 'javascript:void(0)',
        'is_search' => false,
        'options' => [
            'data-url' => Url::to(['strategy/update', 'id' => $id])
        ]
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->textInput($model, 'name')?>
        </div>
        <div class="col-md-3">
            <?= $form->dropDownList($model, 'position_id',[], Datadict::getDataList('ad_position_id')) ?>
        </div>
        <div class="col-md-3">
            <?= $form->textInput($model, 'weight') ?>
        </div>
        <div class="col-md-3">
            <?= $form->dropDownList($model, 'status',[], Datadict::getDataList('strategy_list_status')); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '下一步' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php HodoActiveForm::end(); ?>

</div>
