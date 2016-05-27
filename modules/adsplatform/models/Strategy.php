<?php

namespace app\modules\adsplatform\models;

use Yii;
use app\components\HodoActiveRecord;
use yii\helpers\Html;
/**
 * This is the model class for table "strategy".
 *
 * @property integer $id
 * @property integer $position_id
 * @property integer $weight
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $status
 * @property string  $name
 */
class Strategy extends HodoActiveRecord
{
    /**
     * 操作日志显示的名称
     */
    public $adminLog = '流量策略';
    /**
     * 操作日志默认的显示名称与url地址
     * @param int $isNewRecord 默认是插入(0) 是插入的记录还是更新的记录
     * @param array $data 一个model对应的字段名称数据
     */
    public static function getOperatingRecordLog($data, $isNewRecord=0)
    {
        switch($isNewRecord){
            case 0:
                return Html::a('新增流量策略:'.self::AttributeLabel('name').'='.$data['name'], ['strategy/index', 'StrategySearch[id]' => $data['id']]);
                break;
            case 1:
                $oldValue = parent::implodeArray(self::byKeyFindValue($data['oldValue']));
                $newValue = parent::implodeArray(self::byKeyFindValue($data['newValue']));
                return '更新流量策略:从'.$oldValue.'更改到'.$newValue;
                break;
            case 2:
                unset($data['width']);
                unset($data['height']);
                unset($data['total']);
                $oldValue = parent::implodeArray(self::byKeyFindValue($data));
                return '删除流量策略:'.$oldValue;
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

    public function TabsToolip(){
        return [
            'strategy' => '',
            'rule' => '',
            'ad' => ''
        ];
    }

    /**
     *
     * @var $view \yii\web\View
     * @return array
     */
    public function TabsPanels($view, $viewFile){

        $params = [];
        if(!$this->isNewRecord && $this->hasAttribute('id')){
            $params['id'] = $this->getAttribute('id');
        }

        switch($viewFile){
            case 'strategy':
                return $view->render('/common/strategy', ['id' => $this->id]);
            case 'rule':
                return $view->render('/common/rule', ['id' => $this->id]);
            case 'ad':
                return $this->isNewRecord ? '' :$view->render('/common/ad', ['id' => $this->id]);

        }
        return '[empty]';
    }

    public function getStrategyList(){
        return $this->hasOne(StrategyList::className(), ['strategy_id'=>'id']);
    }

    public function getStrategyAdList(){
        return $this->hasOne(StrategyAdList::className(), ['strategy_id'=>'id']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'strategy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_id', 'weight', 'create_time', 'update_time', 'status'], 'integer'],
            [['position_id', 'weight', 'status', 'name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'position_id' => '广告类型',
            'weight' => '权重',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'status' => '状态',
        ];
    }
}
