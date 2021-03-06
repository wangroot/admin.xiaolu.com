<?php

/* @var $this yii\web\View */
use yii\bootstrap\Nav;
$this->title = '管理后台';
?>

<!-- /.row -->

<div class="row hidden">
    <div class="col-lg-3 col-md-6">
        <div class="alert alert-danger text-center">
            <div class="row">
                <div class="col-xs-2">
                    <i class="fa fa-bar-chart fa-5x"></i>&nbsp;
                </div>
                <div class="col-xs-10 text-right">
                    <div class="huge">34482</div>
                    <div>昨日流量收入</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="alert alert-success text-center">
            <div class="row">
                <div class="col-xs-2">
                    <i class="fa fa-bar-chart fa-5x"></i>&nbsp;
                </div>
                <div class="col-xs-10 text-right">
                    <div class="huge">35454</div>
                    <div>前七日流量收入</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="alert alert-info text-center">
            <div class="row">
                <div class="col-xs-2">
                    <i class="fa fa-bar-chart fa-5x"></i>&nbsp;
                </div>
                <div class="col-xs-10 text-right">
                    <div class="huge">34082</div>
                    <div>本月流量收入</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="alert alert-warning text-center">
            <div class="row">
                <div class="col-xs-2">
                    <i class="fa fa-bar-chart fa-5x"></i>&nbsp;
                </div>
                <div class="col-xs-10 text-right">
                    <div class="huge">34482</div>
                    <div>总流量收入</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->


<div class="panel panel-default hidden">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>2016-04-4-2016-09-30</h3>
    </div>
    <div class="panel-body">
        <div id="morris-area-chart"></div>
    </div>
</div>

<div style="margin-bottom: 1500px">
    <h3>正在施工</h3>
</div>

