<?php

namespace app\modules\adsplatform\models;

use app\components\HodoActiveRecord;
use Yii;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "ad".
 *
 * @property integer $id
 * @property integer $provider
 * @property integer $position_id
 * @property integer $type
 * @property integer $target
 * @property string $title
 * @property string $subtitle
 * @property string $detail
 * @property string $image
 * @property string $image_vertical
 * @property string $link
 * @property string $channel
 * @property string $package_name
 * @property integer $version_code
 * @property string $app_id
 * @property string $ad_id
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $show_time
 * @property integer $collect_data
 * @property integer $ceiling_view
 * @property integer $ceiling_day_view
 * @property integer $ceiling_day_click
 * @property integer $ceiling_total_view
 * @property integer $ceiling_total_click
 * @property integer $total_view
 * @property integer $total_click
 * @property integer $total_download
 * @property integer $total_install
 * @property integer $total_failure
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $status
 */
class Ad extends HodoActiveRecord
{
    /**
     * 操作日志显示的名称
     */
    public $adminLog = '自主广告';
    /**
     * 操作日志默认的显示名称与url地址
     * @param int $isNewRecord 默认是插入(0) 是插入的记录还是更新的记录
     * @param array $data 一个model对应的字段名称数据
     */
    public static function getOperatingRecordLog($data, $isNewRecord=0)
    {
        switch($isNewRecord){
            case 0:
                return Html::a('新增自主广告:'.self::AttributeLabel('title').'='.$data['title'], ['ad/index', 'AdSearch[id]' => $data['id']]);
                break;
            case 1:
                $oldValue = parent::implodeArray(self::byKeyFindValue($data['oldValue']));
                $newValue = parent::implodeArray(self::byKeyFindValue($data['newValue']));
                return '更新自主广告:从'.$oldValue.'更改到'.$newValue;
                break;
            case 2:
                $oldValue = parent::implodeArray(self::byKeyFindValue($data));
                return '删除自主广告:'.$oldValue;
                break;
        }
        return '';
    }

    public static function byKeyFindValue($arr=[]){
        foreach($arr as $key => $value){
            if (!in_array($key, ['position_id','type','collect_data','status','target'])){
                $arr[self::AttributeLabel($key)] = $value;
                unset($arr[$key]);
                continue;
            }
            switch($key){
                case 'position_id':
                    $arr[self::AttributeLabel($key)] = Position::findOne($value)->name;
                    break;
                case 'type' :
                case 'target' :
                case 'collect_data' :
                case 'status' :
                    $arr[self::AttributeLabel($key)] = Datadict::getDataValue(self::tableName().'_'.$key, $value);
                    break;
            }
            unset($arr[$key]);
        }
        return $arr;
    }
    /**
     * @inheritdoc
     */
    public static function AttributeLabel($key)
    {
        $a = [
            'id' => '主键',
            'position_id' => '广告位',
            'type' => '展示类型',
            'target' => '目标',
            'title' => '标题',
            'collect_data' => '收集信息',
            'status' => '状态',
        ];
        return $a[$key];
    }

    /**
     *广告的数据列表
     */
    public static function getAdList($providerId=null, $positionId=null){
        $db = Yii::$app->db;// or Category::getDb()
        $dep = new DbDependency();
        $dep->sql = 'SELECT count(*) FROM '.self::tableName();
        $result = $db->cache(function ($db) use ($providerId, $positionId) {
            if(!empty($providerId) || $providerId !== null){
                $where = 'provider='.(int)$providerId.' and ';
            }
            if(!empty($positionId)){
                $where .= 'position_id='.(int)$positionId.' and ';
            }
            $where .= 'status=1';
            return self::find()
                ->select(['id','title','provider','position_id'])
                ->where($where)
                ->orderBy('id desc')
                ->asArray()
                ->all();
        }, 60, $dep);
        foreach ($result as $key=>$item) {
            if ($item['provider'] == 0) {
                $provider = '自主';
            }else{
                $provider = Provider::findOne($item['provider'])->name;
            }
            $position = Position::findOne($item['position_id'])->name;
            $str = $item['title'].'-'.$provider.'-'.$position;
            $result[$key]['title'] = $str;
        }
        return ArrayHelper::map($result, 'id', 'title');
    }

