<?php
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/4/21
 * Time: 下午8:26
 */

namespace app\assets;


use yii\web\AssetBundle;

class BootstrapjsAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist';

    public $js = [
        'js/bootstrap.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\YiiAsset',
    ];

}