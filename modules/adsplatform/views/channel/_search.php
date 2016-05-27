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
        <div class="col-md-6"><?= $form->textInput($model, 'value') ?></div>
    </div>

    <div class="form-group text-right">
            <div class="col-md-6">
            <?php if(Yii::$app->user->can('/adsplatform/channel/create')){?>
                <?= Html::a('添加渠道', ['create'], ['class' => 'btn btn-success']) ?>
            <?php }?>
            <?= Html::submitButton('筛选', ['class' => 'btn btn-primary ']) ?>
        </div>
    </div>

    <?php HodoActiveForm::end(); ?>
</div>