    const START_TIME = 'start_time';
    const END_TIME = 'end_time';

    public function save($runValidation = true, $attributeNames = null)
    {
            if($this->hasAttribute(self::START_TIME))
                $this->setAttribute(self::START_TIME, strtotime($this->start_time));
            if($this->hasAttribute(self::END_TIME))
                $this->setAttribute(self::END_TIME, strtotime($this->end_time));
      return  parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
    }


    public function getAttributeHint($attribute){
        $a = [
            'id' => '主键',
            'provider' => '广告厂商',
            'position_id' => '广告位',
            'type' => '展示类型',
            'target' => '目标',
            'title' => '标题',
            'subtitle' => '副标题',
            'detail' => '详情',
            'image' => '图片地址',
            'image_vertical' => '竖屏图片地址',
            'link' => '广告链接',
            'channel' => '渠道',
            'package_name' => '包名',
            'version_code' => '版本号',
            'app_id' => '第三方APPID',
            'ad_id' => '第三方广告ID',
            'start_time' => '点击开始时间后需要按时分秒请手动更改下',
            'end_time' => '点击结束时间后需要按时分秒请手动更改下',
            'show_time' => '广告展示时间',
            'collect_data' => '收集信息',
            'ceiling_view' => '单用户展示次数上限',
            'ceiling_day_view' => '单天展示数限制',
            'ceiling_day_click' => '单天点击数限制',
            'ceiling_total_view' => '总展示数限制',
            'ceiling_total_click' => '总点击数限制',
            'total_view' => '总展现数',
            'total_click' => '总点击数',
            'total_download' => '总下载数',
            'total_install' => '总安装数',
            'total_failure' => '总失败数',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'status' => '状态',
        ];
        return [];
    }
    public function HintFieldAttributeLabels(){
        return [];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'position_id', 'type', 'target', 'version_code',  'collect_data', 'ceiling_view', 'ceiling_day_view', 'ceiling_day_click', 'ceiling_total_view', 'ceiling_total_click', 'total_view', 'total_click', 'total_download', 'total_install', 'total_failure',  'status'], 'integer'],
            [['position_id', 'type', 'target', 'version_code', 'start_time', 'end_time', 'show_time', 'collect_data', 'ceiling_view',  'status', 'ceiling_day_click'], 'required'],
            [['detail', 'image', 'image_vertical', 'link'], 'string'],
            [['image', 'image_vertical', 'link'], 'url'],
            [['title', 'subtitle', 'package_name', 'app_id', 'ad_id'], 'string', 'max' => 100],
            [['channel'], 'string', 'max' => 20],
            [['ceiling_total_click','ceiling_total_view','ceiling_day_click','ceiling_day_view'], 'integer', 'min' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'provider' => '广告厂商',
            'position_id' => '广告类型',
            'type' => '展示样式',
            'target' => '触发方式',
            'title' => '广告名称',
            'subtitle' => '通知栏广告标题',
            'detail' => '详情',
            'image' => '图片地址',
            'image_vertical' => '竖屏图片地址',
            'link' => '广告链接',
            'channel' => '渠道',
            'package_name' => '包名',
            'version_code' => '版本号',
            'app_id' => '第三方APPID',
            'ad_id' => '第三方广告ID',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'show_time' => '广告展示时间',
            'collect_data' => '收集信息',
            'ceiling_view' => '单用户展示次数上限',
            'ceiling_day_view' => '单天展示数限制',
            'ceiling_day_click' => '单天点击数限制',
            'ceiling_total_view' => '总展示数限制',
            'ceiling_total_click' => '总点击数限制',
            'total_view' => '总展现数',
            'total_click' => '总点击数',
            'total_download' => '总下载数',
            'total_install' => '总安装数',
            'total_failure' => '总失败数',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'status' => '状态',
        ];
    }
}
