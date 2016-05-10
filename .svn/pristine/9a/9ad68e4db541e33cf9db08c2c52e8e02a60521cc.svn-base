<?php
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/4/21
 * Time: 下午8:47
 */

namespace app\extensions\widget;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\InvalidConfigException;

class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
    public $ico;

    protected function renderItem($link, $template)
    {
        $encodeLabel = ArrayHelper::remove($link, 'encode', $this->encodeLabels);
        if (array_key_exists('label', $link)) {
            $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
        } else {
            throw new InvalidConfigException('The "label" element is required for each link.');
        }
        if (array_key_exists('iconClass', $link)) {
            $label = '<i class="'.$link['iconClass'].'"></i>' . $label;
        }
        if (isset($link['template'])) {
            $template = $link['template'];
        }
        if (isset($link['url'])) {
            $options = $link;
            unset($options['template'], $options['label'], $options['url']);
            $link = Html::a($label, $link['url'], $options);
        } else {
            $link = $label;
        }
        return strtr($template, ['{link}' => $link]);    }


}