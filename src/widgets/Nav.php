<?php
namespace johnitvn\f2ngin\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class Nav extends Widget
{

    public $options;

    public $items;
   
    public function run(){   
        if($this->items==null||!is_array($this->items)){
            return '';
        }     
        $itemContent = '';
        foreach ($this->items as $item) {
        	if(!is_array($item)){
        		$itemContent .= $item;
        	}else{                
            	$itemContent .= NavItem::widget($item);   
            }
        }
        return Html::tag('ul',$itemContent, $this->options);            
    }    

}