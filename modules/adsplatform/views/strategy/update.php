<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Strategy */

$this->title = '更新';
$this->params['breadcrumbs'][] = ['label' => '流量策略列表', 'url' => ['index'], 'iconClass' => 'fa fa-table'];
$this->params['breadcrumbs'][] = ['label'=>$this->title.'-'.$model->id,'iconClass' => 'fa fa-edit'];
?>
<div class="strategy-update">

    <?= $this->render('_form', [
        'model' => $model,
        'strategyListModel' => $strategyListModel,
        'strategyListAdModel' => $strategyListAdModel,
        'typeData' => $typeData,
        'hintData' => $hintData,
    ]) ?>

</div>
