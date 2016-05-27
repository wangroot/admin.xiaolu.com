<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\models\AdminUser;
use yii\helpers\Url;
use app\modules\adsplatform\models\Datadict;
/* @var $this yii\web\View */
/* @var $model app\models\TmpIncome */
/* @var $form app\components\HodoActiveForm */
?>

<div class="tmp-income-form">
    <h4>PS:请勿上传重复数据</h4>
    <?php $form = HodoActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-6">
            <?=
            $form->select2($model, 'channel',[
                'language' => Yii::$app->language,
                'data' => Datadict::getDataList('strategy_list_channels'),
                'options' => [],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => false
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <a href="<?= Url::toRoute('/adsplatform/channel/create')?>">点击前往创建渠道</a>
        </div>
    </div>

    <?= $form->field($model, 'imageFile')->fileInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '上传' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php HodoActiveForm::end(); ?>

</div>

<?php if(!empty($dataProvide)){?>
 <div class="row">
 <div class="col-md-2">
     <div class="info">
         PS:以下是重复数据
         <button data-url="<?= Url::toRoute(['create'])?>" id="send-repeat-data" class="btn btn-success">合并数据</button>
         <a class="btn btn-info" href="<?= Url::toRoute(['index'])?>">取消</a>
     </div>
 </div>
 </div>
<table class="table table-striped table-bordered">
    <thead>
    <tr class="danger">
        <th>
            时间
        </th>
        <th>
            广告类型
        </th>
        <th>
            展现
        </th>
        <th>
            点击
        </th>
        <th>
            点击率(%)
        </th>
        <th>
            千次展示收益
        </th>
        <th>
            收入
        </th>
        <th>
            所属渠道
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    $repeat = [];
    foreach($dataProvide as $key=>$value){
        ?>
        <?php
            $repeat[] = [
                'ad_type' => $value->ad_type,
                'date_time' => $value->date_time,
                'show_total' => $value->show_total,
                'click_total' => $value->click_total,
                'click_rate' => $value->click_rate,
                'eCPM' => $value->eCPM,
                'income' => $value->income,
                'channel' => $value->channel,
            ];
        ?>
        <tr data-key="4" class="danger">

            <td><?= date('Y-m-d', $value->date_time);?></td>
            <td><?= $value->ad_type; ?></td>
            <td><?= $value->show_total; ?></td>
            <td><?= $value->click_total; ?></td>
            <td><?= $value->click_rate; ?></td>
            <td><?= $value->eCPM; ?></td>
            <td><?= $value->income; ?></td>
            <td><?= $value->channel; ?></td>
        </tr>
    <?php }?>
</tbody>
</table>
<?= Html::textInput('', json_encode($repeat), ['id' => 'repeat-data', 'class' => 'hidden'])?>
<?php }?>
<?php
$js =<<<JS
 $("#send-repeat-data").click(function() {
    var _this = $(this);
        var url = _this.attr('data-url');
        var value = $("#repeat-data").val();
        $.ajax({
            type: "POST",
            url: url,
            data: {repeatData:value},
            success: function (data) {
                if(data.status == 'success'){
                    window.location.href = data.url;
                    return false;
                }
                window.location.reload();
            },
            dataType: "json"
        });
 });
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>
