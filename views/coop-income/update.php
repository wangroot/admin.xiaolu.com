<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TmpIncome */


?>
<div class="tmp-income-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_updateform', [
        'model' => $model,
    ]) ?>

</div>
