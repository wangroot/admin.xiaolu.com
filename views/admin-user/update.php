<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AdminUser */

$this->title = '更新';
$this->params['breadcrumbs'][] = ['label' => '广告内容列表', 'url' => ['index'], 'iconClass' => 'fa fa-table'];
$this->params['breadcrumbs'][] = ['label'=>$this->title.'-'.$model->id,'iconClass' => 'fa fa-edit'];
?>
<div class="admin-user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
