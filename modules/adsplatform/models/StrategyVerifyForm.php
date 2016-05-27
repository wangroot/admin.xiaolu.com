<?php
/**
 * User: hongxiaobo
 * description:
 * Date: 2016/5/24
 * Time: 12:23
 */

namespace app\modules\adsplatform\models;
use yii\base\Model;

class StrategyVerifyForm extends Model
{
    public $position_id;
    public $channel;
    public $package_name;
    public $brand;
    public $version;

    public function HintFieldAttributeLabels()
    {

    }
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
            return [
                'position_id'   => '广告位ID',
                'channel'       => '广告渠道',
                'package_name'  => '游戏包名',
                'brand'         => '品牌',
                'version'       => '版本号',
            ];
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['position_id', 'channel', 'package_name', 'brand','version'],'safe'],
            // email has to be a valid email address
//            ['email', 'email'],
            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
        ];
    }
    public function get_verify_stratrgy()
    {
        $connection = \Yii::$app->db;
        $command = $connection->createCommand('select sl.strategy_id, sl.type, sl.rule, sl.rule_content  
              from strategy_list sl left join strategy s on s.id = sl.strategy_id 
              where s.position_id =:id and s.status = 1 and sl.status = 1 
              order by s.weight desc, s.id  limit 200');
        $command->bindValue(':id', $this->position_id);
        $arr = $command->queryAll();
        
        $arr = $this->check($arr);
        if(empty($arr)) {
           return $arr;
        }
        $where = " `id` in ( " . implode(',', $arr) . " )";
        $sql = "select s.id, s.name, s.position_id, s.weight, s.delay_time, s.create_time, s.update_time, s.status from strategy s where ".$where;
        $command = $connection->createCommand($sql);
        return $command->queryAll();

    }
    public function check($strategy_data)
    {
        $arr = [];
        $strategy_id = 0;
        $return_strategy_id = false;
        foreach($strategy_data as $key => $val){

            if($strategy_id == 0){
                $strategy_id = $val['strategy_id'];
            }else if($strategy_id != $val['strategy_id']){
                if($return_strategy_id == true){
                    $arr[] = $strategy_id;
                }
                $strategy_id = $val['strategy_id'];
            }else if($strategy_id == $val['strategy_id'] && !$return_strategy_id){
                continue;
            }
            switch($val['type']){
                case 1:
                    // 包名
                    $val['rule_content'] = strtolower($val['rule_content']);
                    $rule_content = explode(',', $val['rule_content']);
                    if($val['rule'] == 0 && in_array($this->package_name, $rule_content)){
                        $return_strategy_id = true;
                    }else if($val['rule'] == 1 && !in_array($this->package_name, $rule_content)){
                        $return_strategy_id = true;
                    }else{
                        $return_strategy_id = false;
                    }
                    break;
                case 2:
                    // 版本
                    if(in_array($val['rule'], array(0, 1))){
                        $rule_content = explode(',', $val['rule_content']);
                    }
                    if($val['rule'] == 0 && in_array($this->version, $rule_content)){
                        $return_strategy_id = true;
                    }else if($val['rule'] == 1 && !in_array($this->version, $rule_content)){
                        $return_strategy_id = true;
                    }else if($val['rule'] == 2 && $val['rule_content'] <= $this->version){
                        $return_strategy_id = true;
                    }else if($val['rule'] == 3 && $val['rule_content'] >= $this->version){
                        $return_strategy_id = true;
                    }else{
                        $return_strategy_id = false;
                    }
                    break;
                case 3:
                    // 手机品牌
                    $val['rule_content'] = strtolower($val['rule_content']);
                    $rule_content = explode(',', $val['rule_content']);
                    if($val['rule'] == 0 && in_array($this->brand, $rule_content)){
                        $return_strategy_id = true;
                    }else if($val['rule'] == 1 && !in_array($this->brand, $rule_content)){
                        $return_strategy_id = true;
                    }else{
                        $return_strategy_id = false;
                    }
                    break;
                default:
                    // 渠道
                    $val['rule_content'] = strtolower($val['rule_content']);
                    $rule_content = explode(',', $val['rule_content']);
                    if($val['rule'] == 0 && in_array($this->channel, $rule_content)){
                        $return_strategy_id = true;
                    }else if($val['rule'] == 1 && !in_array($this->channel, $rule_content)){
                        $return_strategy_id = true;
                    }else{
                        $return_strategy_id = false;
                    }
                    break;
            }

        }
        //当数据只有一个或剩下最后一个，不进去循环就没法保存数据
        if($strategy_id != 0 && $return_strategy_id == true) {
            $arr[] = $strategy_id;
        }
        return $arr;
    }
}