<?php

namespace app\modules\adsplatform\controllers;

use app\modules\adsplatform\models\AdPosition;
use app\modules\adsplatform\models\AdPositionSearch;
use Yii;
use app\modules\adsplatform\models\Ad;
use app\modules\adsplatform\models\AdSearch;
use app\components\HodoController;
use yii\base\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AdController implements the CRUD actions for Ad model.
 */
class AdController extends HodoController
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
                        'roles' => ['/adsplatform/ad/index'],
                    ],
                    [
                        'actions' => ['ad-create'],
                        'allow' => true,
                        'roles' => ['/adsplatform/ad/ad-create'],
                    ],
                    [
                        'actions' => ['ad-update'],
                        'allow' => true,
                        'roles' => ['/adsplatform/ad/ad-update'],
                    ],
                    [
                        'actions' => ['ad-delete'],
                        'allow' => true,
                        'roles' => ['/adsplatform/ad/ad-delete'],
                    ],
                    [
                        'actions' => ['list'],
                        'allow' => true,
                        'roles' => ['/adsplatform/ad/list'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['/adsplatform/ad/view'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['/adsplatform/ad/create'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['/adsplatform/ad/update'],
                    ],
                    [
                        'actions' => ['switch-status'],
                        'allow' => true,
                        'roles' => ['/adsplatform/ad/switch-status'],
                    ],
                    [
                        'actions' => ['status'],
                        'allow' => true,
                        'roles' => ['/adsplatform/ad/status'],
                    ],
                    [
                        'actions' => ['json'],
                        'allow' => true,
                        'roles' => ['/adsplatform/ad/json'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['/adsplatform/ad/delete'],
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

    /**
     * @return string
     *代码位管理列表页面
     */
    public function actionList(){
        $searchModel = new AdPositionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * 代码位更新
     */
    public function actionAdUpdate($id){
        $model = AdPosition::findOne($id);
        if ( $model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $model->start_time = date('Y-m-d H:i:s', $model->start_time);
        $model->end_time = date('Y-m-d H:i:s', $model->end_time);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['list', 'id' => $model->id]);
        } else {
            return $this->render('ad_create', [
                'model' => $model,
            ]);
        }
    }

    public function actionAdDelete($id){
        $this->findAdPositionModel($id)->delete();

        return $this->redirect(['list']);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionAdCreate(){
        $model = new AdPosition();
        $model->start_time = date('Y-m-d H:i:s');
        $model->end_time = date('Y-m-d H:i:s', strtotime('+1month'));
        $model->show_time = 5;
        $model->ceiling_view = 0;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['list', 'id' => $model->id]);
        } else {
            return $this->render('ad_create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @param $status
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * 通过id来获取广告数据
     */
    public function actionJson($providerId=null, $positionId=null){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (!Yii::$app->request->isAjax) {
            return [
                'status' => 'error'
            ];
        }

        $result = Ad::getAdList($providerId, $positionId);
        return [
            'status' => 'success',
            'data' => $result
        ];
    }

    /**
     * @param $id
     * @param $status
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * 自主广告的状态
     */
    public function actionSwitchStatus($id, $status){
        $model = $this->findModel($id);
        $model->status = $status;
        if($model->save(false)){
            return $this->redirect(['index']);
        }
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @param $status
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * 联盟广告的状态
     */
    public function actionStatus($id, $status){
        $model = $this->findModel($id);
        $model->status = $status;
        if($model->save(false)){
            return $this->redirect(['list']);
        }
        return $this->redirect(['list']);
    }

    /**
     * Lists all Ad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdSearch();
        $searchModel->provider = 0;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ad model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Ad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ad();
        $model->ceiling_total_click = 100000000;
        $model->ceiling_total_view = 100000000;
        $model->type = 1;
        $model->target = 0;
        $model->status = 0;
        $model->collect_data = 0;
        $model->version_code = 0;
        $model->ceiling_view = 2;
        $model->show_time = 5;
        $model->ceiling_day_click = 1000000;
        $model->ceiling_day_view = 1000000;
        $model->start_time = date('Y-m-d H:i:s');
        $model->end_time = date('Y-m-d H:i:s', strtotime('+1month'));
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (isset($_GET['callUrl'])) {
                return $this->redirect($_GET['callUrl']);
            }
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->start_time = date('Y-m-d H:i:s', $model->start_time);
        $model->end_time = date('Y-m-d H:i:s', $model->end_time);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'AdSearch[id]' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ad model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findAdPositionModel($id)
    {
        if (($model = AdPosition::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
