<?php

namespace app\extensions\widget;
/**
 * Created by PhpStorm.
 * User: i-sheng
 * Date: 15-11-24
 * Time: 上午11:47
 * @link http://www.daterangepicker.com/ document
 * @var $config
 *
 * following example shows how to use Daterangepicker
 * HodoDaterangepicker::widget([
 *  'options' => 参数
 * ]);
 */

use app\assets\DaterangepickerAsset;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;

class HodoDaterangepicker extends InputWidget
{

    /**
     * @var array
     *
     */
    public $inputOptions = ['class' => 'form-control'];
    public $initConfig = [ 'locale'=>[ 'format' => 'YYYY-MM-DD' ], 'singleDatePicker' => true,
        'showDropdowns' => true ];
    public $options = [];
    public $language;
    public $config = [];
    public $is_show_applyLabel = true;
    public $is_show_cancelLabel = true;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if(!isset($this->options['id'])){
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Executes the widget.
     * @return string the result of widget execution to be outputted.
     */
    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub
        echo $this->Html();
        $this->registerClientScript();
    }

    public function registerClientScript(){
        $id = $this->options['id'];

        $config= Json::encode(array_merge($this->config, $this->initConfig));

        $js = "
            $('#{$id}-start').daterangepicker({$config});
            $('#{$id}-start').val('');
            $('#{$id}-end').daterangepicker({$config});
            $('#{$id}-end').val('');
        ";
        $view = $this->getView();
        DaterangepickerAsset::register($view);
        $view->registerJs($js);
    }

    protected function Html()
    {
        $id = $this->options['id'];

        $html = Html::activeTextInput($this->model, $this->attribute.'[start]', ['id' => $id.'-start', "class" => "form-control"]).
               Html::label('至', null, ["class" => "input-group-addon"]).
               Html::activeTextInput($this->model, $this->attribute.'[end]', ['id' => $id.'-end', "class" => "form-control"]);

        return Html::tag('div',Html::tag('div', $html, ['class' => 'input-group']), ["class"=>"form-group"] ); ;

    }
}