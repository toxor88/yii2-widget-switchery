<?php

/**
 * @copyright Copyright &copy; Steven Cash, 2015
 * @package yii2-widgets
 * @subpackage yii2-widget-switchery
 * @version 1.0.0
 */

namespace toxor88\switchery;

/**
 * Asset bundle for Switchery widget
 *
 * @author Steven Cash <toxor88@gmail.com>
 * @since 1.0
 */
class SwitcheryAsset extends \yii\web\AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = '@bower/switchery/dist';
        $this->js = [YII_DEBUG ? 'switchery.js' : 'switchery.min.js'];
        $this->css = [YII_DEBUG ? 'switchery.css' : 'switchery.min.css'];
        
        parent::init();
        
        $this->publishOptions['beforeCopy'] = function ($from, $to) {
            $dirname = basename(dirname($from));
            return $dirname === 'dist';
        };
    }
}
