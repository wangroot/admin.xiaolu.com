<?php

use yii\helpers\Html;
use app\extensions\grid\HodoGridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '第三方广告报表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmp-income-index">
    <div class="row">
        <dvi class="col-md-2">
            <?php if(Yii::$app->user->can('/coop-income/create')){?>
            <?= Html::a('导入csv文件', ['create'], ['class' => 'btn btn-success']) ?>
            <?php }?>
        </dvi>
    </div>

    <?= HodoGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model, $key, $index, $column) {
                    if($model->status){
                        return [
                            'disabled' => $model->status,
                        ];
                    }
                }
            ],
            [
                'attribute' => 'date_time',
                'format' => ['date','php:Y-m-d']
            ],
            'ad_type',
            'show_total',
            'click_total',

            [
                'attribute' => 'click_rate',
                'value' => function($model){
                    if($model->click_rate=='0'){
                        return '0';
                    }
                    if(strpos($model->click_rate, '.')==2){
                        return str_pad($model->click_rate, 5, '0') .'%';
                    }else{
                        return str_pad($model->click_rate, 4, '0') .'%';
                    }
                }
            ],
            [
                'attribute' => 'eCPM',
                'value' => function($model){
                    return $model->eCPM =='0.00'?0: str_pad($model->eCPM, 2, '0', STR_PAD_RIGHT);
                }
            ],
            [
                'attribute' => 'income',
                'value' => function($model){
                    return $model->income =='0.00'?0: $model->income;
                }
            ],
            'channel',
            [
                'class' => 'app\extensions\grid\HodoActionColumn',
                'template' => '{switch-status} {update}',
                'buttons' => [
                    'switch-status' => function ($url, $model, $key)  {
                        $parameter = '';
                        $strategy_id = Yii::$app->request->getQueryParam('strategy_id');
                        if(!empty($strategy_id)){
                            $parameter .= '&strategy_id='. $strategy_id;
                        }
                        if (isset($model->status)) {
                            $parameter .= '&status='.($model->status?0:1);
                            $confirm = $model->status?'不显示':'显示';
                        }
                        $options = array_merge([
                            'title' => '不显示或显示',
                            'aria-label' => '更改状态',
                            'data-confirm' => '您确定要'.$confirm,
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ], []);
                        if(Yii::$app->user->can('/coop-income/switch-status')){
                            return Html::a($confirm, $url.$parameter, $options);
                        }
                        return false;
                    }
                ]
            ],
        ],
    ]); ?>
    <?php if(Yii::$app->user->can('/coop-income/change-status')){?>
    <div class="row">
        <dvi class="col-md-2">

            <button type="button"  data-url="<?= \yii\helpers\Url::toRoute(['change-status'])?>"
                    id="change-status-value" class="btn btn-success">批量审核通过</button>

        </dvi>
        <dvi class="col-md-2">
            <button type="button"  data-url="<?= \yii\helpers\Url::toRoute(['change-status'])?>"
                    id="delete-status-value" class="btn btn-success">批量删除</button>
        </dvi>
    </div>
<?php }?>

</div>

<?php
$js = <<<JS

$(document).ready(function(){
         function sentAjax(){
             var keys=$("#w0").yiiGridView("getSelectedRows");
             var status = $(this).attr('id')=='delete-status-value'?1:0;
             $.ajax({
                type:"POST",
                url: $(this).attr('data-url'), // your controller action
                dataType: "json",
                data: {keylist: keys, status: status},
                success: function(data) {
                  if(data.status == 'success'){
                    window.location.reload();
                  }
                }
             });
        } ;
        $("#change-status-value").click(function(){sentAjax.call(this);});
        $("#delete-status-value").click(function(){
            var s = confirm("你肯定要批量删除嘛?");
            if(s){
                 sentAjax.call(this);
            }
            return false;
        });

});
JS;
$this->registerJs($js, \yii\web\View::POS_END);


?>