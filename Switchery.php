<?php

/**
 * @copyright Copyright &copy; Steven Cash, 2015
 * @package yii2-widgets
 * @subpackage yii2-widget-switchery
 * @version 1.0.0
 */

namespace toxor88\switchery;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\helpers\Inflector;
use yii\helpers\ArrayHelper;
use yii\widgets\InputWidget;

/**
 * Switchery widget is a Yii2 wrapper for the Switchery.js plugin. Switchery
 * is a simple component that helps you turn your default HTML checkbox inputs
 * into beautiful iOS 7 style switches in just few simple steps. You can easily
 * customize switches, so that they match your design perfectly.
 * 
 * Supported by all modern browsers: Chrome, Firefox, Opera, Safari, IE8+
 *
 * @author Steven Cash <toxor88@gmail.com>
 * @since 1.0
 * @see http://abpetkov.github.io/switchery/
 */
class Switchery extends InputWidget
{
    const SIZE_LARGE = 'large';
    const SIZE_DEFAULT = 'default';
    const SIZE_SMALL = 'small';
    
    /**
     * @var array switchery client options.
     * 
     * Defaults:
     * - color             : '#64bd63'
     * - secondaryColor    : '#dfdfdf'
     * - jackColor         : '#fff'
     * - jackSecondaryColor: null
     * - className         : 'switchery'
     * - disabled          : false
     * - disabledOpacity   : 0.5
     * - speed             : '0.1s'
     * - size              : 'default'
     */
    public $clientOptions = [];
    /**
     * @var string change event for switchery
     */
    public $clientChangeEvent = [];
    /**
     * @var array the HTML attributes for the input tag.
     */
    public $options = [];
    /**
     * @var string DOM selector
     */
    public $querySelector;
    
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        SwitcheryAsset::register($this->getView());
        
        $this->registerPlugin();
    }
    
    /**
     * Runs the widget
     *
     * @return string
     */
    public function run()
    {
        $this->registerAssets();
        
        if ($this->hasModel()) {
            echo Html::activeCheckbox($this->model, $this->attribute, $this->options);
        } else {
            $checked = ArrayHelper::remove($this->options, 'checked', false);
            echo Html::checkbox($this->name, $checked, $this->options);
        }
    }

    /**
     * Registers switchery plugin
     */
    protected function registerPlugin()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->hasModel() ? Html::getInputId($this->model, $this->attribute) : $this->getId();
        } else {
            $this->setId($this->options['id']);
        }
        
        $clientOptions = [];
        $this->clientOptions = ArrayHelper::merge($clientOptions, $this->clientOptions);
        
        if ($this->hasModel()) {
            $this->querySelector = '#' . $this->options['id'];
        } elseif (empty($this->querySelector)) {
            $this->querySelector = ArrayHelper::remove($this->clientOptions, 'querySelector', '#' . $this->options['id']);
        }
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $id = Inflector::variablize($this->getId());
        $view = $this->getView();
        
        SwitcheryAsset::register($view);
        
        $selector = $id . 'Element';
        $options = [$selector];
        
        if (!empty($this->clientOptions)) {
            $options[] = Json::encode($this->clientOptions);
        }

        $js = new JsExpression(implode(', ', $options));
        $script = <<<EOT
var {$selector} = document.querySelector('{$this->querySelector}');
var {$id} = new Switchery({$js});
EOT;

        if (!empty($this->clientChangeEvent)) {
            $script .= "{$selector}.addEventListener('change', {$this->clientChangeEvent});" . PHP_EOL;
        }

        $view->registerJs($script);
    }
}
