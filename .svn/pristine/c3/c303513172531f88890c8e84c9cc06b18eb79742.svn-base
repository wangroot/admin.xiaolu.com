<?php

namespace app\modules\adsplatform\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\adsplatform\models\Position;

/**
 * PositionSearch represents the model behind the search form about `app\modules\adsplatform\models\Position`.
 */
class PositionSearch extends Position
{

    public function getAttributeHint($attribute){
        return $this->attributeLabels()[$attribute];
    }

    public function HintFieldAttributeLabels(){
        return [];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'platform', 'type', 'total', 'width', 'height',  'status'], 'integer'],
            [['name'], 'safe'],
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
        $query = self::find();

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
            'platform' => $this->platform,
            'type' => $this->type,
            'total' => $this->total,
            'width' => $this->width,
            'height' => $this->height,
            'status' => $this->status,
            'create_time' => $this->create_time,
        ]);


        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
