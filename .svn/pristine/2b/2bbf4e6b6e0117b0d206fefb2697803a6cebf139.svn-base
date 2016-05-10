<?php

namespace app\modules\adsplatform\models;

use Yii;
use app\components\HodoActiveRecord;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "provider".
 *
 * @property string $id
 * @property string $name
 * @property string $remark
 * @property string $create_time
 * @property string $update_time
 * @property integer $status
 */
class Provider extends HodoActiveRecord
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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['remark'], 'string'],
            [['create_time', 'update_time', 'status'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'name' => '广告商名称',
            'remark' => '备注',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'status' => '状态',
        ];
    }
}
