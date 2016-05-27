<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
use yii\helpers\Url;
use app\models\AdminUser;
/* @var $this yii\web\View */
/* @var $model app\models\AdminUser */
/* @var $form app\components\HodoActiveForm */
?>

<div class="admin-user-form">

    <?php $form = HodoActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'username')?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'password_hash', ['labelOptions' => ['class' => 'control-label col-md-3']])->passwordInput()?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'email',['labelOptions' => ['class' => 'control-label col-md-3']],['placeholder' => '选填'])?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?=
            $form->select2($model, 'channels',[
                'language' => Yii::$app->language,
                'data' => Datadict::getDataList('strategy_list_channels'),
                'options' => ['placeholder' => '选填'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <a href="<?= Url::toRoute('/adsplatform/channel/create')?>">点击前往创建渠道</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">

            <?=
            $form->select2($model, 'role',[
                'language' => Yii::$app->language,
                'data' => AdminUser::getRoleList(),
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
            <?= $form->field($model, 'provider', ['labelOptions' => ['class' => 'control-label col-md-3']])->checkbox(['label' => '是', 'labelOptions'=>['style' =>'padding-top:7px;']])->label()?>
        </div>
        <div class="col-md-4">
            <div class="alert alert-warning">
                PS:勾选将处为了区别第三方后台
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->dropDownList($model, 'status', [], Datadict::getDataList('admin_user_status')) ?>
        </div>
    </div>

    <div class="form-group text-right">
        <div class="col-md-6">
            <?= Html::submitButton($model->isNewRecord ? '完成' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a('取消', Url::toRoute('index') ,['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php HodoActiveForm::end(); ?>

</div>
