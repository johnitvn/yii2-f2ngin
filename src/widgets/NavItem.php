<?php
namespace johnitvn\f2ngin\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class NavItem extends Widget
{

    public $content;

    public $label;

    public $icon;

    public $url;

    public $visible = true;

    public $items;


    public function run(){
        // stop here if not visible config
        if(!$this->visible){
            return '';
        }

        if($this->content!==null){
            return $this->content;
        }

 
        $hasItems = $this->items!=null && is_array($this->items) && count($this->items)>0; 


        if(!$hasItems){            
            $html = '<li>';
            $html .= $this->renderMainItemContent();
            $html .= '</li>';
        }else{
            $html = '<li class="treeview">';
            $html .= $this->renderMainItemContent(true);
            $html .= $this->renderSubMenuContent();
            $html .= '</li>';
        }       
        return $html;        
    }   

    public function renderMainItemContent($hasItems=false){
        $content = '<i class="fa '.($this->icon!==null?$this->icon:'fa-navicon').'"></i>';
        $content .= '<span>'.$this->label.'</span>';

        $content .= $hasItems?'<i class="fa fa-angle-left pull-right"></i>':'';
        return Html::a($content,$this->url!==null?$this->url:"#");
    }

    public function renderSubMenuContent(){
        $html = '<ul class="treeview-menu">';
        foreach ($this->items as $item) {
           $html .= NavItem::widget($item);
        }
        $html .= '</ul>';
        return $html;
    }

}