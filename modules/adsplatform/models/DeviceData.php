<?php

namespace app\modules\adsplatform\models;

use Yii;

/**
 * This is the model class for table "device_data".
 *
 * @property integer $id
 * @property integer $ad_id
 * @property string $uuid
 * @property string $mac
 * @property string $channel
 * @property string $package_name
 * @property string $brand
 * @property string $model
 * @property string $longitude
 * @property string $latitude
 * @property integer $create_time
 * @property integer $status
 */
class DeviceData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ad_id', 'create_time', 'status'], 'integer'],
            [['package_name'], 'string'],
            [['uuid'], 'string', 'max' => 128],
            [['mac', 'channel', 'brand', 'model', 'longitude', 'latitude'], 'string', 'max' => 50],
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
            'uuid' => '设备唯一码',
            'mac' => 'mac地址',
            'channel' => '渠道',
            'package_name' => '包名',
            'brand' => '手机品牌',
            'model' => '手机型号',
            'longitude' => '经度',
            'latitude' => '纬度',
            'create_time' => '创建时间',
            'status' => '状态',
        ];
    }
}
