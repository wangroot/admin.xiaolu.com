<?php
/**
 * User: hongxiaobo
 * description: 渠道管理
 * Date: 2016/5/11
 * Time: 14:58
 */

namespace app\modules\adsplatform\controllers;


use app\components\HodoController;
use app\modules\adsplatform\models\Channel;
use app\modules\adsplatform\models\ChannelSearch;
use app\modules\adsplatform\models\Datadict;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ChannelController extends HodoController
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
                        'roles' => ['/adsplatform/channel/index'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['/adsplatform/channel/create'],
                    ],
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

    public function actionIndex()
    {

        $searchModel = new ChannelSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Channel();

        if ($model->load(\Yii::$app->request->post())) {

            $model->type = 'strategy_list_channels';
            $model->key  = $model->value;
            $model->status = 1;
            $model->create_time = time();
            if($model->save()) {
                return $this->redirect(['index', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing Position model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(\Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['index', 'id' => $model->id]);
    //     }else {
    //         return $this->render('update', [
    //             'model' => $model,
    //         ]);
    //     }
    // }
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }
    /**
     * Finds the Position model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Channel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Channel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    // public function actionSwitchStatus($id, $status){
    //     $model = $this->findModel($id);
    //     $model->status = $status;
    //     if($model->save(false)){
    //         return $this->redirect(['index']);
    //     }
    //     return $this->redirect(['index']);
    // }
}