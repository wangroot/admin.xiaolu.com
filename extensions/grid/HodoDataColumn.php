<?php
/**
 * Created by PhpStorm.
 * User: i-sheng
 * Date: 15-12-3
 * Time: 下午4:02
 */

namespace app\extensions\grid;

use yii\helpers\ArrayHelper;
use yii\grid\DataColumn;

class HodoDataColumn extends DataColumn
{
    /***
     * @var $avgAndSum 求平均或者求和 默认是求和
     */
    public $isAvgAndSum = false;
    public $avgCount = 0;
    public $footerValue = 0;


    public function getDataCellValue($model, $key, $index)
    {
        if ($this->value !== null) {
            if (is_string($this->value)) {
                $value = ArrayHelper::getValue($model, $this->value);
                $this->avgAndSum($value);
                return $value;
            } else {
                $value = call_user_func($this->value, $model, $key, $index, $this);
                $this->avgAndSum($value);
                return $value;
            }
        } elseif ($this->attribute !== null) {
            $value = ArrayHelper::getValue($model, $this->attribute);
            $this->avgAndSum($value);
            return $value;
        }
        return null ;
    }

    /**
     * @param $value
     */
    protected function avgAndSum($value)
    {
        if ($this->isAvgAndSum && is_numeric($value)) {
            $this->footerValue += $value;
            $this->avgCount++;
        } else{
            $this->footerValue = '';
        }
    }

    /**
     * Renders the footer cell content.
     * The default implementation simply renders [[footer]].
     * This method may be overridden to customize the rendering of the footer cell.
     * @return string the rendering result
     */
    protected function renderFooterCellContent()
    {
        if($this->isAvgAndSum && is_numeric($this->footerValue)){
            $this->footer = round($this->footerValue/$this->avgCount, 2);
        }elseif(is_numeric($this->footerValue)){
            $this->footer = $this->footerValue;
        }
        return trim($this->footer) !== '' ? $this->footer : $this->grid->emptyCell;
    }


}