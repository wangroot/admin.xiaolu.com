<?php
/**
 * User: hongxiaobo
 * description:
 * Date: 2016/5/11
 * Time: 15:49
 */

namespace app\modules\adsplatform\models;
use yii\data\ActiveDataProvider;

class Channel extends Datadict
{
    public function rules()
    {
        return [
//          [['type', 'key', 'value', 'sort'], 'required'],
            [['value'], 'required'],
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