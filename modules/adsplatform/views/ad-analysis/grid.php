<?php
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/4/25
 * Time: 下午3:34
 */
use app\extensions\grid\HodoGridView;
use yii\widgets\Pjax;
?>

<?php Pjax::begin(['id' => 'hodo-grid-view' ,'formSelector' => false])?>
    <div class="panel-body">
        <?= HodoGridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'ad_name',
                'total_failure',
                'total_view',
                'total_click',
                'total_download',
                'total_install',
                [
                    'attribute' => 'create_time',
                    'format' => ['date','php:Y-m-d']
                ],                // 'update_time:datetime',

            ],
        ]); ?>
    </div>
<?php Pjax::end()?>