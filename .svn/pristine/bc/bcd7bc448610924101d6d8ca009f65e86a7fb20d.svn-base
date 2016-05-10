<?php

namespace app\modules\adsplatform\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\adsplatform\models\Ad;

/**
 * AdSearch represents the model behind the search form about `app\modules\adsplatform\models\Ad`.
 */
class AdSearch extends Ad
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
            [['id', 'provider', 'position_id', 'type', 'target', 'version_code', 'start_time', 'end_time', 'show_time', 'collect_data', 'ceiling_view', 'ceiling_day_view', 'ceiling_day_click', 'ceiling_total_view', 'ceiling_total_click', 'total_view', 'total_click', 'total_download', 'total_install', 'total_failure', 'create_time', 'update_time', 'status'], 'integer'],
            [['title', 'subtitle', 'detail', 'image', 'image_vertical', 'link', 'channel', 'package_name', 'app_id', 'ad_id'], 'safe'],
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
        $query = Ad::find();

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
            'provider' => $this->provider,
            'position_id' => $this->position_id,
            'type' => $this->type,
            'target' => $this->target,
            'version_code' => $this->version_code,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'show_time' => $this->show_time,
            'collect_data' => $this->collect_data,
            'ceiling_view' => $this->ceiling_view,
            'ceiling_day_view' => $this->ceiling_day_view,
            'ceiling_day_click' => $this->ceiling_day_click,
            'ceiling_total_view' => $this->ceiling_total_view,
            'ceiling_total_click' => $this->ceiling_total_click,
            'total_view' => $this->total_view,
            'total_click' => $this->total_click,
            'total_download' => $this->total_download,
            'total_install' => $this->total_install,
            'total_failure' => $this->total_failure,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'subtitle', $this->subtitle])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'image_vertical', $this->image_vertical])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'channel', $this->channel])
            ->andFilterWhere(['like', 'package_name', $this->package_name])
            ->andFilterWhere(['like', 'app_id', $this->app_id])
            ->andFilterWhere(['like', 'ad_id', $this->ad_id]);

        return $dataProvider;
    }
}
