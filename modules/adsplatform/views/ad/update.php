<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Ad */

$this->title = '更新';
$this->params['breadcrumbs'][] = ['label' => '自主广告列表', 'url' => ['index'], 'iconClass' => 'fa fa-table'];
$this->params['breadcrumbs'][] = ['label'=>$this->title,'iconClass' => 'fa fa-edit'];
?>
<div class="ad-update-id">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
