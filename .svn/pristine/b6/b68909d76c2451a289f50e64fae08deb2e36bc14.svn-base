<?php

namespace app\modules\adsplatform\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\adsplatform\models\Effect;

/**
 * EffectSearch represents the model behind the search form about `app\modules\adsplatform\models\Effect`.
 */
class EffectSearch extends Effect
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ad_id', 'result', 'result_time', 'create_time'], 'integer'],
            [['device_id', 'device_model', 'device_mac'], 'safe'],
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
        $query = Effect::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'result' => $this->result,
            'result_time' => $this->result_time,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'device_id', $this->device_id])
            ->andFilterWhere(['like', 'device_model', $this->device_model])
            ->andFilterWhere(['like', 'device_mac', $this->device_mac]);

        return $dataProvider;
    }
}
