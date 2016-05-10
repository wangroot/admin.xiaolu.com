<?php

namespace app\modules\adsplatform\controllers;

use app\modules\adsplatform\models\Datadict;
use app\modules\adsplatform\models\StrategyAdList;
use app\modules\adsplatform\models\StrategyList;
use Yii;
use app\modules\adsplatform\models\Strategy;
use app\modules\adsplatform\models\StrategySearch;
use app\modules\adsplatform\models\StrategyListSearch;
use app\modules\adsplatform\models\StrategyAdListSearch;

use app\components\HodoController;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use app\components\HodoActiveForm;
use yii\helpers\Url;
use yii\web\Response;

/**
 * StrategyController implements the CRUD actions for Strategy model.
 */
class StrategyController extends HodoController
{

    public function actionSwitchStatus($id, $status)
    {

        $model = $this->findModel($id);
        $model->status = $status;
        if ($model->save(false)) {
            return $this->redirect(['index']);
        }
        return $this->redirect(['index']);
    }

    /**
     * Lists all Strategy models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StrategySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Strategy model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchadlistModel = new StrategyAdListSearch();
        $searchadlistModel->strategy_id = $id;
        $dataProvider_adlist = $searchadlistModel->search(Yii::$app->request->queryParams);

        $searchModel = new StrategyListSearch();
        $searchModel->strategy_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $strategy_name = Strategy::findOne($id);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $this->findModel($id),
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'dataProvider_adlist' => $dataProvider_adlist,
                'searchadlistModel' => $searchadlistModel,
                'strategy_name' => $strategy_name['name']
            ]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new Strategy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Strategy();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $connection = Yii::$app->db;
            $Transaction = $connection->beginTransaction();
            try {
                $errors = [];
                $errorsMessage = '';
                if (!$model->save()) {
                    $Transaction->rollback();
                    $errors[] = $model->getErrors();
                    return [
                        'status' => 'fail',
                        'errors' => $errors
                    ];
                }
                $sAdList = Yii::$app->request->post('StrategyAdList');
                $sList = Yii::$app->request->post('StrategyList');

                if ($model->status && empty($sAdList)) {
                    $Transaction->rollback();
                    return [
                        'status' => 'message',
                        'message' => '流量策略开启状态一定要添加一个广告'
                    ];
                }

                if (!empty($sAdList)) {
                    $ad_id = ArrayHelper::getValue($sAdList, 'name');
                    $weight = ArrayHelper::getValue($sAdList, 'weight');
                    $status = ArrayHelper::getValue($sAdList, 'status');
                    foreach ($ad_id as $key => $val) {
                        $status = array_values($status);
                        $strategyAdListModel = new StrategyAdList();
                        $strategyAdListModel->strategy_id = $model->id;
                        $strategyAdListModel->ad_id = $val;
                        $strategyAdListModel->weight = $weight[$key];
                        $strategyAdListModel->status = $status[$key];
                        if (!$strategyAdListModel->save()) {
                            $errorsMessage .= '广告:'.implode("",array_map(function($a) {return implode("",$a);},$strategyAdListModel->errors));
                        }
                    }
                }
                if (!empty($sList)) {
                    $rule = ArrayHelper::getValue($sList, 'rule');
                    $contents = ArrayHelper::getValue($sList, 'contents');
                    foreach ([0, 1, 2, 3, 'position'] as $key => $value) {
                        if (!array_key_exists($value, $rule)) {
                            continue;
                        }

                        $versionRule = $ruleData = ArrayHelper::getValue($rule, $value);
                        $versionContents = ArrayHelper::getValue($contents, $value);
                        if ($value === 'position') {
                            if (count($versionRule) > 2) {
                                $versionRule = array_chunk($versionRule, 2);
                            } else {
                                $versionRule = [0];
                            }
                            $c = count($versionRule);
                        }
                        foreach ($versionRule as $k => $val) {
                            $strategyList = new StrategyList();
                            $strategyList->strategy_id = $model->id;
                            $strategyList->status = 1;
                            if ($value === 'position') {
                                $strategyList->type = $c==1?$ruleData[0]:$val[0];
                                $strategyList->rule = $c==1?$ruleData[1]:$val[1];
                                $strategyList->rule_content = $versionContents[$k];
                                //var_dump($versionRule,$c,$ruleData,$strategyList);die;

                            } elseif ($value === 0) {
                                $strategyList->type = $value;
                                $strategyList->rule = $val;
                                $strategyList->rule_content = count($versionContents) > 1 ? implode(',', $versionContents) : $versionContents[$k];
                            } else {
                                $strategyList->type = $value;
                                $strategyList->rule = $val;
                                $strategyList->rule_content = $versionContents[$k];

                            }
                            if (!$strategyList->save()) {
                                $errorsMessage .= '策略规则:'.implode("",array_map(function($a) {return implode("",$a);},$strategyList->errors));
                            }
                        }
                    }
                    //die;
                }
                if (strlen($errorsMessage) > 0) {
                    $Transaction->rollback();
                    return [
                        'status' => 'message',
                        'message' => $errorsMessage
                    ];
                }
                $Transaction->commit();
                return [
                    'status' => 'success',
                    'url' => Url::toRoute(['strategy/index']),
                    'updateUrl' => Url::toRoute(['strategy/update', 'id' => $model->id])
                ];
            } catch (Exception $e) {
                $Transaction->rollback();
                return [
                    'status' => 'fail',
                    'errors' => $errors
                ];
            }
        }
        $model->status = 0;
        $model->weight = 0;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['tabs', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 切换多个表
     */

