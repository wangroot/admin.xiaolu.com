<?php

namespace app\modules\adsplatform\models;

use app\components\HodoActiveRecord;
use Yii;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "position".
 *
 * @property integer $id
 * @property string $name
 * @property integer $platform
 * @property integer $type
 * @property integer $total
 * @property integer $width
 * @property integer $height
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $status
 */
class Position extends HodoActiveRecord
{
    /**
     * 操作日志显示的名称
     */
    public $adminLog = '广告类型';
    /**
     * 操作日志默认的显示名称与url地址
     * @param int $isNewRecord 默认是插入(0) 是插入的记录还是更新的记录
     * @param array $data 一个model对应的字段名称数据
     */
    public static function getOperatingRecordLog($data, $isNewRecord=0)
    {
        switch($isNewRecord){
            case 0:
                return Html::a('新增广告类型:'.self::AttributeLabel('name').'='.$data['name'], ['position/index', 'PositionSearch[id]' => $data['id']]);
                break;
            case 1:
                $oldValue = parent::implodeArray(self::byKeyFindValue($data['oldValue']));
                $newValue = parent::implodeArray(self::byKeyFindValue($data['newValue']));
                return '更新广告类型:从'.$oldValue.'更改到'.$newValue;
                break;
            case 2:
                unset($data['width']);
                unset($data['height']);
                unset($data['total']);
                $oldValue = parent::implodeArray(self::byKeyFindValue($data));
                return '删除广告类型:'.$oldValue;
                break;
        }
        return '';
    }

    public static function byKeyFindValue($arr){
        if (isset($arr['update_time']) || isset($arr['create_time'])) {
            unset($arr['update_time']);
            unset($arr['create_time']);
        }
        foreach($arr as $key => $value){
            if (!in_array($key, ['platform','type','status'])){
                $arr[self::AttributeLabel($key)] = $value;
                unset($arr[$key]);
                continue;
            }
            $arr[self::AttributeLabel($key)] = Datadict::getDataValue(self::tableName().'_'.$key, $value);
            unset($arr[$key]);
        }
        return $arr;
    }

    /**
     * @param string $key
     * @return array
     */
    public static function AttributeLabel($key)
    {

        $a = [
            'id' => '主键',
            'name' => '广告类型名称',
            'platform' => '平台',
            'type' => '类型',
            'total' => '总数',
            'width' => '宽度',
            'height' => '高度',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'status' => '状态',
        ];
        return $a[$key];
    }


    /**
     *
     * @return array
     */
    public static function getList(){
        $db = Yii::$app->db;// or Category::getDb()
        $dep = new DbDependency();
        $dep->sql = 'SELECT count(*) FROM '.self::tableName();
        $result = $db->cache(function ($db) {
            return self::find()
                ->select(['id','name'])
                ->orderBy('id desc')
                ->asArray()
                ->all();
        }, 60, $dep);
        return ArrayHelper::map($result, 'id', 'name');
    }
    public function HintFieldAttributeLabels(){
        return [];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform', 'type',  'status'], 'integer'],
            [['platform','name', 'type',  'status'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {

        return [
            'id' => '主键',
            'name' => '广告类型名称',
            'platform' => '平台',
            'type' => '类型',
            'total' => '总数',
            'width' => '宽度',
            'height' => '高度',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'status' => '状态',
        ];
    }

//    public function behaviors()
//    {
//        return [
//            [
//                'class' => TimestampBehavior::className(),
//                'createdAtAttribute' => 'create_time',
//                'updatedAtAttribute' => 'update_time',
//            ],
//        ];
//    }



}
