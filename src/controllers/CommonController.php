<?php
namespace johnitvn\f2ngin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class CommonController extends Controller
{

    public function beforeAction($action){
        if(!parent::beforeAction($action))
            return false;

        if($action->id=='login'||$action->id=='register'){
            $this->layout = "@f2ngin/views/layouts/main-".$action->id;
        }

        return true;
    }

    public function actions(){
        return [
            'error'=>'johnitvn\f2ngin\actions\ErrorAction',
            'logout' => [
                'class' => 'johnitvn\userplus\actions\LogoutAction',                                
            ],
            'login' => [
                'class' => 'johnitvn\userplus\actions\LoginAction',
            ],
            'register' => [
                'class' => 'johnitvn\userplus\actions\RegisterAction',
            ]         
        ];
    }
   
}
