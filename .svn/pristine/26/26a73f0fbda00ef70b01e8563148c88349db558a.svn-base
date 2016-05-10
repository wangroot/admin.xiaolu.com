<?php

namespace app\modules\adsplatform\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\adsplatform\models\DeviceData;

/**
 * DeviceDataSearch represents the model behind the search form about `app\modules\adsplatform\models\DeviceData`.
 */
class DeviceDataSearch extends DeviceData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ad_id', 'create_time', 'status'], 'integer'],
            [['uuid', 'mac', 'channel', 'package_name', 'brand', 'model', 'longitude', 'latitude'], 'safe'],
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
        $query = DeviceData::find();

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
            'create_time' => $this->create_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'mac', $this->mac])
            ->andFilterWhere(['like', 'channel', $this->channel])
            ->andFilterWhere(['like', 'package_name', $this->package_name])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'latitude', $this->latitude]);

        return $dataProvider;
    }
}
