<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_user_channel".
 *
 * @property integer $id
 * @property string $channel
 * @property integer $admin_user_id
 * @property integer $group
 * @property integer $status
 * @property integer $create_time
 */
class AdminUserChannel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_user_channel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_user_id', 'group', 'status', 'create_time'], 'integer'],
            [['channel'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'channel' => 'Channel',
            'admin_user_id' => 'Admin User ID',
            'group' => 'Group',
            'status' => 'Status',
            'create_time' => 'Create Time',
        ];
    }
}
