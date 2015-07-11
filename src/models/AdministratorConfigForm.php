<?php
namespace johnitvn\f2ngin\models;

use Yii;
use yii\base\Model;
use  johnitvn\f2ngin\assets\F2NginAsset;


class AdministratorConfigForm extends Model{


	public $default_skin;

    private $_settings;

    public function init(){
        $this->_settings = Yii::$app->get('settings');     
        $defaultSkin = $this->_settings->get('system','default-skins');        
        $this->default_skin = $defaultSkin;  
    }
	
	/** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'default_skin' => 'Default Skin',
        ];
    }

     /** @inheritdoc */
    public function formName()
    {
        return 'adminstrator-config-form';
    }

       /** @inheritdoc */
    public function rules()
    {
        return [
            'defaultSkinRequired' => [['default_skin'], 'required'],     
            'defaultSkinAvaiable' => [['default_skin'],'in','range'=>F2NginAsset::getAvaibleSkins()],     
        ];
    }

   

    public function save(){
    	if(!$this->_settings->set('system','default-skins',$this->default_skin,'string')){
            return false;
        }


        return true;
    }

}
