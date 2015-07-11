<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace johnitvn\f2ngin\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class F2NginAsset extends AssetBundle
{

    public $sourcePath = '@f2ngin/web';
   

    public $css = [
        'css/AdminLTE',
        'css/site'
    ];

    public $js = [
        'js/app',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];

    public $skin = '_all-skins';

    /**
     * @inheritdoc
     */
    public function init()
    {        
        if ($this->skin) {
            if (('_all-skins' !== $this->skin) && (strpos($this->skin, 'skin-') !== 0)) {
                throw new Exception('Invalid skin specified');
            }
            $this->css[] = sprintf('css/skins/%s', $this->skin);
        }

        if(YII_ENV!=='dev'){
            foreach ($this->css as $key => $value) {
                $this->css[$key] = $value.'.min.css'; 
            }
            foreach ($this->js as $key => $value) {
                $this->js[$key] = $value.'.min.js'; 
            }
        }else{
            foreach ($this->css as $key => $value) {
                $this->css[$key] = $value.'.css'; 
            }
            foreach ($this->js as $key => $value) {
                $this->js[$key] = $value.'.js'; 
            }
        }

        parent::init();
    }
}
