<?php

namespace app\modules\adsplatform\models;

use Yii;
use app\components\HodoActiveRecord;

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
            'id' => '主键',
            'name' => '名称',
            'position_id' => '广告类型',
            'weight' => '权重',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'status' => '状态',
        ];
    }
}