<?php

namespace app\modules\adsplatform\models;

use app\components\HodoActiveRecord;
use Yii;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;
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
        }, 3600, $dep);
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
            'name' => '代码类型名称',
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