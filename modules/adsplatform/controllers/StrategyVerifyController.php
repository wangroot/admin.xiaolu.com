<?php
/**
 * User: hongxiaobo
 * description:
 * Date: 2016/5/24
 * Time: 11:24
 */

namespace app\modules\adsplatform\controllers;


use app\components\HodoController;
use app\modules\adsplatform\models\StrategySearch;
use app\modules\adsplatform\models\StrategyVerifyForm;
use yii\data\ArrayDataProvider;
use app\modules\adsplatform\models\StrategyAdListSearch;
use app\modules\adsplatform\models\StrategyListSearch;
use app\modules\adsplatform\models\Strategy;
use yii\web\NotFoundHttpException;
use \Yii;

class StrategyVerifyController extends HodoController
{
    public function actionIndex()
    {

        $model = new StrategyVerifyForm();
        $strategy_model = new StrategySearch();
        $dataProvider = $strategy_model->search(Yii::$app->request->queryParams);

        if($model->load(Yii::$app->request->post())){
            $arr = $model->get_verify_stratrgy();
            if(is_array($arr)) {

                  $provider = new ArrayDataProvider([
                       'allModels' => $arr,
                       'key' => 'id',
                       'sort' => [
//                           'attributes' => ['id', 'username', 'email'],
                       ],
                       'pagination' => [
                           'pageSize' => 10,
                       ],
                   ]);

                return $this->render('index',[
                    'model' => $model,
                    'dataProvider' => $provider,
                ]);
            }
        }

        return $this->render('index',[
            'model' => $model,
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
}