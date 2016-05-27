<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use yii\widgets\Pjax;
use app\modules\adsplatform\models\Ad;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\AnalysisEffect */
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
            'options' => [
                'data-pjax' => true,
                'class' => 'form-horizontal',
            ]
        ]); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->select2($model, 'ad_id',[
                    'language' => Yii::$app->language,
                    'data' => ['' => '全部'] + Ad::getAdList(),
                    'options' => [],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => false
                    ],
                ])?>
            </div>
            <div class="col-md-6">
                <?=  $form->textInput($model, 'ad_name')?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">

            </div>
        </div>

        <div class="form-group text-right">
            <div class="col-md-12">
                <?= Html::submitButton('筛选', ['class' => 'btn btn-primary ' ]) ?>
            </div>
        </div>

        <?php HodoActiveForm::end(); ?>
    </div>
<?php Pjax::end()?>