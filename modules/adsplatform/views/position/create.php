<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Position */
$this->title = '创建';
$this->params['breadcrumbs'][] = ['label' => '广告类型列表', 'url' => ['index'], 'iconClass' => 'fa fa-table'];
$this->params['breadcrumbs'][] = ['label'=>$this->title,'iconClass' => 'fa fa-edit'];
?>
<div class="position-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
