<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\PostionSearch */
/* @var $form app\components\HodoActiveForm */
?>
<?php Pjax::begin([
    'id' => 'hodo-search-form',
    'linkSelector' => false,
])?>
<div class="game-search">
    <?php $form = HodoActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'is_search' => true,
        'options' => [
            'data-pjax' => true,
            'class' => 'form-horizontal',
        ]
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?=
            $form->select2($model, 'user_id',[
                'language' => Yii::$app->language,
                'data' => [''=>'全部'] + \app\models\AdminUser::getDataList() ,
                'options' => [],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => false
                ],
            ]);
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->dropDownList($model, 'type', [], ['' => '全部', 0 => '新增',1 => '更新',2 => '删除'])?>
        </div>
    </div>

    <div class="form-group  text-right">
        <div class="col-md-12">
            <?= Html::submitButton('筛选', ['class' => 'btn btn-primary ' ]) ?>
        </div>
    </div>

    <?php HodoActiveForm::end(); ?>
</div>
<?php Pjax::end()?>



