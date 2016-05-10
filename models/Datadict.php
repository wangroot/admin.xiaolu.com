<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "datadict".
 *
 * @property integer $id
 * @property string $type
 * @property string $key
 * @property string $value
 * @property integer $sort
 * @property integer $status
 * @property string $group
 * @property string $control
 * @property string $default
 * @property string $apps
 * @property string $component
 * @property integer $display
 */
class Datadict extends \app\components\HodoActiveRecord
{
    public function behaviors()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'datadict';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort', 'status', 'display'], 'integer'],
            [['type', 'key'], 'string', 'max' => 32],
            [['value'], 'string', 'max' => 128],
            [['group', 'control', 'apps'], 'string', 'max' => 50],
            [['default', 'component'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'key' => 'Key',
            'value' => 'Value',
            'sort' => 'Sort',
            'status' => 'Status',
            'group' => 'Group',
            'control' => 'Control',
            'default' => 'Default',
            'apps' => 'Apps',
            'component' => 'Component',
            'display' => 'Display',
        ];
    }
}
