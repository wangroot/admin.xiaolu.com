<?php

namespace app\modules\adsplatform\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\adsplatform\models\Datadict;

/**
 * This is the model class for table "operating_record_log".
 *
 * @property integer $id
 * @property string $table
 * @property string $action
 * @property string $model_name
 * @property string $field_id
 * @property string $remark
 * @property string $detail
 * @property integer $type
 * @property integer $user_id
 * @property string $user_name
 * @property string $ip
 * @property integer $create_time
 * @property integer $group
 */
class OperatingRecordLog extends \app\components\HodoActiveRecord
{
    /**
     * @var array 
     */
    private static $typeValue = [0 => '新增',1 => '更新',2 => '删除'];

    /**
     * 通过映射查找出对应的中文名
     * @param $key
     * @return string 
     */
    public static function getTypeValue($key){
        return self::$typeValue[$key];
    }

    /**
     * @param $model $this
     */
    public static function handleFieldNameToRealName($model)
    {
        switch($model->type){
            case 0:
               return self::handleSaveRecord($model);
                break;
            case 1:
                return self::handleUpdateRecord($model);
                break;
            case 2:
                return self::handleDeleteRecord($model);
                break;
        }
        return $model->type;
        
    }
    /**
     * 处理保存记录
     * @param $model $this
     */
    public static function handleSaveRecord($model)
    {
        $namespace = $model->model_name;
        if(!class_exists($namespace))
            return '末到结果';

        $object = new $namespace;
        /**
         * @var $object yii\db\ActiveRecord
         */
        $data = json_decode($model->detail, true);
        $namespace::getOperatingRecordLog();
    }
    /**
     * 处理更新记录
     */
    public static function handleUpdateRecord($model)
    {
        $namespace = $model->model_name;
        if(!class_exists($namespace))
            return '末到结果';

        $object = new $namespace;
        /**
         * @var $object yii\db\ActiveRecord
         */
        $data = json_decode($model->detail, true);
        $res = [];
        foreach($data as $field=>$value){
            if( $field =='update_time' || $field == 'create_time' ){
                $res[$object->getAttributeLabel($field)] = date('Y-m-d H:i', $value);
            }elseif($field == 'status'){
                $res[$object->getAttributeLabel($field)] = Datadict::getDataValue('strategy_list_status', $value);
            }else{
                $res[$object->getAttributeLabel($field)] = $value;
            }
        }
        return self::implodeArray($res);
    }
    /**
     * 删除记录处理
     */
    public static function handleDeleteRecord($model)
    {
        $namespace = $model->model_name;
        if(!class_exists($namespace))
            return '末到结果';

        $object = new $namespace;
        /**
         * @var $object yii\db\ActiveRecord
         */
        $data = json_decode($model->detail, true);
        if (isset($data['name'])) {
            $str =  Datadict::getDataValue('operating_record_log_model_name', $namespace);
            $str = $str.'新增'.$object->getAttributeLabel('name').'='.$data['name'];
            return $str;
            $html =<<<EOD

EOD;

        }

    }
    /**
     * 通过映射模形名与字段找到具体的中文名
     */
    public static function mappingRealValue($namespace, $field, $value)
    {
        switch($namespace.$field){
            case '':
                break;
            case '':
        }

    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operating_record_log';
    }

    /**
     * @param $res
     * @return string
     */
    protected static function implodeArray($res)
    {
        return implode(', ', array_map(function ($v, $k) {
            return sprintf("%s=%s", $k, $v);
        }, $res, array_keys($res)));
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'type' => $this->type,
            'create_time' => $this->create_time,
        ]);

        return $dataProvider;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['remark', 'detail'], 'string'],
            [['type', 'user_id', 'group'], 'integer'],
            [['table', 'action', 'model_name', 'field_id'], 'string', 'max' => 50],
            [['user_name'], 'string', 'max' => 60],
            [['ip'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table' => 'Table',
            'action' => 'Action',
            'model_name' => 'Model Name',
            'field_id' => 'Field ID',
            'remark' => 'Remark',
            'detail' => '操作详情',
            'type' => '操作类型',
            'user_id' => '账号',
            'user_name' => 'User Name',
            'ip' => 'Ip',
            'create_time' => '时间',
            'group' => 'Group',
        ];
    }
}
