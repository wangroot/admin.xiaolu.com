/**
 * Created by sheng on 16/5/5.
 */

function initAjax() {
    var $this = $(this);
    var dataUrl = $this.attr('data-url');
    var $positionId = $this.val();
    $.ajax({
        type: "GET",
        url: dataUrl,
        data: {positionId: $positionId},
        dataType: 'json',
        success: function (res) {
            if (res.status != 'success') {
                alert(res);
            }
            var $html = '<option value=""> </option>';
            var $str = '';
            var i = 0;
            $.each(res.data, function (key, value) {
                $html += '<option value="' + key + '">' + value + '</option>';
                $str = value;
                i++;
            });
            $('#addAdForm').find('.select2-clone').html($html);
            $id = $('#addAdForm').find('.select2-clone').attr('id');
            $('#' + $id).select2("val", "");
        },
        error: function () {
            alert('出错了!找程序员来.');
        }
    });
}
/**
 * 导航js
 */
$(document).ready(function() {

    if($("#addAdForm .panel-body").length == 2){
        var h = $("#addAdForm").height()-103;
        $('#addAdForm .addButton').css({ top: Math.round(h/2, 2)});
    }

    initAjax.call($('#strategy-position_id'));
    /**
     * 广告类型
     */
    $('#strategy-position_id').change(function () {
        initAjax.call(this);
    });


    /**
     * 策略创建
     */
    $("#addAdForm").on('change','select.ad-provider-search',function(){
        var $this = $(this);
        var dataUrl = $this.attr('data-url');
        var $providerId = $this.val();
        var $positionId =  $('#strategy-position_id').val();
        $.ajax({
            type: "GET",
            url: dataUrl,
            data: { providerId:$providerId, positionId:$positionId },
            success: function(res){
                if(res.status != 'success'){
                    alert(res);
                }
                var $html = '<option value=""> </option>';
                var $str= '';
                var i = 0;
                $.each(res.data, function (key, value) {
                    $html += '<option value="'+key+'">'+value+'</option>';
                    $str = value;
                    i++;
                });

                $this.parent().next().find('.select2-clone').html($html);
                $id = $this.parent().next().find('.select2-clone').attr('id');
                $('#'+$id).select2("val", "");
            },
            error: function () {
                alert('出错了!找程序员来.');
            },
            dataType: 'json'
        });
    });
    /**
     * 克隆内容--在添加广告哪里
     * @type {number}
     */
    var cloneIndex = 0;
    $("#addAdForm").on('click', '.addButton', function () {
        cloneIndex++;
        var config = {"theme":"krajee","width":"100%","placeholder":"名称","language":"zh-CN"};
        var s2options_d6851687 = {"themeCss":".select2-container--krajee","sizeCss":"","doReset":true,"doToggle":false,"doOrder":false};

        var $template = $("#cloneTemplate"),
            $clone = $template.clone()
                .removeClass('hidden')
                .removeAttr('id')
                .attr('data-index', cloneIndex)
                .insertBefore($template);
        $selectId = 'StrategyAdList'+cloneIndex;
        $clone.find('.select2-clone').attr('id', $selectId).end()
            .find('[type="radio"]').attr('name', 'StrategyAdList[status]['+cloneIndex+']').end()
            .find('.select2-clone').attr('name', 'StrategyAdList[name][]').end()
            .find('.strategyAdListWeight').attr('name', 'StrategyAdList[weight][]').end();

        if (jQuery('#'+$selectId).data('select2')) { jQuery('#'+$selectId).select2('destroy'); }
        jQuery.when(jQuery('#'+$selectId).select2(config)).done(initS2Loading($selectId,'s2options_d6851687'));
        var h = $("#addAdForm").height()+parseInt($(this).css('top'))-50;
        $(this).css({ top: Math.round(h/2, 2)});
    }).on('click', '.removeButton', function () {
        var dataUpdate = $(this).attr('data-update');
        var id = $(this).attr('data-id');
        if(dataUpdate == 'true'){
            var html = '<input type="text" class="hidden" name="StrategyAdList[delete]['+id+']" value="">';
            $('#addAdForm').before(html);
        }
        var $row = $(this).parents('.panel-body');
        $row.remove();
        var h = $("#addAdForm").height()+parseInt($('#addAdForm .addButton').css('top'))-180;
        $('#addAdForm .addButton').css({ top: Math.round(h/2, 2)});
    });

    /**
     * 版本号内容复制
     */
    $('#cloneTemplateStrategyList').on('click', '#add-version-click', function () {
        var $template = $("#add-version"),
            $clone = $template.clone()
                .removeClass('hidden')
                .removeAttr('id')
                .attr('data-index', cloneIndex)
                .insertBefore($template);
        $clone.find('textarea').attr('name', 'StrategyList[contents][2][]').end()
            .find('select').attr('name', 'StrategyList[rule][2][]').end();
        initHintBlocksXiaolu();
    }).on('click', '.removeButton', function () {
        var dataUpdate = $(this).attr('data-update');
        var id = $(this).attr('data-id');
        if(dataUpdate == 'true'){
            var html = '<input type="text" class="hidden" name="StrategyList[delete]['+id+']" value="">';
            $('#cloneTemplateStrategyList').before(html);
        }
        var $row = $(this).parents('.row');
        $row.remove();
    });
    /**
     * 包名内容复制
     */
    $('#cloneTemplateStrategyList').on('click', '#add-package-click', function () {
        var $template = $("#add-package"),
            $clone = $template.clone()
                .removeClass('hidden')
                .removeAttr('id')
                .attr('data-index', cloneIndex)
                .insertBefore($template);
        $clone.find('textarea').attr('name', 'StrategyList[contents][1][]').end()
            .find('select').attr('name', 'StrategyList[rule][1][]').end();
        initHintBlocksXiaolu();
    }).on('click', '.removeButton', function () {
        var dataUpdate = $(this).attr('data-update');
        var id = $(this).attr('data-id');
        if(dataUpdate == 'true'){
            var html = '<input type="text" class="hidden" name="StrategyList[delete]['+id+']" value="">';
            $('#cloneTemplateStrategyList').before(html);
        }
        var $row = $(this).parents('.row');
        $row.remove();
    });
    /**
     * 地域选择内容复制
     */
    $('#cloneTemplateStrategyList').on('click', '#add-position-click', function () {
        var $template = $("#add-position"),
            $clone = $template.clone()
                .removeClass('hidden')
                .removeAttr('id')
                .attr('data-index', cloneIndex)
                .insertBefore($template);
        $clone.find('textarea').attr('name', 'StrategyList[contents][position][]').end()
            .find('select').attr('name', 'StrategyList[rule][position][]').end();
        initHintBlocksXiaolu();
    }).on('click', '.removeButton', function () {
        var dataUpdate = $(this).attr('data-update');
        var id = $(this).attr('data-id');
        if(dataUpdate == 'true'){
            var html = '<input type="text" class="hidden" name="StrategyList[delete]['+id+']" value="">';
            $('#cloneTemplateStrategyList').before(html);
        }
        var $row = $(this).parents('.row');
        $row.remove();
    });
    /**
     * 手机品牌内容复制
     */
    $('#cloneTemplateStrategyList').on('click', '#add-phone-click', function () {
        var $template = $("#add-phone"),
            $clone = $template.clone()
                .removeClass('hidden')
                .removeAttr('id')
                .attr('data-index', cloneIndex)
                .insertBefore($template);
        $clone.find('textarea').attr('name', 'StrategyList[contents][3][]').end()
            .find('select').attr('name', 'StrategyList[rule][3][]').end();
        initHintBlocksXiaolu();
    }).on('click', '.removeButton', function () {
        var dataUpdate = $(this).attr('data-update');
        var id = $(this).attr('data-id');
        if(dataUpdate == 'true'){
            var html = '<input type="text" class="hidden" name="StrategyList[delete]['+id+']" value="">';
            $('#cloneTemplateStrategyList').before(html);
        }
        var $row = $(this).parents('.row');
        $row.remove();
        return false;
    });
    /**
     * 渠道选择内容复制
     */
    $('#cloneTemplateStrategyList').on('click', '#add-channel-click', function () {
        var $template = $("#add-channel"),
            $clone = $template.clone()
                .removeClass('hidden')
                .removeAttr('id')
                .attr('data-index', cloneIndex)
                .insertBefore($template);
        $id = 'channel-select'+cloneIndex;
        $clone.find('.channel-clone')
            .attr('name', 'StrategyList[contents][0][]')
            .attr('id', $id)
            .attr('multiple', 'multiple')
            .attr('data-s2-options', 's2options_xiaolu').end()
            .find('select.channel-select').attr('name', 'StrategyList[rule][0][]').end();

        cloneIndex++;
        var config = {"theme":"krajee","width":"100%","placeholder":"名称","language":"zh-CN"};
        var s2options_xiaolu = {"themeCss":".select2-container--krajee","sizeCss":"","doReset":true,"doToggle":true,"doOrder":false};
        if (jQuery('#'+$id).data('select2')) { jQuery('#'+$id).select2('destroy'); }
        jQuery.when(jQuery('#'+$id).select2(config)).done(initS2Loading($id,'s2options_xiaolu'));
        $("#"+$id).select2("val", "");
        initHintBlocksXiaolu();
        //$('#cloneTemplateStrategyList .select2-selection__choice').remove();

    }).on('click', '.removeButton', function () {
        var dataUpdate = $(this).attr('data-update');
        var id = $(this).attr('data-id');
        if(dataUpdate == 'true'){
            var html = '<input type="text" class="hidden" name="StrategyList[delete]['+id+']" value="">';
            $('#cloneTemplateStrategyList').before(html);
        }
        var $row = $(this).parents('.row');
        $row.remove();
        return false;
    });

    /*
     发送ajax数据到api
     */
    var form = $('form#send-ajax-data');
    if(form.find('.has-error').length) {
        return false;
    }
    form.find('#Submit-data-ajax').click(function(){
        $.ajax({
            url: form.attr('data-url'),
            type: 'post',
            data: form.serialize(),
            success: function(response) {

                if (response.status == 'message') {
                    swal("请重新选择", response.message, "error");
                    return false;
                }

                if(response.status == 'success' ){
                    swal({
                        title: '添加成功',
                        text: '',
                        type: 'success',
                        showCancelButton: true,
                        confirmButtonClass: 'btn-success',
                        confirmButtonText: '返回流量列表',
                        closeOnConfirm: false,
                        cancelButtonText: '关闭'
                    },function(isConfirm){
                        if (isConfirm) {
                            if(response.url != ''){
                                window.location.href = response.url;
                            }
                        } else {
                            if(response.updateUrl){
                                window.location.href = response.updateUrl;
                            }else {
                                window.location.reload();
                            }
                        }
                    });
                    return false;
                }
                form.yiiActiveForm('updateMessages', response , true);
            }
        });
    });


    /**
     * 生成随机字符
     */
    var generateRandomString = function () {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (var i = 0; i<5; i++){
            text += possible.charAt(Math.floor(Math.random * possible.length));
        }
        return text;
    }

});