<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
use app\modules\adsplatform\models\Position;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Ad */
/* @var $form app\components\HodoActiveForm */
$this->registerJsFile('@web/js/jquery-form.js', ['position' => \yii\web\View::POS_END , 'depends' => 'app\assets\AppAsset']);
?>

<div class="game-form">

    <?php $form = HodoActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal',
            'enctype' => "multipart/form-data",
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'title') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'subtitle') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?=
            $form->select2($model, 'position_id',[
                'language' => Yii::$app->language,
                'data' => Position::getList() ,
                'options' => [],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => false
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->radioList($model, 'type', [], Datadict::getDataList('ad_type'))?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->radioList($model, 'target', [], Datadict::getDataList('ad_target'), ['id' => 'ad_targets'])?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'image',['labelOptions' => ['class' => 'control-label col-md-3', 'id' => "label_image"]],['id' => 'image']) ?>
        </div>
        <div class="col-md-3">
            <div class="btn btn-primary"  id="btn_image">
                点我上传
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'image_vertical',['labelOptions' => ['class' => 'control-label col-md-3', 'id' => "label_image_vertical"]],['id' => 'image_vertical']) ?>
        </div>
        <div class="col-md-3">
            <div class="btn btn-primary" id="btn_image_vertical">
                点我上传
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'link') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'detail') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'package_name') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'version_code') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->radioList($model, 'collect_data', [], Datadict::getDataList('ad_collect_data')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'show_time') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'start_time', ['labelOptions' => ['class' => 'control-label col-md-3', 'placeholder'=>'2016-04-18 00:00:00']]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'end_time',  ['labelOptions' => ['class' => 'control-label col-md-3', 'placeholder'=>'2016-04-18 00:00:00']]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'ceiling_view') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'ceiling_day_click') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'ceiling_total_view') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'ceiling_total_click') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->radioList($model, 'status', [], Datadict::getDataList('ad_status')) ?>
        </div>
    </div>

    <?php //        $form->fileInput($model, 'image',[], [
//        'options' => [
//            'accept' => 'image/*',
//            'multiple' => false
//        ],
//        'pluginOptions' => [
//            'uploadUrl' => Url::to(['upload-file/index']),
//            'uploadAsync' => true,
//            'minFileCount' => 1,
//            'maxFileCount' => 1,
//            'overwriteInitial' => false,
//            'uploadExtraData' => [
//                'm' => 'Game',
//                'name' => 'icon'
//            ],
//            'showUpload' => true,
//            'browseLabel' => '',
//           // 'initialPreview' => [],//$model->Select2Init('icon')['initialPreview'],
//            //'initialPreviewConfig'=> //$model->Select2Init('icon')['initialPreviewConfig'],
//        ],
//    ]) ?>
    <?php /* $form->fileInput($model, 'image_vertical',[], [
        'options' => [
            'accept' => 'image/*',
            'multiple' => false
        ],
        'pluginOptions' => [
            'uploadUrl' => Url::to(['upload-file/index']),
            'uploadAsync' => true,
            'minFileCount' => 1,
            'maxFileCount' => 1,
            'overwriteInitial' => false,
            'uploadExtraData' => [
                'm' => 'Game',
                'name' => 'icon'
            ],
            'showUpload' => true,
            'browseLabel' => '',
           // 'initialPreview' => [],//$model->Select2Init('icon')['initialPreview'],
            //'initialPreviewConfig'=> //$model->Select2Init('icon')['initialPreviewConfig'],
        ],
    ])*/ ?>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-offset-3 col-md-6">
            <?= Html::submitButton($model->isNewRecord ? '完成' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a('取消', Url::toRoute('index') ,['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php HodoActiveForm::end(); ?>

</div>
<div class="modal fade" id="picModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    上传图片
                </h4>
            </div>
            <div class="modal-body">
                <form  method="post" enctype="multipart/form-data" id= "uploadForm" action="http://ksadmin.youxilaile.com/cli_php/auto_load/get_picture_from_xiaoluad.php">
<!--                    <form  method="post" enctype="multipart/form-data" id= "uploadForm" action="http://localhost/admin.kuaiyouxi.com/cli_php/auto_load/get_picture_from_xiaoluad.php">-->
                    <input type="file" name="file" class="file" id="file"/>
                    <input type="text" name="token" hidden  value= "<?=md5('185c1053a5b7b580e30bffee9cce50c4')?>" >
                </form><hr>
                <div class="progress progress-striped active" >
                    <div class="progress-bar progress-bar-success bar" role="progressbar"
                         aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                         style="width: 0%;">
<!--                        <span class="bar" style="background: green;float: left;height: 100%;"></span>-->
                    </div>
<!--                    <span class="bar" style="background: green;float: left;height: 100%;"></span>-->
<!--                    <span class="percent">0%</span >-->
                </div>
<!--                <div class="files"></div>-->
<!--                <div id="showing"></div>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">关闭
                </button>
                    <button  class="btn btn-primary" data-dismiss="" id="upload">
                    上传
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<?php
    $js = <<<js
    $(document).ready(function(){
        var bar = $('.bar'); 
        var percent = $('.percent'); 
        var progress = $(".progress");
        //var showing   = $("#showing");
        //var files = $(".files"); 
        var type = '';
        $("#btn_image").click(function(){
            
           $('#picModal').modal('show');
           type ='image';
           return false;
        });
        
        $("#btn_image_vertical").click(function(){
            
            $('#picModal').modal('show');
            type ='image_vertical';
            return false;
        });
        
        $('#upload').click(function () {
        
               uploadPic();
        });
        
        function uploadPic() {
            
            console.log(type);
            $("#uploadForm").ajaxSubmit({
                beforeSend: function() { //开始上传 
                    
                    //showing.empty();//清空显示的图片
                    progress.show(); //显示进度条 
                    var percentVal = '0%'; //开始进度为0% 
                    bar.width(percentVal); //进度条的宽度 
                    percent.html(percentVal); //显示进度为0% 
                }, 
                uploadProgress: function(event, position, total, percentComplete) { 
                    var percentVal = percentComplete + '%'; //获得进度 
                    bar.width(percentVal); //上传进度条宽度变宽 
                    percent.html(percentVal); //显示上传进度百分比 
                },
                success:function(data) {

                    if(type == 'image') {
                        console.log(data);
                        $('#image').val(data);
                        $("#label_image").tooltip({
                          html : true,
                          title : "<img width='180px' src='"+data+"' >"
                        });
                    }else {
                        $('#image_vertical').val(data);
                        $("#label_image_vertical").tooltip({
                          html : true,
                          title : "<img width='180px' src='"+data+"'>"
                        });
                    }
                    //$("#showing").html("<img src='"+data+"'>"); 
                    $('#picModal').modal('toggle');
                    return false;
                },
            });
            return false;
        }
    });
js;
$this->registerJs($js, \yii\web\View::POS_END)
?>

