<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use yii\widgets\Pjax;
use app\modules\adsplatform\models\Datadict;
use app\modules\adsplatform\models\Position;
use app\modules\adsplatform\models\Provider;

/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\AdSearch */
/* @var $form app\components\HodoActiveForm */
?>

<?php Pjax::begin([
    'id' => 'hodo-search-form',
    'linkSelector' => false,
])?>
    <div class="game-search">
        <?php $form = HodoActiveForm::begin([
            'action' => ['list'],
            'method' => 'get',
            'options' => [
                'data-pjax' => true
            ]
        ]); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->textInput($model, 'title') ?>
            </div>
            <div class="col-md-6">
                <?=
                $form->select2($model, 'position_id',[
                    'language' => Yii::$app->language,
                    'data' => [''=>'全部'] + Position::getList() ,
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
               <?= $form->dropDownList($model, 'status', [], [''=>'全部'] +Datadict::getDataList('strategy_list_status'))?>
            </div>
            <div class="col-md-6">
               <?= $form->dropDownList($model, 'provider', [], ['' => '全部广告', 0=>'自主'] + Provider::getList())?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('筛选', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('新增广告',['/adsplatform/ad/ad-create'], ['class' => 'btn btn-success']) ?>
        </div>

        <?php HodoActiveForm::end(); ?>
    </div>
<?php Pjax::end()?>