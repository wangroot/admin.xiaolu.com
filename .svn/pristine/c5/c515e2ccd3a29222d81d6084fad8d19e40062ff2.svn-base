<?php

namespace app\modules\adsplatform\models;

use Yii;
use app\components\HodoActiveRecord;
/**
 * This is the model class for table "strategy_list".
 *
 * @property integer $id
 * @property integer $strategy_id
 * @property integer $type
 * @property integer $rule
 * @property string $rule_content
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $status
 */
class StrategyList extends HodoActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'strategy_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['strategy_id', 'type', 'rule',  'status'], 'integer'],
            [['strategy_id', 'type', 'rule'], 'required'],
            [['strategy_id', 'type', 'rule'], 'validateUnique'],
            [['rule_content'], 'string'],

        ];
    }

    public function validateUnique($attribute, $params)
    {
        if (!$this->hasErrors() && !$this->isNewRecord) {
               $result = $this->find()
                    ->where('strategy_id=:s and type=:t and rule=:r', [
                        ':s'=>$this->strategy_id,
                        ':t'=>$this->type,
                        ':r'=>$this->rule
                    ])
                    ->one();
            if(count($result) > 0){
                $this->addError($attribute, '不能重复添加');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'strategy_id' => '流量策略',
            'type' => '匹配类型',
            'rule' => '规则',
            'rule_content' => '规则内容',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'status' => '状态',
        ];
    }
}
