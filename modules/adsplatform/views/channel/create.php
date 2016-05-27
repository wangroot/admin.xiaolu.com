<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Provider */

$this->title = '添加渠道';
$this->params['breadcrumbs'][] = ['label' => '渠道', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provider-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
