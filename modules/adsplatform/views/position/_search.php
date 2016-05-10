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
            'class' => 'form-horizontal'
        ]
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'name') ?>
        </div>
        <div class="col-md-6">
            <?= $form->dropDownList($model, 'status', [], ['' => '全部']+Datadict::getDataList('strategy_list_status'))?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('筛选', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('新增广告类型',['/adsplatform/position/create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php HodoActiveForm::end(); ?>
</div>
<?php Pjax::end()?>



