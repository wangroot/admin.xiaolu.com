<?php


use app\extensions\widget\HodoTabs;
use app\extensions\grid\HodoGridView;
use yii\widgets\Pjax;
use app\modules\adsplatform\models\Datadict;
use app\modules\adsplatform\models\Position;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\adsplatform\models\AdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '广告报表';
$this->params['breadcrumbs'][] = ['label' => '广告报表', 'iconClass' => 'fa fa-table'];
?>

<div class="panel panel-success">

    <div class="panel-heading">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="panel-body">
        <?php Pjax::begin(['id' => 'hodo-grid-view', 'formSelector' => false]) ?>
        <div class="panel-body">
            <?= HodoGridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'create_time',
                        'value' => function($data){
                            return date('Y-m-d', strtotime('-1 day', $data->create_time) );
                        }
                    ],  
                    [
                        'attribute' => 'ad_id',
                        'label' => '广告名',
                        'value' => function ($data) {
                            if (empty($data->ad_id)) {
                                return '未设置';
                            }
                            $adSql = <<<EOD
SELECT `provider`, `position_id`, `title` FROM `ad` WHERE id={$data->ad_id}
EOD;
                            $adResult = Yii::$app->db->createCommand($adSql)->queryOne();
                            $provider = Datadict::getDataValue('ad_provider', $adResult['provider']);
                            $position = Position::findOne($adResult['position_id']);
                            $ad_name = $provider . '-' . $position->name . '-' . $adResult['title'];
                            return $ad_name;
                        }
                    ],
                    [
                        'attribute' => 'total_failure',
                        'value' => function($data){
                            return empty($data->total_failure) ? 0 : $data->total_failure;
                        }
                    ],
                    [
                        'attribute' => 'total_view',
                        'value' => function($data){
                            return empty($data->total_view) ? 0 : $data->total_view;
                        }
                    ],
                    [
                        'attribute' => 'total_click',
                        'value' => function($data){
                            return empty($data->total_click) ? 0 : $data->total_click;
                        }
                    ],
                    [
                        'attribute' => 'total_download',
                        'value' => function($data){
                            return empty($data->total_download) ? 0 : $data->total_download;
                        }
                    ],
                    [
                        'attribute' => 'total_install',
                        'value' => function($data){
                            return empty($data->total_install) ? 0 : $data->total_install;
                        }
                    ],
                    [
                        'attribute' => 'total_click',
                        'label' => '点击率',
                        'value' => function ($data) {
                           return empty($data->total_view)?0:round(($data->total_click/$data->total_view)*100, 2).'%';
                        }
                    ],
                    [
                        'attribute' => 'total_download',
                        'label' => '下载率',
                        'value' => function ($data) {
                           return empty($data->total_click)?0:round(($data->total_download/$data->total_click)*100, 2).'%';
                        }
                    ],
                    [
                        'attribute' => 'total_install',
                        'label' => '安装率',
                        'value' => function ($data) {
                           return empty($data->total_download)?0:round(($data->total_install/$data->total_download)*100, 2).'%';
                        }
                    ],              // 'update_time:datetime',
                ],
            ]); ?>
        </div>
        <?php Pjax::end() ?>
    </div>
</div>

<?php
/*HodoTabs::widget([
    'options' => ['id'=>'tabs-apps'],
    //'renderTabContent'=> false,
    'items' => [
        [
            'label' => '<i class="fa fa-table"></i>',
            'encode' => false,
            'content' => $this->render('grid', ['dataProvider' => $dataProvider]),
            'hint' => ''
        ],
        [
            'label' => '<i class="fa fa-bar-chart-o"></i>',
            'encode' => false,
            'content' => $this->render('charts'),
            'hint' => ''
        ],

    ],
]);*/
?>





