<?php
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/5/3
 * Time: 上午10:11
 */
use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
use app\modules\adsplatform\models\Position;
use yii\helpers\Url;
use app\modules\adsplatform\models\Provider;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Ad */
/* @var $form app\components\HodoActiveForm */
$this->title = $model->isNewRecord?'创建':'更新';
$this->params['breadcrumbs'][] = ['label' => '联盟广告管理列表', 'url' => ['index'], 'iconClass' => 'fa fa-table'];
$this->params['breadcrumbs'][] = ['label'=>$this->title,'iconClass' => 'fa fa-edit'];
?>
<div class="ad-create">

    <div class="game-form">

        <?php $form = HodoActiveForm::begin([
        ]); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->textInput($model, 'title') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=
                $form->select2($model, 'position_id',[
                    'language' => Yii::$app->language,
                    'data' => Position::getList() ,
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
                <?= $form->dropDownList($model, 'provider', [],  Provider::getList()) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->textInput($model, 'app_id') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->textInput($model, 'ad_id') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->dropDownList($model, 'status', [], Datadict::getDataList('ad_status')) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->textInput($model, 'ceiling_view', ['labelOptions' => ['class' => 'control-label col-md-3',]]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->textInput($model, 'show_time', ['labelOptions' => ['class' => 'control-label col-md-3', 'placeholder'=>'2016-04-18 00:00:00']]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->textInput($model, 'start_time', ['labelOptions' => ['class' => 'control-label col-md-3', 'placeholder'=>'2016-04-18 00:00:00']]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->textInput($model, 'end_time',  ['labelOptions' => ['class' => 'control-label col-md-3', 'placeholder'=>'2016-04-18 00:00:00']]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <?= Html::submitButton($model->isNewRecord ? '完成' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a('取消', Url::toRoute('index') ,['class' => 'btn btn-default']) ?>
            </div>
        </div>

        <?php HodoActiveForm::end(); ?>

    </div>

</div>