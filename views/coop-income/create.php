<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TmpIncome */

$this->title = 'Create Tmp Income';
$this->params['breadcrumbs'][] = ['label' => 'Tmp Incomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmp-income-create">

    <?= $this->render('_form', [
        'model' => $model,
        'dataProvide' => $dataProvide,
    ]) ?>

</div>
