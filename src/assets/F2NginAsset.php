<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace johnitvn\f2ngin\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class F2NginAsset extends AssetBundle
{

    public $sourcePath = '@f2ngin/web';
    
    public $publishOptions = [
        'forceCopy' => true,
    ];

    public $css = [
        'css/AdminLTE',
        'css/DevModules',
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
        if(Yii::$app->user->isGuest){

        }else{
            $currentUserId = Yii::$app->user->getId();         

            $settings = Yii::$app->get('settings'); 
            $this->skin = $settings->get('user-'.$currentUserId,'skin'); 


            if($this->skin==null){
                $this->skin = $settings->get('system','default-skins');
                $this->skin = $this->skin==null?'skin-blue':$this->skin;     
            }


            if ($this->skin) {
                if (!in_array($this->skin, F2NginAsset::getAvaibleSkins())) {
                    //throw new \yii\base\Exception('Invalid skin specified: '.$this->skin);
                    $this->skin='skin-blue';
                }
                $this->css[] = sprintf('css/skins/%s', $this->skin);
            }
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

    public static function getAvaibleSkins(){
        return [
            "skin-blue",
            "skin-black",
            "skin-red",
            "skin-yellow",
            "skin-purple",
            "skin-green",
            "skin-blue-light",
            "skin-black-light",
            "skin-red-light",
            "skin-yellow-light",
            "skin-purple-light",
            "skin-green-light"
        ];
    }

     public static function getAvaibleSkinLabels(){
        return [
            "skin-blue"         => "Blue",
            "skin-black"        => "Black",
            "skin-red"          => "Red",
            "skin-yellow"       => "Yellow",
            "skin-purple"       => "Purple",
            "skin-green"        => "Green",
            "skin-blue-light"   => "Blue Light",
            "skin-black-light"  => "Black Light",
            "skin-red-light"    => "Red Light",
            "skin-yellow-light" => "Yellow Light",
            "skin-purple-light" => "Purple Light",
            "skin-green-light"  => "Green Light",
        ];
    }
}
