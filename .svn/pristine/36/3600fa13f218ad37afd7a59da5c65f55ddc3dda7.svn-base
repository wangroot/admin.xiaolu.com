<?php
/**
 * Created by PhpStorm.
 * User: i-sheng
 * Date: 15-11-20
 * Time: 下午3:23
 */

namespace app\assets;

use yii\web\AssetBundle;
class SweetalertAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap-sweetalert/lib';

    /**
     * Initializes the bundle.
     * If you override this method, make sure you call the parent implementation in the last.
     */
    public function init()
    {
        parent::init();
        $js = YII_DEBUG ? 'sweet-alert.js': 'sweet-alert.min.js' ;
        $this->js = [
            $js
        ];
        $this->css = ['sweet-alert.css'];

    }


}