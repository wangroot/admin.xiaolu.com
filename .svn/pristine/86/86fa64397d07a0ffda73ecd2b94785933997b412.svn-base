<?php
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/4/18
 * Time: 下午3:59
 */

namespace app\modules\adsplatform\controllers;


use app\components\HodoController;

class UploadFileController extends HodoController
{
    public function actionIndex(){
        require_once(\Yii::getAlias("@app").'/extensions/media_sdk_php/alimedia/alimage.class.php');
        require_once(\Yii::getAlias("@app").'/extensions/media_sdk_php/alimedia/alimage.class.php');
        require_once(\Yii::getAlias("@app").'/extensions/media_sdk_php/alimedia/alimage.class.php');
        $ak = '23045441';								// 用户的AK (user app key)
        $sk = '79ad20dee5bd28178fb957aef86bfefd';		// 用户的SK (user secret key)
        $namespace = 'qinning2';						// 空间名称  (user namespace)

        /*该测试方法主要是通过UploadPolicy设置文件上传到服务端的名称和路径*/
        /*第一步：（必须）引入AlibabaImage类，并设置AK和SK*/
        $aliImage  = new AlibabaImage($ak, $sk);		//设置AK和SK

        /*第二步：（必须）在上传策略UploadPolicy中指定用户空间名。也可以根据需要设置其他参数*/
        $uploadPolicy = new UploadPolicy( $namespace );	// 上传策略。并设置空间名
        $uploadPolicy->dir = '/PENGUY/appTemp/phpSdk';	// 文件路径，(可选，默认根目录"/")
        //$uploadPolicy->name = 'image_b'.time();			// 文件名，(可选，不能包含"/"。若为空，则默认使用文件名)

        /*第三步：（必须）进行文件上传*/
        $res = $aliImage->upload( 'image/tinyImg.jpg', $uploadPolicy );
        var_dump($res);
    }

}