<?php
namespace app\components;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
/**
 * Created by PhpStorm.
 * User: i-sheng
 * Date: 15-11-6
 * Time: 下午4:08
 */
class HodoController extends \yii\web\Controller
{
    /**
     * @return array
     */
    public function renderAlert($title='添加成功', $text='恭喜你添加成功',$confirmButtonText='进行下一步操作',$href='', $tabs = 1 )
    {
        return [
            'status' => 'success',
            'title' => $title,
            'text' => $text,
            'type' => 'success',
            'showCancelButton' => true,
            'confirmButtonClass' => 'btn-success',
            'confirmButtonText' => $confirmButtonText,
            'href' => $href,
            'tabs' => $tabs,
        ];
    }
    /**
     * @return array
     */
    public function renderErrorAlert($title='出错了', $text='请联系管理员。谢谢',$confirmButtonText='',$href='' )
    {
        return [
            'status' => 'warning',
            'title' => $title,
            'text' => $text,
            'type' => 'success',
            'showCancelButton' => true,
            'confirmButtonClass' => 'btn-success',
            'confirmButtonText' => $confirmButtonText,
            'href' => $href,
        ];
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'switch-status', 'tabs'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => false,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


}