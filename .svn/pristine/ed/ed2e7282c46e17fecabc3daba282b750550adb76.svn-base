<?php

namespace app\modules\adsplatform\models;

use Yii;

/**
 * This is the model class for table "effect".
 *
 * @property integer $id
 * @property integer $ad_id
 * @property integer $result
 * @property integer $result_time
 * @property string $device_id
 * @property string $device_model
 * @property string $device_mac
 * @property integer $create_time
 */
class Effect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'effect';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ad_id', 'result', 'result_time', 'create_time'], 'integer'],
            [['device_id', 'device_model'], 'string', 'max' => 100],
            [['device_mac'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'ad_id' => '广告ID',
            'result' => '最终效果',
            'result_time' => '产生效果的时间',
            'device_id' => '设备唯一码',
            'device_model' => '设备型号',
            'device_mac' => '设备MAC地址',
            'create_time' => '创建时间',
        ];
    }
}
