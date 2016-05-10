<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Datadict */

$this->title = 'Create Datadict';
$this->params['breadcrumbs'][] = ['label' => 'Datadicts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datadict-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
