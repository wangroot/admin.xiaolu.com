<?php

namespace app\modules\adsplatform\controllers;

use Yii;
use app\modules\adsplatform\models\StrategyList;
use app\modules\adsplatform\models\StrategyListSearch;
use app\components\HodoController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\HodoActiveForm;
use yii\helpers\Url;
use yii\web\Response;
use yii\filters\AccessControl;
/**
 * StrategyListController implements the CRUD actions for StrategyList model.
 */
class StrategyListController extends HodoController
{
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
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    public function actionSwitchStatus($id, $status, $strategy_id){
        $model = $this->findModel($id);
        $model->status = $status;
        if($model->save(false)){
            return $this->redirect(['index', 'strategy_id' => $strategy_id]);
        }
        return $this->redirect(['index', 'strategy_id' => $strategy_id]);
    }

    /**
     * Lists all StrategyList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StrategyListSearch();

        $searchModel->strategy_id = Yii::$app->request->getQueryParam('strategy_id');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StrategyList model.
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
     * Creates a new StrategyList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StrategyList();
        $model->strategy_id = Yii::$app->request->getQueryParam('strategy_id');
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $result = HodoActiveForm::validate($model);
            if(empty($result) && $model->save()){
                return $this->renderAlert('添加成功', '恭喜你添加应用成功','进行下一步操作','', 2);
            }
            return $result;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id, 'strategy_id' => $model->strategy_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StrategyList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StrategyList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $this->findModel($id)->delete();
            return[
                'status' => 'success'
            ];
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StrategyList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StrategyList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StrategyList::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
