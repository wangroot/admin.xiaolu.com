<?php

namespace app\modules\adsplatform\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\adsplatform\models\StrategyList;

/**
 * StrategyListSearch represents the model behind the search form about `app\modules\adsplatform\models\StrategyList`.
 */
class StrategyListSearch extends StrategyList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'strategy_id', 'type', 'rule', 'create_time', 'update_time', 'status'], 'integer'],
            [['rule_content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = StrategyList::find();

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
            'strategy_id' => $this->strategy_id,
            'type' => $this->type,
            'rule' => $this->rule,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'rule_content', $this->rule_content]);

        return $dataProvider;
    }
}
