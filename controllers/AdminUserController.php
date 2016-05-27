<?php

namespace app\controllers;

use app\models\AdminUserChannel;
use Yii;
use app\models\AdminUser;
use app\models\AdminUserSearch;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\HodoController;
use yii\filters\AccessControl;
/**
 * AdminUserController implements the CRUD actions for AdminUser model.
 */
class AdminUserController extends HodoController
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
                        'roles' => ['/admin-user/index'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['/admin-user/view'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['/admin-user/create'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['/admin-user/update'],
                    ],
                    [
                        'actions' => ['switch-status'],
                        'allow' => true,
                        'roles' => ['/admin-user/switch-status'],
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
     * Lists all AdminUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('view', [
                'model' => $this->findModel($id),
            ]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdminUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!in_array(Yii::$app->user->identity->username ,['liuyuefeng', 'chenlinsheng'], true)) {
            //throw new NotFoundHttpException('您没权限!....');
        }
        $model = new AdminUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            try{
                /*分配渠道*/
                foreach($model->channels as $value){
                    $adminUserChannel = new AdminUserChannel();
                    $adminUserChannel->admin_user_id = $model->id;
                    $adminUserChannel->channel = $value;
                    $adminUserChannel->status = 1;
                    $adminUserChannel->create_time = time();
                    $adminUserChannel->save();
                }
                /*分配权限*/
                $manager = Yii::$app->getAuthManager();
                $item = $manager->getRole($model->role);
                $item = $item ? : $manager->getPermission($model->role);
                $manager->assign($item, $model->id);
            }catch(\Exception $exc){

            }

            return $this->redirect(['index', 'AdminUser[id]' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!in_array(Yii::$app->user->identity->username ,['liuyuefeng', 'chenlinsheng'], true)) {
            //throw new NotFoundHttpException('您没权限!....');
        }
        $sql =<<<SQL
SELECT channel FROM admin_user_channel WHERE admin_user_id={$id}
SQL;
        $channel = Yii::$app->db->createCommand($sql)->queryColumn();
        $channelKey = array_values($channel);
        $channel = array_combine($channelKey, $channelKey);
        $model = $this->findModel($id);
        $model->channels = $channel;
        $model->password_hash = '';
        if($model->status == 11){
            $model->provider = 1;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminUser model.
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
     * Finds the AdminUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
