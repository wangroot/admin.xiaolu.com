<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\DeviceData */

$this->title = 'Create Device Data';
$this->params['breadcrumbs'][] = ['label' => 'Device Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
