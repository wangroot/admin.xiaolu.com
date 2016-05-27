<?php
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/5/10
 * Time: 上午10:42
 */

namespace app\modules\adsplatform\controllers;


use app\modules\adsplatform\models\AdminLog;
use Yii;
use app\components\HodoController;
use yii\filters\AccessControl;
class AdminLogController extends HodoController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['/adsplatform/admin-log/index'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(){

        $searchModel = new AdminLog();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


}