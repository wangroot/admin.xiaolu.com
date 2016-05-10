<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\StrategyListSearch */
/* @var $form app\components\HodoActiveForm */
?>
<?php /*Pjax::begin([
    'id' => 'hodo-search-form',
    'linkSelector' => false,
])*/
?>
<div class="strategy-list-search">

    <?php $form = HodoActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => true
        ]
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->dropDownList($model, 'type', [], Datadict::getDataList('strategy_list_type')) ?>

        </div>
        <div class="col-md-3">
            <?= $form->dropDownList($model, 'rule', [], Datadict::getDataList('strategy_list_rule')) ?>

        </div>
        <div class="col-md-3">
            <?= $form->textInput($model, 'rule_content') ?>
        </div>
        <div class="col-md-3">
            <?= $form->dropDownList($model, 'status', [], Datadict::getDataList('strategy_list_status')) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <?= Html::a('返回流量策略管理', ['strategy/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('策略规则增加', ['strategy-list/create', 'strategy_id'=>$model->strategy_id], ['class' => 'btn btn-success']) ?>
    </div>

    <?php HodoActiveForm::end(); ?>

</div>

<?php //Pjax::end();?>