    public function actionTabs($id)
    {
        $model = $this->findModel($id);

        return $this->render('tabs', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Strategy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $errors = [];
            $errorsMessage = '';
            if (!$model->save()) {
                $errors[] = $model->getErrors();
                return [
                    'status' => 'fail',
                    'errors' => $errors
                ];
            }
            $sAdList = Yii::$app->request->post('StrategyAdList');
            $sList = Yii::$app->request->post('StrategyList');

            if (!empty($sAdList)) {
                $updateData = ArrayHelper::getValue($sAdList, 'update');
                if (!empty($updateData)) {
                    foreach ($updateData as $id => $data) {
                        $row = StrategyAdList::updateAll($data, 'id=:i', [':i' => $id]);
                    }
                    unset($sAdList['update']);
                }
                $ad_id = ArrayHelper::getValue($sAdList, 'name');
                $weight = ArrayHelper::getValue($sAdList, 'weight');
                $status = ArrayHelper::getValue($sAdList, 'status');
                if (!empty($ad_id)) {
                    $status = array_values($status);
                    foreach ($ad_id as $key => $val) {
                        $strategyAdListModel = new StrategyAdList();
                        $strategyAdListModel->strategy_id = $model->id;
                        $strategyAdListModel->ad_id = $val;
                        $strategyAdListModel->weight = $weight[$key];
                        $strategyAdListModel->status = $status[$key];
                        if (!$strategyAdListModel->save()) {
                            $errorsMessage .= '广告:'.implode("",array_map(function($a) {return implode("",$a);},$strategyAdListModel->errors));
                        }
                    }
                }
            }

            if (!empty($sList)) {

                $rule = ArrayHelper::getValue($sList, 'rule');
                $contents = ArrayHelper::getValue($sList, 'contents');
                $sListUpdate = ArrayHelper::getValue($sList, 'update');

                if (!empty($sListUpdate)) {
                    //var_dump($sListUpdate);die;
                    foreach ($sListUpdate as $id => $value) {
                        if (isset($value['position'])) {
                            StrategyList::updateAll(['type' => $value['position']['type'][0], 'rule' => $value['position']['rule'][0], 'rule_content' => $value['contents'][0]], 'id=:i', [':i' => $id]);
                        } else {
                            $ruleContent = is_array($value['contents']) ? implode(',', $value['contents']) : $value['contents'][0];
                            StrategyList::updateAll(['rule' => $value['rule'][0], 'rule_content' => $ruleContent], 'id=:i', [':i' => $id]);
                        }
                    }
                    unset($sList['update']);
                }
                if (!empty($sList)) {
                    foreach ([0, 1, 2, 3, 'position'] as $key => $value) {
                        if (!array_key_exists($value, $rule)) {
                            continue;
                        }

                        $versionRule = $ruleData = ArrayHelper::getValue($rule, $value);
                        $versionContents = ArrayHelper::getValue($contents, $value);
                        if ($value === 'position') {
                            if (count($versionRule) > 2) {
                                $versionRule = array_chunk($versionRule, 2);
                            } else {
                                $versionRule = [0];
                            }
                            $c = count($versionRule);
                        }
                        foreach ($versionRule as $k => $val) {
                            $strategyList = new StrategyList();
                            $strategyList->strategy_id = $model->id;
                            $strategyList->status = 1;
                            if ($value === 'position') {
                                $strategyList->type = $c==1?$ruleData[0]:$val[0];
                                $strategyList->rule = $c==1?$ruleData[1]:$val[1];
                                $strategyList->rule_content = $versionContents[$k];
                                //var_dump($versionRule,$ruleData,$strategyList);die;

                            } elseif ($value === 0) {
                                $strategyList->type = $value;
                                $strategyList->rule = $val;
                                $strategyList->rule_content = count($versionContents) > 1 ? implode(',', $versionContents) : $versionContents[$k];
                            } else {
                                $strategyList->type = $value;
                                $strategyList->rule = $val;
                                $strategyList->rule_content = $versionContents[$k];
                            }
                            if (!$strategyList->save()) {
                                $errorsMessage .= '策略规则:' . implode("", array_map(function ($a) {
                                        return implode("", $a);
                                    }, $strategyList->errors));
                            }
                        }
                    }
                }
            }
            if (strlen($errorsMessage) > 0) {
                return [
                    'status' => 'message',
                    'message' => $errorsMessage
                ];
            }
            return [
                'status' => 'success',
                'url' => Url::toRoute(['strategy/index'])
            ];

        }

        $strategyListModel = StrategyList::find()->where('strategy_id=:i', [':i' => $id])->all();
        $strategyListAdModel = StrategyAdList::find()->where('strategy_id=:i', [':i' => $id])->all();

        $typeData = Datadict::getDataList('strategy_list_type');
        $hintData = Datadict::getDataList('strategy_list_hint');
        return $this->render('update', [
            'model' => $model,
            'strategyListModel' => $strategyListModel,
            'strategyListAdModel' => $strategyListAdModel,
            'typeData' => $typeData,
            'hintData' => $hintData,
        ]);
    }

    /**
     * Deletes an existing Strategy model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $connection = Yii::$app->db;
        $Transaction = $connection->beginTransaction();
        try {
            $this->findModel($id)->delete();
            StrategyList::deleteAll('strategy_id:s', [':s' => $id]);
            StrategyAdList::deleteAll('strategy_id:s', [':s' => $id]);
            $Transaction->commit();
        } catch (Exception $e) {
            $Transaction->rollback();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Strategy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Strategy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Strategy::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $model
     * @param $key
     * @param $value
     * @param $versionContents
     * @return StrategyList
     */
    protected function saveContent($model, $key, $value, $versionContents)
    {
        $strategyList = new StrategyList();
        $strategyList->strategy_id = $model->id;
        $strategyList->type = $key;
        $strategyList->rule = $value;
        $strategyList->rule_content = $versionContents[$key];
        $strategyList->save(false);
        return $strategyList;
    }
}
