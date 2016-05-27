<?php

namespace app\controllers;

use app\components\HodoController;
use Yii;
use app\models\CoopIncome;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use League\Csv\Reader;
use yii\filters\AccessControl;
/**
 * CoopIncomeController implements the CRUD actions for CoopIncome model.
 */
class CoopIncomeController extends HodoController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['/coop-income/index'],
                    ],
                    [
                        'actions' => ['switch-status'],
                        'allow' => true,
                        'roles' => ['/coop-income/switch-status'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['/coop-income/create'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['/coop-income/update'],
                    ],
                    [
                        'actions' => ['change-status'],
                        'allow' => true,
                        'roles' => ['/coop-income/change-status'],
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
     * 更改状态
     * 批量更新状态
     */
    public function actionChangeStatus(){
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException('请求出错007');
        }
        $keylist = Yii::$app->request->post('keylist');
        $status = Yii::$app->request->post('status');

        Yii::$app->response->format = Response::FORMAT_JSON;
        $count = [];
        foreach($keylist as $value){
            if($status){
                $count[] = CoopIncome::deleteAll('id=:i', [':i' => $value]);
            }else {
                $model = CoopIncome::findOne($value);
                $model->status = 1;
                $count[] = $model->save();
            }
        }
        if (count($count)>0) {
            return [
                'status' => 'success',
                'message' => '更改状态成功'
            ];
        }

    }

    /**
     * @param $id
     * @param $status
     * @return Response
     * @throws NotFoundHttpException
     * 单次更新状态
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
     * Lists all TmpIncome models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CoopIncome::find(),
            'sort' => [
                'defaultOrder' => [
                    'create_time' => SORT_DESC
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Creates a new TmpIncome model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CoopIncome();
        $dataProvide = [];
        /**
         * 此处理重复数据再次保存
         */
        if(Yii::$app->request->isAjax){
            $repeatData = json_decode($_POST['repeatData'], true );

            Yii::$app->response->format = Response::FORMAT_JSON;
            $count = $this->handleRepeatData($repeatData);
            if(count($count)){
                return [
                    'status' => 'success',
                    'url' => Url::toRoute(['index'])
                ];
            }
            return [
                'status' => 'fail',
                'url' => ''
            ];
        }
        /**
         * 处理上传文件
         */
        if (Yii::$app->request->isPost && !empty($_FILES['CoopIncome']['name']['imageFile'])) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                $csv = Reader::createFromPath($model->path);
                $result = $csv->fetchAll();
                $model->channel = $_POST['CoopIncome']['channel'];

                switch(count($result[0])){
                    case 9:
                        $dataProvide = $this->baiduImport($result, $model);
                        break;
                    case 7:
                        $dataProvide = $this->GuangDingTongImport($result, $model);
                        break;
                }
                if(count($dataProvide) <= 0){
                    $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataProvide' => $dataProvide,
        ]);

    }

    /**
     * Updates an existing TmpIncome model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->click_rate = (string)round((($model->click_total/$model->show_total)*100), 2);
            $model->eCPM = round($model->income/($model->show_total/1000), 2);
            if($model->save()){
                return $this->redirect(['index', 'id' => $model->id]);
            }
        }
            return $this->render('update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing TmpIncome model.
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
     * Finds the TmpIncome model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TmpIncome the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CoopIncome::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $result
     * @param $dataProvide
     * @return array
     */
    protected function baiduImport($result, $modelData)
    {
        $dataProvide = [];
        array_shift($result);
        array_pop($result);
        foreach ($result as $key => $value) {
            $value[0] = iconv('GB2312', 'UTF-8', $value[0]);
            $value[7] = iconv('GB2312', 'UTF-8', $value[7]);
            $value[8] = iconv('GB2312', 'UTF-8', $value[8]);
            $showTotal = is_numeric($value[2])?$value[2]:0;
            $clickTotal = is_numeric($value[3])?$value[3]:0;
            $income = is_numeric($value[4]) ? $value[4] : 0;
            $eCPM = is_numeric($value[5]) ? $value[5] : 0;
            $CPC = is_numeric($value[6]) ? $value[6] : 0;

            $model = new CoopIncome();
            $model->show_total = $showTotal;
            $model->click_total = $clickTotal;
            $model->income = $income;
            $model->create_time = time();
            $model->CPC = $CPC;
            $value[7] = round($income/($showTotal/1000), 2);
            $model->ad_type = $value[0];
            $model->date_time = strtotime($value[1]);
            $model->eCPM = (string)$value[7];
            $model->click_rate = (string)$value[8];
            $model->channel = $modelData->channel;
            $model->status = 0;
            if (!$model->save()) {
                $dataProvide[$key] = $model;
            }
        }
        return $dataProvide;
    }
    /**
     * @param $result
     * @param $dataProvide
     * @return array
     */
    protected function GuangDingTongImport($result, $modelData)
    {
        $dataProvide = [];
        array_shift($result);
        array_pop($result);
        foreach ($result as $key => $value) {
            $showNumber = str_replace(',', '',$value[2]);
            $clickNumber = str_replace(',', '',$value[3]);
            $showTotal = is_numeric($showNumber)?$showNumber:0;
            $clickTotal = is_numeric($clickNumber)?$clickNumber:0;
            $income = is_numeric($value[4]) ? $value[4] : 0;
            $eCPM =  0;
            $CPC =  0;
            $model = new CoopIncome();
            $model->show_total = $showTotal;
            $model->click_total = $clickTotal;
            $model->income = $income;
            $model->create_time = time();
            $model->CPC = $CPC;
            $clickRate = $value[6];
            $model->ad_type = $value[1];
            $model->date_time = strtotime($value[0]);
            $model->eCPM = (string)$value[5];
            $model->click_rate = (string)rtrim($clickRate, '%');
            $model->channel = $modelData->channel;
            $model->status = 0;
            if (!$model->save()) {
                $dataProvide[$key] = $model;
            }
        }
        return $dataProvide;
    }

    /**
     * @param $repeatData
     */
    protected function handleRepeatData($repeatData)
    {
        foreach ($repeatData as $value) {

            $queryModel = CoopIncome::find()
                ->where('date_time=:c AND channel=:ch', [':c' => $value['date_time'], ':ch' => $value['channel']])
                ->one();

            $queryModel->show_total = ($queryModel->show_total) + $value['show_total'];
            $queryModel->click_total = ($queryModel->click_total) + $value['click_total'];
            $queryModel->income = ($queryModel->income) + $value['income'];
            $queryModel->update_time = time();
            $queryModel->click_rate = (string)(round(($queryModel->click_total / $queryModel->show_total) * 100, 2));
            $queryModel->eCPM = round($queryModel->income / ($queryModel->show_total / 1000), 2);
            $vilidate = $queryModel->getActiveValidators();
            unset($vilidate[5]);
            $count[] = $queryModel->save();
        }
        return $count;
    }
}
