<?php
namespace app\extensions\widget;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Created by PhpStorm.
 * User: i-sheng
 * Date: 15-11-10
 * Time: 上午11:35
 */
class HodoTabs extends Tabs
{

    protected function renderItems()
    {
        $headers = [];
        $panes = [];

        if (!$this->hasActiveTab() && !empty($this->items)) {
            $this->items[0]['active'] = true;
        }

        foreach ($this->items as $n => $item) {
            if (!ArrayHelper::remove($item, 'visible', true)) {
                continue;
            }
            if (!array_key_exists('label', $item)) {
                throw new InvalidConfigException("The 'label' option is required.");
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $headerOptions = array_merge($this->headerOptions, ArrayHelper::getValue($item, 'headerOptions', []));
            $linkOptions = array_merge($this->linkOptions, ArrayHelper::getValue($item, 'linkOptions', []));

            if (isset($item['items'])) {
                $label .= ' <b class="caret"></b>';
                Html::addCssClass($headerOptions, ['widget' => 'dropdown']);

                if ($this->renderDropdown($n, $item['items'], $panes)) {
                    Html::addCssClass($headerOptions, 'active');
                }

                Html::addCssClass($linkOptions, ['widget' => 'dropdown-toggle']);
                $linkOptions['data-toggle'] = 'dropdown';
                $header = Html::a($label, "#", $linkOptions) . "\n"
                    . Dropdown::widget(['items' => $item['items'], 'clientOptions' => false, 'view' => $this->getView()]);
            } else {
                $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
                $options['id'] = ArrayHelper::getValue($options, 'id', $this->options['id'] . '-tab' . $n);

                Html::addCssClass($options, ['widget' => 'tab-pane']);
                if (ArrayHelper::remove($item, 'active')) {
                    Html::addCssClass($options, 'active');
                    Html::addCssClass($headerOptions, 'active');
                }

                if (isset($item['url'])) {
                    $header = Html::a($label, Url::to($item['url']), $linkOptions);
                } else {
                    if($item['isNewRecord'] == 1){
                        Html::addCssClass($linkOptions, 'disabled');
                        Html::addCssClass($headerOptions, 'disabled');
                    }else{
                        $linkOptions['data-toggle'] = 'tab';
                        $linkOptions['data-url'] = Url::to($item['dataUrl']);
                        if ($this->renderTabContent) {
                            $panes[] = Html::tag('div', isset($item['content']) ? $item['content'] : '', $options);
                        }
                    }
                    $toolIpClass = $item['isNewRecord'] == 1 ? 'disabledhelp' : 'tableshelp';
                    $toolIp = Html::label($label, null, ['class' => $toolIpClass]);
                    $url = $item['isNewRecord']==1 ? 'javascript:void(1)' : '#' . $options['id'];
                    $header = Html::a($toolIp, $url, $linkOptions).Html::tag('div', $item['hint'], ['class' => 'hint-block']);
                }

            }

            $headers[] = Html::tag('li', $header, $headerOptions);
        }

        return Html::tag('ul', implode("\n", $headers), $this->options)
        . ($this->renderTabContent ? "\n" . Html::tag('div', implode("\n", $panes), ['class' => 'tab-content']) : '');
    }


}