<?php
/**
 * User: hongxiaobo
 * description:
 * Date: 2016/5/12
 * Time: 18:19
 */

namespace app\modules\adsplatform\models;
use yii\data\ActiveDataProvider;


class ChannelSearch extends Channel
{
    public function rules()
    {
        return [
//          [['type', 'key', 'value', 'sort'], 'required'],
     
            [['value'], 'unique'],
            [['value'], 'match','pattern' => '/^\w+$/', 'message'=>'{attribute} 只能包含数字字母下划线'],
            //[['type', 'key'], 'string', 'max' => 32],
            [['value'], 'string', 'max' => 128],
            [['status'],'integer'],
        ];
    }

    public function HintFieldAttributeLabels() {
        return [];
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
        $query = self::find()->select('id,value,status,create_time')->where('type="strategy_list_channels" and status=1')->orderBy('create_time desc');
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
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
            'status' => $this->status,
        ]);
        $query->andFilterWhere(['like', 'value', $this->value]);
        return $dataProvider;
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => '渠道名称',
            'status' => '状态',
            'create_time'=> '创建时间',
        ];
    }
}