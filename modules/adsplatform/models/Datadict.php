<?php

namespace app\modules\adsplatform\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\caching\DbDependency;
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
 * @property string $games
 * @property string $component
 * @property integer $display
 * @property integer $create_time
 */
class Datadict extends \yii\db\ActiveRecord
{

    /**
     * 状态默认是1是开启,0为关闭
     * @var int
     */
    static protected  $status = 1;
    /**
     * 通过类型与键来得到一个值
     * @param $type
     * @param $key
     * return string
     */
    public static function getDataValue ($type, $key){
        $db = Yii::$app->db;
        $dep = new DbDependency();
        $dep->sql = 'SELECT count(*) FROM '.self::tableName();
        $result = $db->cache(function($db) use($type, $key){
           return self::find()
               ->select('value')
                ->where('type=:t and `key`=:k and status=:s', [':t' => $type, ':k' => $key, ':s'=> self::$status])
               ->orderBy('sort')
                ->one();
        }, 1500, $dep);
        return $result['value'];
    }

    public static function getDataList($type, $unset= true){
        $db = Yii::$app->db;// or Category::getDb()
        $dep = new DbDependency();
        $dep->sql = 'SELECT count(*) FROM '.self::tableName();
        $result = $db->cache(function ($db) use ($type) {
            return self::find()
                ->select('`key`, `value`')
                ->where('type=:t and status=:s', [':t' => $type, ':s'=> self::$status])
                ->orderBy('sort')
                ->asArray()
                ->all();
        }, 1500, $dep);
        $arr =  ArrayHelper::map($result, 'key', 'value');
        if (!$unset) {
            unset($arr[0]);
        }
        return $arr;
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
            [['type', 'key', 'value', 'sort'], 'required'],
            [['sort', 'status', 'display'], 'integer'],
            [['type', 'key'], 'string', 'max' => 32],
            [['value'], 'string', 'max' => 128],
            [['group', 'control', 'games'], 'string', 'max' => 50],
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
            'key' => '标记',
            'value' => '键值',
            'sort' => 'Sort',
            'status' => '记录的状态...1可用 0不可用',
            'group' => 'Group',
            'control' => 'Control',
            'default' => 'Default',
            'games' => '对应游戏配置 （若有配置，则for游戏，为空，则全部适配）',
            'component' => '组件标识',
            'display' => '是否显示出来',
        ];
    }
}
