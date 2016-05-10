<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
use yii\widgets\Pjax;
use app\modules\adsplatform\models\Position;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\StrategySearch */
/* @var $form app\components\HodoActiveForm */
?>
<?php Pjax::begin([
    'id' => 'hodo-search-form',
    'linkSelector' => false,
])?>
<div class="strategy-search">

    <?php $form = HodoActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => true
        ]
    ]); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->textInput($model, 'name') ?>
        </div>
        <div class="col-lg-4">
            <?= $form->dropDownList($model, 'status', [], ['' => '全部'] + Datadict::getDataList('strategy_list_status')) ?>
        </div>
        <div class="col-lg-4">
            <?=
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
    </div>

    <div class="row">
        <div class="col-lg-4">

        </div>
    </div>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('筛选', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('新增流量策略',['/adsplatform/strategy/create'], ['class' => 'btn btn-success']) ?>

    </div>

    <?php HodoActiveForm::end(); ?>

</div>

<?php Pjax::end();?>
