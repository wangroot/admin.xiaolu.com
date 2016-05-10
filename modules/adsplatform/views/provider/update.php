<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Provider */

$this->title = '更新 广告商: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '广告商', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="provider-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
