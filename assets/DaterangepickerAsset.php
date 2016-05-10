<?php
/**
 * Created by PhpStorm.
 * User: i-sheng
 * Date: 15-11-24
 * Time: 上午11:49
 */

namespace app\assets;




use yii\web\AssetBundle;

class DaterangepickerAsset extends AssetBundle
{
    public $sourcePath = '@bower';
    public $js = [
        'moment/moment.js',
        'bootstrap-daterangepicker/daterangepicker.js',
    ];
    public $css = [
        'bootstrap-daterangepicker/daterangepicker.css'
    ];
     public $depends = [
         'yii\bootstrap\BootstrapAsset',
         'yii\web\YiiAsset',
     ];
}