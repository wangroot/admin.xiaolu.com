<?php
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/5/10
 * Time: 上午10:42
 */

namespace app\modules\adsplatform\controllers;


use Yii;
use app\components\HodoController;
use app\modules\adsplatform\models\OperatingRecordLog;
use yii\filters\AccessControl;
class OperatingRecordLogController extends HodoController
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
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(){
        $searchModel = new OperatingRecordLog();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


}