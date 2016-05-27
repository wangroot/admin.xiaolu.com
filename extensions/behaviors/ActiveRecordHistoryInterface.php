<?php

namespace app\extensions\behaviors;
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/5/4
 * Time: 下午7:55
 */
interface ActiveRecordHistoryInterface
{
    /**
     * 定义CRUD事件对象
     */
    const AR_INSERT = 0;
    const AR_UPDATE = 1;
    const AR_DELETE = 2;
    const AR_UPDATE_PK = 3;

    /**
     * @param $type integer 保存事件对象
     * @param $object \yii\db\ActiveRecord
     */
    public function run($type, $object);

    /**
     * Method for save one changes of the AR model
     * @param array $data
     */
    public function saveField($data);

    /**
     * Set options for manager
     * @param array $options
     * @return $this
     */
    public function setOptions($options);

    /**
     * Set $this->updatedFields
     * Set $this->insertAttributes
     * @param array $attributes
     * @param array $insertAttributes
     * @return $this
     */
    public function setUpdatedAndInsertFields($attributes, $insertAttributes);


}