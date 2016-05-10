<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Datadict;

/**
 * DatadictSearch represents the model behind the search form about `app\models\Datadict`.
 */
class DatadictSearch extends Datadict
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'status', 'display'], 'integer'],
            [['type', 'key', 'value', 'group', 'control', 'default', 'apps', 'component'], 'safe'],
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
        $query = Datadict::find();

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
            'sort' => $this->sort,
            'status' => $this->status,
            'display' => $this->display,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'group', $this->group])
            ->andFilterWhere(['like', 'control', $this->control])
            ->andFilterWhere(['like', 'default', $this->default])
            ->andFilterWhere(['like', 'apps', $this->apps])
            ->andFilterWhere(['like', 'component', $this->component]);

        return $dataProvider;
    }
}
