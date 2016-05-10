<?php
use app\extensions\widget\HodoTabs;
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/4/22
 * Time: 上午10:50
 * @var $model app\modules\adsplatform\models\Strategy
 */
$this->title = '流量策略增加流程';
$this->params['breadcrumbs'][] = ['label' => '策略列表', 'url' => ['index'], 'iconClass' => 'fa fa-table'];
$this->params['breadcrumbs'][] = ['label'=>$this->title,'iconClass' => 'fa fa-edit'];
?>
<?= HodoTabs::widget([
    'options' => ['id'=>'tabs-apps'],
    //'renderTabContent'=> false,
    'items' => [
        [
            'label' => '流量策略',
            'content' => $model->TabsPanels($this, 'strategy'),
            'hint' => $model->TabsToolip()['basic']
        ],
        [
            'label' => '策略规则',
            'disabled' => '',
            'active' => true,
            'content' => $model->TabsPanels($this, 'rule'),
            'isNewRecord' => $model->isNewRecord,
            'dataUrl' => ['appssetting/index'],
            'hint' => $model->TabsToolip()['hodoSDK']
        ],
        [
            'label' => '关联广告',
            'disabled' => '',
            'content' => $model->TabsPanels($this, 'ad'),
            'isNewRecord' => $model->isNewRecord,
            'dataUrl' => ['appssetting/index'],
            'hint' => $model->TabsToolip()['operatorSDK']
        ],
    ],
]);
?>