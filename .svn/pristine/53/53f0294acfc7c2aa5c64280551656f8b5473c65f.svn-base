<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
/* @var $this yii\web\View */
/* @var $model app\models\AdminUser */
/* @var $form app\components\HodoActiveForm */
?>

<div class="admin-user-form">

    <?php $form = HodoActiveForm::begin(); ?>

    <?= $form->textInput($model, 'username', [],['maxlength' => true]) ?>

    <?= $form->textInput($model, 'password_hash',[], ['maxlength' => true])?>

    <?= $form->textInput($model, 'email', [], ['maxlength' => true]) ?>

    <?= $form->dropDownList($model, 'status', [], Datadict::getDataList('admin_user_status')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php HodoActiveForm::end(); ?>

</div>
