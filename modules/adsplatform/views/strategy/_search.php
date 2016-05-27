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
<div class="strategy-search" >

    <?php $form = HodoActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => true,
            'class' => 'form-horizontal'
        ]
    ]); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->textInput($model, 'name', ['labelOptions' => ['class' => 'control-label col-md-3']]  ) ?>
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
        <div class="col-lg-4">
            <?= $form->dropDownList($model, 'status', [], ['' => '全部']+Datadict::getDataList('strategy_list_status'))?>
        </div>

    </div>

    <div class="form-group text-right">
        <div class="col-lg-12">
            <?= Html::a('策略验证',['/adsplatform/strategy-verify/index'], ['class' => 'btn btn-success ']) ?>
            <?php if(Yii::$app->user->can('/adsplatform/strategy/create')){?>
            <?= Html::a('新增流量策略',['/adsplatform/strategy/create'], ['class' => 'btn btn-success ']) ?>
            <?php }?>
            <?= Html::submitButton('筛选', ['class' => 'btn btn-primary' ]) ?>
        </div>
    </div>
    <?php HodoActiveForm::end(); ?>

</div>

<?php Pjax::end();?>
