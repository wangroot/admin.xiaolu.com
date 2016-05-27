<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Provider */

$this->title = '更新 渠道: ' . $model->value;
$this->params['breadcrumbs'][] = ['label' => '渠道', 'url' => ['index']];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="provider-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
