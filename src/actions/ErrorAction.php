<?php
namespace johnitvn\f2ngin\actions;

use Yii;
use yii\web\ErrorAction as Base;

class ErrorAction extends Base{
	public $view = "@f2ngin/views/errors/error";	

	public function beforeRun(){
		if(Yii::$app->user->isGuest){
			// Force render to view and layout for guest because in admin need load something 
			// wiht user id but in guest mode we have not it
			$this->controller->layout = '@f2ngin/views/errors/error-guest-layout';
			$this->view = '@f2ngin/views/errors/error-guest';
		}
		return true;
	}
}
