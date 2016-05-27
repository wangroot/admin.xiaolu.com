<?php

use yii\helpers\Html;
use app\components\HodoActiveForm;
use app\modules\adsplatform\models\Datadict;
use app\modules\adsplatform\models\Position;
use kartik\select2\Select2;
use yii\helpers\Url;
use app\modules\adsplatform\models\Ad;
use app\modules\adsplatform\models\Provider;

\app\assets\SweetalertAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\modules\adsplatform\models\Strategy */
/* @var $form app\components\HodoActiveForm */
$url = $model->isNewRecord?Url::toRoute(['create']):Url::toRoute(['update', 'id' => $model->id]);
$this->registerJsFile('@web/js/analysis.js', ['position' => \yii\web\View::POS_END , 'depends' => 'app\assets\AppAsset']);
?>

<div class="strategy-form">

    <?php $form = HodoActiveForm::begin([
        'action' => 'javascript:void(0)',
        'options' => [
            'class' => 'form-horizontal',
            'id' => 'send-ajax-data',
            'data-url' => $url
        ],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-md-10\">{input}</div>\n<div class=\"col-md-offset-2 col-md-10\">{error}</div>",
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->textInput($model, 'name', ['labelOptions' => ['class' => 'control-label col-md-2']]) ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <?=
            $form->field($model, 'position_id', ['labelOptions' => ['class' => 'control-label col-md-2']])
                ->widget(Select2::className(), [
                    'language' => Yii::$app->language,
                    'data' => Position::getList(),
                    'options' => [
                        'data-url' => Url::toRoute(['json'])
                    ],
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
            <?= $form->textInput($model, 'weight', ['labelOptions' => ['class' => 'control-label col-md-2']]) ?>
        </div>
        <div class="col-md-6">
            <label for="" class="control-label input_tip">数值越高越优先展示</label>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'status', ['labelOptions' => ['class' => 'control-label col-md-2']])
                ->radioList(Datadict::getDataList('strategy_list_status'), [

                ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-2 control-label"><h4>全部广告</h4></label>
            </div>
        </div>
    </div>

    <div class="row" id="strategy_form_control">
        <div class="panel" id="addAdForm">
            <div class="panel-heading">
                <?= Html::a('添加广告',['/adsplatform/ad/ad-create']) ?>
<!--                <i>添加广告</i>-->
            </div>

            <div class="page-header"></div>
            <div class="panel-body">
                <div class="col-md-2">
                    厂商
                </div>
                <div class="col-md-4">
                    名称
                </div>

                <div class="col-md-2">
                    权重
                </div>

                <div class="col-md-2">
                    状态
                </div>

                <div class="col-md-1">
                    操作
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-primary btn-sm addButton absolute"><i class="fa fa-plus fa-2 " ></i></button>
                </div>
            </div>

            <?php if($model->isNewRecord){?>
            <div class="panel-body">
                <div class="col-md-2">
                    <?= Html::dropDownList('', null, ['' => '全部广告', 0=>'自主'] + Provider::getList(), [
                        'class' => 'form-control text-center ad-provider-search',
                        'id' => 'ad-search',
                        'data-url' => Url::toRoute(['json'])
                    ]) ?>
                </div>
                <div class="col-md-4">
                    <?=
                    Select2::widget([
                        'name' => 'StrategyAdList[name][]',
                        'value' => '',
                        'data' => ['' => ''] + Ad::getAdList(),
                        'options' => [
                            'multiple' => false,
                            'class' => 'select2-clone',
                            'id' => 'StrategyAdListOne',
                        ]
                    ]);
                    ?>
                </div>

                <div class="col-md-2">
                    <?=
                    Html::input('text', 'StrategyAdList[weight][]', 0, ["class" => "form-control strategyAdListWeight"])
                    ?>
                </div>

                <div class="col-md-2">
                    <?=
                    Html::radioList('StrategyAdList[status][]', 0, Datadict::getDataList('strategy_list_status'))
                    ?>
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm removeButton"><i class="fa fa-minus fa-2"></i></button>
                </div>
            </div>
            <?php }else{?>
                <?php foreach($strategyListAdModel as $key=>$value){?>
                    <div class="panel-body">

                        <div class="col-md-2">
                            <?= Html::dropDownList('', null, ['' => '全部广告', 0=>'自主'] + Provider::getList(), [
                                'class' => 'form-control text-center ad-provider-search',
                                'data-url' => Url::toRoute(['json'])
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?=
                            Select2::widget([
                                'name' => 'StrategyAdList[update]['.$value->id.'][ad_id]',
                                'value' => $value->ad_id,
                                'data' => Ad::getAdList(),
                                'options' => [
                                    'multiple' => false,
                                    'placeholder' => '名称'
                                ]
                            ]);

                            ?>
                        </div>

                        <div class="col-md-2">
                            <input value="<?= $value->weight?>" type="text" class="form-control strategyAdListWeight" name="StrategyAdList[update][<?= $value->id?>][weight]">
                        </div>

                        <div class="col-md-2">
                            <div>
                                <label>
                                    <input type="radio" name="<?= 'StrategyAdList[update]['.$value->id.'][status]'?>" value="0" <?= $value->status?'':'checked="checked"'?>>
                                    关闭
                                </label>
                                <label>
                                    <input type="radio" name="<?= 'StrategyAdList[update]['.$value->id.'][status]'?>" value="1" <?= $value->status?'checked="checked"':''?>>
                                    开启
                                </label>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <button type="button" data-update="true" data-id="<?=$value->id?>" class="btn btn-danger btn-sm removeButton"><i class="fa fa-minus"></i></button>
                        </div>
                        <div class="col-md-1">
                        </div>
                    </div>
                <?php }?>
            <?php }?>

            <!--the template for adding new field-->
            <div id="cloneTemplate" class="panel-body hidden">

                <div class="col-md-2">
                    <?= Html::dropDownList('', null, ['' => '全部广告', 0=>'自主'] + Provider::getList(), [
                        'class' => 'form-control text-center ad-provider-search',
                        'data-url' => Url::toRoute(['json'])
                    ]) ?>
                </div>

                <div class="col-md-4">
                    <?=
                    Html::dropDownList('', null, Ad::getAdList(),[
                        'id' => '',
                        "class" => "form-control select2-hidden-accessible select2-clone",
                        "name" => "StrategyAdList[name][]",
                        "data-s2-options" => "s2options_d6851687",
                        "data-krajee-select2" => "select2_21bcf4bc",
                        "style" => "",
                        "tabindex" => "-1",
                        "aria-hidden" => "true"
                    ]);
                    ?>
                </div>

                <div class="col-md-2">
                    <input value="0" type="text" class="form-control strategyAdListWeight" name="">
                </div>

                <div class="col-md-2">
                    <div>
                        <label>
                            <input type="radio" name="" value="0" checked="checked">
                            关闭
                        </label>
                        <label>
                            <input type="radio" name="" value="1">
                            开启
                        </label>
                    </div>
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm removeButton"><i class="fa fa-minus fa-2"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-2 control-label"><h4>投放策略</h4></label>
            </div>
        </div>
    </div>
    <!--添加投放策略-->
    <div id="cloneTemplateStrategyList">
        <div class="cloneTemplateStrategyList_a">
            <div class="row">
                <ul class="nav navbar-nav" style="margin-left: 15px">
                    <li class="dropdown off">

                        <a href="javascript:void(0)" class="dropdown-toggle " data-toggle="dropdown" aria-expanded="true">添加筛选条件<b class="caret"></b></a>

                        <ul class="dropdown-menu">
                            <li><a id="add-version-click" href="javascript:void(0)">版本号</a>
                            </li>
                            <li><a id="add-package-click" href="javascript:void(0)">包名</a>
                            </li>
                            <li><a id="add-position-click" href="javascript:void(0)">地域</a>
                            </li>
                            <li><a id="add-phone-click" href="javascript:void(0)">手机品牌</a>
                            </li>
                            <li><a id="add-channel-click" href="javascript:void(0)">渠道</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="cloneTemplateStrategyList_b">
            <?php if(!$model->isNewRecord){?>
                <?php foreach($strategyListModel as $value){?>
                    <!--版本号-->
                    <?php if(in_array($value->type, [0,1,2,3])){?>
                        <div class="row  top-buffer">
                            <div class="col-md-1">
                                <label class="control-label help" for="strategylist-version"><?= $typeData[$value->type]?></label>
                                <div class="hint-block"><?= $hintData[$value->type]?></div>
                            </div>
                            <div class="col-md-2">
                                <?= Html::dropDownList('StrategyList[update]['.$value->id.'][rule][]', $value->rule, [0 => '包含', 1 => '不包含',2 => '大于等于', 3 => '小于等于'], ["class"=>"form-control text-center"])?>
                            </div>

                            <?php if($value->type === 0){?>

                                <?=
                                '<div class="col-md-8">'.Select2::widget([
                                    'name' => 'StrategyList[update]['.$value->id.'][contents]',
                                    'value' => explode(',' , $value->rule_content),
                                    'data' => Datadict::getDataList('strategy_list_channels'),
                                    'options' => [
                                        'multiple' => true,
                                        'placeholder' => '名称'
                                    ]
                                ]).'</div>';

                                ?>

                            <?php }else{?>
                                <div class="col-md-4">
                                    <textarea name="<?= 'StrategyList[update]['.$value->id.'][contents][]'?>" id="strategy-list-version" class="form-control" cols="30" rows="5"><?= str_replace(',', "\r\n",$value->rule_content)?></textarea>

                                </div>
                            <?php }?>
                            <div class="col-md-1">
                                <button data-update="true" data-id="<?= $value->id?>" type="button" class="btn btn-default btn-sm removeButton"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    <?php }else{?>
                        <!--地域选择-->
                        <div class="row  top-buffer">
                            <div class="col-md-1">
                                <label class="control-label help" for="strategylist-version"><?= $typeData[$value->type]?></label>
                                <div class="hint-block"><?= $hintData[$value->type]?></div>
                            </div>
                            <div class="col-md-2">
                                <?= Html::dropDownList('StrategyList[update]['.$value->id.'][position][type][]', $value->type, [4 => '地区（国家）', 5 => '地区（省）' ,6 => '地区（市）'], ["class" =>"form-control text-center"])?>
                            </div>
                            <div class="col-md-2">
                                <?= Html::dropDownList('StrategyList[update]['.$value->id.'][position][rule][]', $value->rule, [0 => '包含', 1 => '不包含'], ["class"=>"form-control text-center"])?>
                            </div>
                            <div class="col-md-4">
                                <textarea name="<?= 'StrategyList[update]['.$value->id.'][contents][]'?>" id="strategy-list-version" class="form-control" cols="30" rows="5"><?= str_replace(',',"\r\n",$value->rule_content)?></textarea>
                            </div>
                            <div class="col-md-1">
                                <button data-update="true" data-id="<?= $value->id?>" type="button" class="btn btn-default btn-sm removeButton"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    <?php }?>
                <?php }?>
            <?php }?>

            <!--版本号-->
            <div class="row hidden top-buffer" id="add-version">
                <div class="col-md-1">
                    <label class="control-label help" for="strategylist-version">版本号</label>
                    <div class="hint-block">版本号不能出现两个都是包含或者不包含</div>
                </div>
                <div class="col-md-2">
                    <?= Html::dropDownList('', null, [0 => '包含', 1 => '不包含',2 => '大于等于', 3 => '小于等于'], ["class"=>"form-control text-center"])?>
                </div>
                <div class="col-md-4">
                    <textarea id="strategy-list-version" class="form-control" name="" cols="30" rows="5"></textarea>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-default btn-sm removeButton"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <!--包名-->
            <div class="row hidden top-buffer" id="add-package">
                <div class="col-md-1">
                    <label class="control-label help" for="strategylist-package">包名</label>
                    <div class="hint-block">多个包名就用英文逗号隔开,不能出现同一包名两次包含或者不包含</div>
                </div>
                <div class="col-md-2">
                    <?= Html::dropDownList('', null, [0 => '包含', 1 => '不包含'], ["class"=>"form-control text-center"])?>
                </div>
                <div class="col-md-4">
                    <textarea id="strategy-list-version" class="form-control" name="" cols="30" rows="5"></textarea>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-default btn-sm removeButton"><i class="fa fa-minus"></i></button>
                </div>
            </div>

            <!--地域选择-->
            <div class="row hidden top-buffer" id="add-position">
                <div class="col-md-1">
                    <label class="control-label" for="strategylist-version">地域</label>
                    <div class="hint-block">多个地域请用英文逗号[,]隔开不能出现同一地域两次包含或者不包含</div>
                </div>
                <div class="col-md-2">
                    <?= Html::dropDownList('', null, [4 => '地区（国家）', 5 => '地区（省）' ,6 => '地区（市）'], ["class" =>"form-control text-center"])?>
                </div>
                <div class="col-md-2">
                    <?= Html::dropDownList('', null, [0 => '包含', 1 => '不包含'], ["class"=>"form-control text-center"])?>
                </div>
                <div class="col-md-4">
                    <textarea id="strategy-list-version" class="form-control" name="" cols="30" rows="5"></textarea>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-default btn-sm removeButton"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <!--手机品牌-->
            <div class="row hidden top-buffer" id="add-phone">
                <div class="col-md-1">
                    <label class="control-label" for="strategylist-phone">手机品牌</label>
                    <div class="hint-block">多个手机品牌请用英文逗号[,]隔开不能出现同一手机品牌两次包含或者不包含</div>
                </div>

                <div class="col-md-2">
                    <?= Html::dropDownList('', null, [0 => '包含', 1 => '不包含'], ["class"=>"form-control text-center"])?>
                </div>
                <div class="col-md-4">
                    <textarea id="strategy-list-phone" class="form-control" name="" cols="30" rows="5"></textarea>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-default btn-sm removeButton"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <!--渠道选择-->
            <div class="row hidden top-buffer" id="add-channel">
                <div class="col-md-1">
                    <label class="control-label" for="strategylist-phone">渠道</label>
                    <div class="hint-block">多个渠道请用英文逗号[,]隔开不能出现同一渠道两次包含或者不包含</div>
                </div>
                <div class="col-md-2">
                    <?= Html::dropDownList('', null, [0 => '包含', 1 => '不包含'], ["class"=>"form-control text-center channel-select"])?>
                </div>
                <div class="col-md-8">
                    <?=
                    Html::dropDownList('', null, Datadict::getDataList('strategy_list_channels'),[
                        'id' => '',
                        "class" => "form-control select2-hidden-accessible channel-clone",
                        "name" => "",
                        "data-s2-options" => "s2options_d6851687",
                        "data-krajee-select2" => "select2_21bcf4bc",
                        "style" => "",
                        "tabindex" => "-1",
                        "aria-hidden" => "true"
                    ]);
                    ?>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-default btn-sm removeButton"><i class="fa fa-minus fa-2"></i></button>
                </div>
            </div>
        </div>
        
    </div>

    <div class="row" style="margin-top: 30px">
<!--        <div class="col-md-4">-->
<!---->
<!--        </div>-->
        <div class="col-md-12 text-right strategy_form_btn">
            <?= Html::submitButton($model->isNewRecord ? '完成' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary', 'id' => 'Submit-data-ajax', 'style'=>'
    margin-right: 25px;']) ?>

            <?= Html::a('取消', Url::toRoute('index') ,['class' => 'btn btn-lg btn-default']) ?>
        </div>
    </div>

    <?php HodoActiveForm::end(); ?>

</div>

<div style="margin-bottom: 100px"></div>
