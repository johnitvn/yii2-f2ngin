<?php
namespace johnitvn\f2ngin;

use Yii;
use yii\base\Theme;
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
        Yii::setAlias("@f2ngin","@vendor/johnitvn/yii2-f2ngin/src");

        if (!isset(Yii::$app->get('i18n')->translations['user*'])) {
            Yii::$app->get('i18n')->translations['user*'] = [
                'class'    => PhpMessageSource::className(),
                'basePath' => __DIR__ . '/messages',
            ];
        }

        if ($app instanceof \yii\web\Application) {
            $this->bootstrapWebApp($app);
        }else{
            $this->bootstrapConsoleApp($app);
        }    
    }

    private function bootstrapWebApp($app){

        /* Config default layout */
        $app->layout = "@f2ngin/views/layouts/main";        
        $app->errorHandler->errorAction = 'f2ngin/common/error';

        $app->set('settings',[
            'class'=>'johnitvn\settings\components\Settings'
        ]);
        $app->setModules([
            'gridview'=>'kartik\grid\Module',
            'user' => [
                'class' => 'johnitvn\userplus\Module',
                'enableSecurityHandler'=>false,
                'enableRegister'=>true,
                'rememberFor'=>3600*24,// 1 day
            ],
        ]);

        if($app->hasModule('debug')){
            $debug = $app->getModule('debug');
            $debug->layoutPath =  '@f2ngin/views/layouts';
            $debug->viewPath = '@f2ngin/views/debug';
        }

        if($app->hasModule('gii')){
            $gii = $app->getModule('gii');
            $gii->layoutPath = '@f2ngin/views/layouts';
            $gii->viewPath = '@f2ngin/views/gii';
        }


    }

    private function bootstrapConsoleApp($app){

    }
}
