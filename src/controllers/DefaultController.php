<?php
namespace johnitvn\f2ngin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use johnitvn\f2ngin\models\AdministratorConfigForm;
use johnitvn\userplus\traits\AjaxValidationTrait;
use johnitvn\f2ngin\assets\F2NginAsset;

/**
 * Site controller
 */
class DefaultController extends Controller
{

 	use AjaxValidationTrait;


    public function actionSaveAdministratorConfig(){    
    	
   		$model = new AdministratorConfigForm();

   		// Validate ajax
   		$this->performAjaxValidation($model);    
   		
    

   		// save
      $model->load(Yii::$app->request->post());
   		$model->save();

		  // go back
   		$this->goBack();

    }

    public function actionSetSkin($skin){
      $currentUserId = Yii::$app->user->getId();      
      $settings = Yii::$app->get('settings');   
      if($skin=='default'){
        $settings->delete('user-'.$currentUserId,'skin'); 
        $settings->clearCache();
      }else if(in_array('skin-'.$skin, F2NginAsset::getAvaibleSkins())){
        $settings->set('user-'.$currentUserId,'skin','skin-'.$skin); 
      }
      $this->goBack();
    }

   
}
