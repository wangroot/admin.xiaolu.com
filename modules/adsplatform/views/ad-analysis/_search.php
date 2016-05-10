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
                'data-pjax' => true
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
                <?php // $form->textInput($model, 'create_time')?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">

            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php HodoActiveForm::end(); ?>
    </div>
<?php Pjax::end()?>