<?php
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/4/25
 * Time: 下午2:52
 */

namespace app\modules\adsplatform\controllers;

use app\modules\adsplatform\models\AnalysisEffect;
use app\modules\adsplatform\models\Datadict;
use app\modules\adsplatform\models\Position;
use yii\web\HttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;
class AdAnalysisController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index' ,'send-mail'],
                        'allow' => true,
                        'roles' => ['/adsplatform/ad-analysis/index'],
                    ],
                    [
                        'actions' => ['data'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * @return string 通过列表来查看数据
     */
    public function actionIndex(){

        $searchModel = new AnalysisEffect();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->request->isAjax) {
            $searchModel->getJsonData();
        }
        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 把报表定时发送邮件任务
     *
     */
    public function actionSendMail(){
        $this->authKey();
        $dateStart =  strtotime(date('Y-m-d').' 00:00:00');
        $dateEnd =  strtotime(date('Y-m-d').' 23:59:59');
        $dataProvider = AnalysisEffect::find()
            ->where('date>=:s and date<=:e', [':s'=>$dateStart, ':e'=>$dateEnd])
            ->all();

//        return $this->renderPartial('test',[
//            'dataProvider' => $dataProvider
//        ]);
//        die;
        $users = Datadict::getDataList('analysis_data_send_mail');
        var_dump($users);
        $messages = [];
        foreach ($users as $user) {
            $messages[] = Yii::$app->mailer->compose('index', ['dataProvider' => $dataProvider])
                ->setFrom('zepingmon@163.com')
                ->setTo($user)
                ->setSubject('统计报表'.date('Y-m-d', strtotime('-1 day')))
                ->setTextBody('统计报表');
        }
       $count = Yii::$app->mailer->sendMultiple($messages);
        var_dump($count);
    }
    /**
     * 报表定时请求
     */
    public function actionData(){
        $this->authKey();
        $queryDate = date('Ymd', strtotime('-1 day'));
        // 分表临界点，之前的不做处理
        if($queryDate <= 20160428){
            throw new HttpException(500, '表不存在~');
        }
        /**
         * 分库的连接
         * @var $db2 \yii\db\Connection
         */
        $table = 'effect_'.date('Ymd', strtotime('-1 day'));
        $db2 = Yii::$app->db2;
        $db = \Yii::$app->db;
for($i=0; $i<=7; $i++){
    $createTable = 'effect_'.date('Ymd', strtotime($i.' day'));
    $createSql =<<<EOD
CREATE TABLE IF NOT EXISTS {$createTable} LIKE effect;
EOD;
    $db2->createCommand($createSql)->execute();
}
        $command = $db2->createCommand("SHOW TABLES LIKE '{$table}'");
        $count = $command->queryAll();
        if (empty($count)) {
            throw new HttpException(500,'表不存在');
        }

        $query_date = date('Y-m-d');
        $GetQuery = Yii::$app->request->getQueryParam('query_date');
        if (!empty($GetQuery)) {
            $query_date = Yii::$app->request->getQueryParam('query_date');
        }

        $date = strtotime(date('Y-m-d'));
        $dateStr = date('Y-m-d');

        $dateStart = strtotime('-1 day', strtotime($query_date.' 00:00:00'));
        $dateEnd = strtotime('-1 day', strtotime($query_date.' 23:59:59'));
        /**
         * @var $db \yii\db\Connection
         */
        $sql =<<<SQL
SELECT ad_id, create_time, result, COUNT(*) AS count FROM {$table}  WHERE create_time >= '{$dateStart}' AND create_time <= '{$dateEnd}'  GROUP BY result,ad_id
SQL;
        echo $sql;
        $query = $db2->createCommand($sql);
        $res = $query->queryAll();

        foreach($res as $value){
            switch($value['result']){
                case 0:
                    $arr = [
                        'total_failure' =>$value['count'] ,
                        'ad_id' => $value['ad_id'],
                    ];
                    break;
                case 1:
                    $arr = [
                        'total_view' =>$value['count'] ,
                        'ad_id' => $value['ad_id'],
                    ];
                    break;
                case 2:
                    $arr = [
                        'total_click' =>$value['count'] ,
                        'ad_id' => $value['ad_id'],
                    ];
                    break;
                case 3:
                    $arr = [
                        'total_download' =>$value['count'] ,
                        'ad_id' => $value['ad_id'],
                    ];
                    break;
                case 4:
                    $arr = [
                        'total_install' =>$value['count'] ,
                        'ad_id' => $value['ad_id'],
                    ];
                    break;
            }

            $where = array(//making selection
                'ad_id' => $value['ad_id'],
                'date' => $date
            );

            $adSql =<<<EOD
SELECT `provider`, `position_id`, `title` FROM `ad` WHERE id={$value['ad_id']}
EOD;
            $adResult = Yii::$app->db->createCommand($adSql)->queryOne();
            $provider = Datadict::getDataValue('ad_provider', $adResult['provider']);
            $position = Position::findOne($adResult['position_id']);
            $ad_name = '广告主='.$provider.'-广告位置='.$position->name.'-广告标题='.$adResult['title'];

            $count = AnalysisEffect::find()
                ->select('COUNT(*) AS c')
                ->where('ad_id=:ad_id and `date`=:date', $where)
                ->count();

            $arrpush = [
                'date' => $date ,
                'create_time' => time(),
                'ad_name' => $ad_name
            ];
            $arr = $arr+$arrpush;
            if (empty($count)) {
                $result = $db->createCommand()->insert('analysis_effect', $arr)->execute();
            }else{
                unset($arr['ad_id']);
                $result = $db->createCommand()->update('analysis_effect', $arr, $where)->execute();
            }
            var_dump($result);
        }
    }

    protected function authKey()
    {
        $key = Yii::$app->request->getQueryParam('key');
        if ('RdlaHgZsBVFQooiBBypIVxcRGYWjYUJq' !== $key)
            throw new HttpException(500);
    }
}