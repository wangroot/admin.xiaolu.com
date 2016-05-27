<?php
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/5/6
 * Time: 上午10:49
 */

namespace app\extensions\behaviors;

use app\extensions\behaviors\ActiveRecordHistoryInterface;
use Yii;


abstract class BaseManager implements ActiveRecordHistoryInterface
{

    /**
     * @var array list of updated fields
     */
    public $updatedFields;

    /**
     * @var array list if insert fields
     */
    public $insertFields;

    /**
     * @var boolean Flag for save current user_id in history
     */
    public $saveUserId = true;

    public $groupTable = ['strategy', 'strategy_ad_list', 'strategy_list'];

    /**
     * @inheritdoc
     */
    public function setOptions($options)
    {
        if (is_array($options)) {
            foreach ($options as $optionKey => $optionValue)
                $this->{$optionKey} = $optionValue;
        }
        return $this;
    }

    /**
     * @inheritdoc 设置插入与更新值
     */
    public function setUpdatedAndInsertFields($attributes, $insertAttributes)
    {
        $this->updatedFields = $attributes;
        $this->insertFields = $insertAttributes;
        return $this;
    }

    /**
     * @inheritdoc
     * @var $type
     * @var $object \yii\db\ActiveRecord
     */
    public function run($type, $object)
    {
        $pk = $object->primaryKey();
        $pk = $pk[0];

        $data = [
            'table' => $object->tableName(),
            'action' => $_GET['r'],
            'model_name' =>  get_class($object),
            'field_id' => $object->getPrimaryKey(),
            'type' => $type,
            'user_id' => Yii::$app->user->identity->getId(),
            'user_name' => Yii::$app->user->identity->username,
            'ip' => Yii::$app->request->getUserIP(),
            'create_time' =>  time(),
            'remark' =>  property_exists($object, 'adminLog')? $object->adminLog:'',
            'group' =>  isset($object->strategy_id)?$object->strategy_id:0,
        ];
        $detail = '';
        switch ($type) {
            case self::AR_INSERT:
                $data['detail'] = json_encode($this->insertFields);
                $this->saveField($data);
                break;
            case self::AR_UPDATE:
                $arr = [];
                foreach ($this->updatedFields as $updatedFieldKey => $updatedFieldValue) {
                    $arr['oldValue'][$updatedFieldKey] = $updatedFieldValue;
                    $arr['newValue'][$updatedFieldKey] = $object->$updatedFieldKey;

                }
                $data['detail'] = json_encode($arr);
                $this->saveField($data);
                break;
            case self::AR_DELETE:
                $data['detail'] = json_encode($this->insertFields);
                $this->saveField($data);
                break;
            case self::AR_UPDATE_PK:
                $data['field_name'] = $pk;
                $data['old_value'] = $object->getOldPrimaryKey();
                $data['new_value'] = $object->{$pk};
                $this->saveField($data);
                break;
        }
    }

}
