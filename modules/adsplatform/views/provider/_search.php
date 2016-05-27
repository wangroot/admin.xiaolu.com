<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\adsplatform\models\Datadict;
use app\components\HodoActiveForm;


/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\ProviderSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="provider-search">
    <?php $form = HodoActiveForm::begin([

        'action' => ['index'],
        'method' => 'get',
    ]); ?>

        <div class="row">
            <div class="col-lg-4"><?= $form->textInput($model, 'name') ?></div>

            <div class="col-lg-4"> <?= $form->textInput($model, 'create_time') ?></div>

            <div class="col-lg-4"><?= $form->dropDownList($model, 'status', [], ['' => '全部']+Datadict::getDataList('strategy_list_status'))?></div>

        </div>
        <?php // echo $form->field($model, 'status') ?>
        <div class="row">

                <div class="form-group text-right">
                    <?php if(Yii::$app->user->can('/adsplatform/provider/create')){?>
                    <?= Html::a('添加广告商', ['create'], ['class' => 'btn btn-success']) ?>
                    <?php }?>
                    <?= Html::submitButton('筛选', ['class' => 'btn btn-primary ' ,'style' => 'margin-right: 30px;']) ?>
                </div>

        </div>
    <?php HodoActiveForm::end(); ?>
</div>


