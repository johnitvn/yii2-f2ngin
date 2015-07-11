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

    public function actions(){
        return [
            'error'=>'johnitvn\f2ngin\actions\ErrorAction',
        ];
    }
   
}
