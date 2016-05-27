<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
/* @var $this yii\web\View */
/* @var $model app\models\AdminUserSearch */
/* @var $form app\components\HodoActiveForm */
?>

<div class="admin-user-search">

    <?php $form = HodoActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-6"> <?= $form->textInput($model, 'username') ?></div>
        <div class="col-md-6"><?= $form->dropDownList($model, 'status', [], ['' => '全部']+Datadict::getDataList('admin_user_status'))?></div>
    </div>
    <div class="form-group text-right">
        <div class="col-md-12">
            <?php if(Yii::$app->user->can('/admin-user/create')){?>
                <?= Html::a('创建后台账号', ['create'], ['class' => 'btn btn-success']) ?>
            <?php }?>
            <?= Html::submitButton('筛选', ['class' => 'btn btn-primary ' ]) ?>
        </div>
    </div>

    <?php HodoActiveForm::end(); ?>

</div>
