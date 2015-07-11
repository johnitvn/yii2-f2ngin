<?php 
namespace johnitvn\f2ngin;

use Yii;
use yii\base\Module as BaseModule; 

class Module extends BaseModule
{

	public $controllerNamespace = 'johnitvn\f2ngin\controllers';

	/**
	* @var string $config the path of f2ngin config directory
	*/
	public $config;
	
	/**
	* assetBundles = [
	* 		'backend\assets\AppAssets',
	*       'backend\assets\WebAssets',
	* ];
	* or
	* assetBundles = 'backend\assets\AppAssets';
	*/
	public $assetBundles; 

	private $_navMenu;
	private $_params;

	public function init(){		
		if($this->config!==null){
			$this->_navMenu = Yii::getAlias($this->config).'/nav-menu.php';
			$this->_params = require Yii::getAlias($this->config).'/params.php';
		}		
	}

	public function registerAppAssets($view){
		if($this->assetBundles!==null){
			if(is_array($this->assetBundles)){
				foreach ($this->assetBundles as $bundle) {
					call_user_func($bundle.'::register',$view);
				}
			}else{
				call_user_func($this->assetBundles.'::register',$view);
			}
		}
	}

	public function getNavMenuConfig(){
		return $this->_navMenu;
	}

	public function getParams(){
		return $this->_params;
	}

	public function getParam($key){
		return $this->_params[$key];
	}
}