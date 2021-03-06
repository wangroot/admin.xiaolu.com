<?php

namespace app\modules\adsplatform\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "analysis_effect".
 *
 * @property string $id
 * @property integer $ad_id
 * @property string $ad_name
 * @property string $total_failure
 * @property string $total_view
 * @property string $total_click
 * @property string $total_download
 * @property string $total_install
 * @property integer $create_time
 * @property integer $date_time
 */
class AnalysisEffect extends \app\components\HodoActiveRecord
{



    /**
     * 报表图返回的json数据
     */
    public function getJsonData(){

        $model = self::find()->orderBy('`date` desc')->limit(7)->asArray()->all();

        $failure = ArrayHelper::getColumn($model, 'total_failure');
        $view = ArrayHelper::getColumn($model, 'total_view');
        $click = ArrayHelper::getColumn($model, 'total_click');
        $download = ArrayHelper::getColumn($model, 'total_download');
        $install = ArrayHelper::getColumn($model, 'total_install');
        $failures = str_replace('', 0, implode(',',$failure));
        $view = str_replace('', 0, implode(',',$view));
        $click = str_replace('', 0, implode(',',$click));
        $download = str_replace('', 0, implode(',',$download));
        $install = str_replace('', 0, implode(',',$install));
         var_dump($view, $failures);
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'create_time' => 'desc',
                    'total_view' => 'desc',
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ad_id' => $this->ad_id,
            'total_click' => $this->total_click,
            'total_download' => $this->total_download,
            'total_failure' => $this->total_failure,
            'total_install' => $this->total_install,
            'total_view' => $this->total_view,
        ]);

        $query->andFilterWhere(['like', 'ad_name', $this->ad_name]);

        return $dataProvider;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'analysis_effect';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ad_id',], 'integer'],
            [['ad_name'], 'string', 'max' => 255],
            [['total_failure', 'total_view', 'total_click', 'total_download', 'total_install'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ad_id' => '广告名',
            'ad_name' => '名称',
            'total_failure' => '失败量',
            'total_view' => '展示量',
            'total_click' => '点击量',
            'total_download' => '下载量',
            'total_install' => '安装量',
            'create_time' => '日期',
            'date_time' => 'Date Time',
        ];
    }
}
