<?php

namespace app\modules\adsplatform\models;

use Yii;

use app\components\HodoActiveRecord;
/**
 * This is the model class for table "strategy_ad_list".
 *
 * @property integer $id
 * @property integer $strategy_id
 * @property integer $ad_id
 * @property integer $weight
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $status
 */
class StrategyAdList extends HodoActiveRecord
{

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function find()
    {
        return parent::find()->where(['<>', 'status', 3]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'strategy_ad_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['strategy_id', 'ad_id', 'weight', 'status'], 'integer'],
            [['ad_id', 'weight', 'status'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'strategy_id' => '流量策略',
            'ad_id' => '名称',
            'weight' => '权重',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'status' => '状态',
        ];
    }
}
