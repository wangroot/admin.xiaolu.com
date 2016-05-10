<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\adsplatform\models\Datadict;
use app\modules\adsplatform\models\Strategy;
use app\extensions\grid\HodoGridView;
use yii\widgets\Pjax;
use app\modules\adsplatform\models\Ad;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Strategy */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Strategies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="strategy-view">


    <?= '<h1 class="text-center">' . $strategy_name . '</h1>' ?>

    <!-- 策咯规则 -->
    <h3>策略规则</h3>

    <?=
    HodoGridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => " {items}\n",
        'columns' => [
            [
                'header' => '匹配类型',
                'attribute' => 'type',
                'value' => function ($data) {
                    return Datadict::getDataValue('strategy_list_type', $data->type);
                },
            ],
            [
                'header' => '规则',
                'attribute' => 'rule',
                'value' => function ($data) {
                    return Datadict::getDataValue('strategy_list_rule', $data->rule);
                },
            ],
            [
                'header' => '规则内容',
                'attribute' => 'rule_content',
            ],
            [
                'header' => '状态',
                'attribute' => 'status',
                'value' => function ($data) {
                    return Datadict::getDataValue('strategy_list_status', $data->status);
                },
            ],
        ],
    ]);
    ?>
    <h3>策略广告</h3>

    <?=
    HodoGridView::widget([
        'dataProvider' => $dataProvider_adlist,
        'layout' => " {items}\n",
        'columns' => [

            [
                'header' => '广告内容',
                'attribute' => 'ad_id',
                'format' => 'html',
                'value' => function ($data) {
                    $result = Ad::findOne($data->ad_id);
                    return Html::a('#' . ($data->ad_id) . "-" . $result['title'], Url::to(['ad/index', 'AdSearch[id]' => $data->ad_id], ['data-pjax' => '0',]));
                }
            ],
            [
                'header' => '权重',
                'attribute' =>  'weight',
            ],
            // 'update_time:datetime',
            [
                'header' => '状态',
                'attribute' => 'status',
                'value' => function ($data) {
                    return Datadict::getDataValue('strategy_list_status', $data->status);
                },
            ],
        ],
    ]);
    ?>

</div>
