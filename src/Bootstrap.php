<?php
namespace johnitvn\f2ngin;

use Yii;
use yii\base\Theme;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\i18n\PhpMessageSource;
use yii\base\BootstrapInterface;

/**
* @author John Martin <john.itvn@gmail.com>
* @since 1.0
*/
class Bootstrap implements BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app){  
        /**
        * Check when this application contain f2ngin module config
        */
        if($app->hasModule('f2ngin')){

            $module = $app->getModule('f2ngin');

            // Set alias for @f2ngin for easy use path 
            Yii::setAlias("@f2ngin","@vendor/johnitvn/yii2-f2ngin/src");

            // Config internationalisation
            if (!isset(Yii::$app->get('i18n')->translations['user*'])) {
                Yii::$app->get('i18n')->translations['user*'] = [
                    'class'    => PhpMessageSource::className(),
                    'basePath' => __DIR__ . '/messages',
                ];
            }

            // config for web application
            if ($app instanceof \yii\web\Application) {
                $this->bootstrapWebApp($app,$module);
            }
        }


        // config for console application
        if ($app instanceof \yii\console\Application) {
            $this->bootstrapConsoleApp($app);
        }

    }


    /**
    * Bootstrap for web application
    */
    private function bootstrapWebApp($app,$module){

        /* Config default layout */
        $app->layout = "@f2ngin/views/layouts/main";    
        /* Config for default error action*/    
        $app->errorHandler->errorAction = 'f2ngin/common/error';

        /**
        * Register user modules and gridview modules
        * (GridView module user for yii2-ajaxcrud)
        */
        $defaultUserPlusConfig = [
            'class' => 'johnitvn\userplus\Module',
            'controllerNamespace'=>'johnitvn\userplus\controllers',
            'enableSecurityHandler'=>false,
        ];
        
        $app->setModules([
            'gridview'=>'kartik\grid\Module',
            'user' => ArrayHelper::merge($module->userplus,$defaultUserPlusConfig),
        ]);
        //force config module user
        $app->getModule('user');


        // Register settings compoment and modules
        $app->set('settings',['class'=>'johnitvn\settings\components\Settings']);
        if($module->enableGuiSettingManager){
            $app->setModules([
                'settings'=>'johnitvn\settings\Module',
            ]);
        }


        /**
        * Register user compoment 
        */
        $defaultUserConfig = [
            'identityClass' => 'johnitvn\userplus\models\User',
            'enableAutoLogin' => true,
            'loginUrl'=>["/f2ngin/common/login"],
        ];
        Yii::$container->set('yii\web\User',ArrayHelper::merge($module->user,$defaultUserConfig));
        

        /**
        * Set yii2-debug module layouts and views
        * Both of two modules just add for development stage. So its can access
        * even user not loged in. But when user not loged in and we render it with 
        * backend layout. So it will be throw some error. So when user not loged in, 
        * Let it do what them was made the default
        */
        if(!$app->get('user')->isGuest){            
            if($app->hasModule('debug')){
                $debug = $app->getModule('debug');
                $debug->layoutPath =  '@f2ngin/views/layouts';
                $debug->viewPath = '@f2ngin/views/debug';
            }

            /**
            * Set yii2-gii module layouts and views
            */
            if($app->hasModule('gii')){
                $gii = $app->getModule('gii');
                $gii->layoutPath = '@f2ngin/views/layouts';
                $gii->viewPath = '@f2ngin/views/gii';
            }
        }


       
    }

    /**
    * Bootstrap for console application
    */
    private function bootstrapConsoleApp($app){
        // Config user module for use command user/manager/*
        $app->setModules([           
            'user' => [
                'class' => 'johnitvn\userplus\Module',
                'controllerNamespace'=>'johnitvn\userplus\commands',               
            ],
        ]);
    }
}
