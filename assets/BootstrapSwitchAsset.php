<?php
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/4/21
 * Time: 下午2:57
 */

namespace app\assets;

use yii\web\AssetBundle;

class BootstrapSwitchAsset extends AssetBundle
{
    public $sourcePath = '@bower';
    public $js = [
        'bootstrap-switch/dist/js/bootstrap-switch.min.js',
    ];
    public $css = [
        'bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css'
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\YiiAsset',
    ];

}