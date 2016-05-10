<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Ad */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'provider',
            'position_id',
            'type',
            'target',
            'title',
            'subtitle',
            'detail:ntext',
            'image:ntext',
            'image_vertical:ntext',
            'link:ntext',
            'channel',
            'package_name',
            'version_code',
            'app_id',
            'ad_id',
            'start_time:datetime',
            'end_time:datetime',
            'show_time:datetime',
            'collect_data',
            'ceiling_view',
            'ceiling_day_view',
            'ceiling_day_click',
            'ceiling_total_view',
            'ceiling_total_click',
            'total_view',
            'total_click',
            'total_download',
            'total_install',
            'total_failure',
            'create_time:datetime',
            'update_time:datetime',
            'status',
        ],
    ]) ?>

</div>
