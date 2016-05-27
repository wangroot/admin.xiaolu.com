<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tmp_income".
 *
 * @property integer $show_total
 * @property integer $click_total
 * @property string $click_rate
 * @property string $eCPM
 * @property string $CPC
 * @property string $income
 * @property string $date_time
 * @property string $fill_rate
 * @property string $ad_type
 * @property string $channel
 * @property string $status
 */
class CoopIncome extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $path;
    public function upload()
    {
        if ($this->validate()) {
            $this->path = Yii::$app->runtimePath.'/logs/' . time() . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($this->path);
            return true;
        } else {
            return false;
        }
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coop_income';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['show_total', 'click_total','status', 'update_time', 'create_time'], 'integer'],
            [['eCPM', 'CPC', 'income'], 'number'],
            [['date_time', 'ad_type'], 'safe'],
            [['click_rate', 'fill_rate'], 'string', 'max' => 20],
            [['ad_type', 'channel'], 'string', 'max' => 255],
            [['date_time', 'channel'], 'validateUnique'],
        ];
    }
    public function validateUnique($attribute, $params)
    {
        if (!$this->hasErrors() && $this->isNewRecord) {
            $result = $this->find()
                ->where('date_time=:d and channel=:c ', [
                    ':d'=>$this->date_time,
                    ':c'=>$this->channel,
                ])->one();
            if(count($result) > 0){
                $this->addError($attribute, '已经存在相同日期与渠道');
            }
        }
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'show_total' => '展现量',
            'click_total' => '点击量',
            'click_rate' => '点击率',
            'eCPM' => '千次展示收益',
            'CPC' => 'CPC',
            'income' => '收入',
            'ad_type' => '广告类型',
            'date_time' => '时间',
            'imageFile' => '上传文件',
            'fill_rate' => '千次展示收益',
            'channel' => '渠道',
            'status' => '状态',
        ];
    }

    public function HintFieldAttributeLabels(){

    }
}
