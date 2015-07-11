<?php
/* @var $this \yii\web\View */
/* @var $summary array */
/* @var $tag string */
/* @var $manifest array */
/* @var $panels \yii\debug\Panel[] */
/* @var $activePanel \yii\debug\Panel */

use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\ButtonGroup;
use yii\helpers\Url;
use yii\helpers\Html;

yii\debug\DebugAsset::register($this);




$this->params['breadcrumbs'][] = ['label' => 'Yii Debugger', 'url' => ['/debug']];


?>
<div class="default-view">
    <div class="box box-primary">
        <div id="yii-debug-toolbar" class="box-body yii-debug-toolbar-top">  
            <?php foreach ($panels as $panel): ?>
            <?= $panel->getSummary() ?>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="box box-primary">  
        <div class="box-header">
            <ul class="nav nav-tabs">
                <?php
                    foreach ($panels as $id => $panel) {
                        $label = Html::encode($panel->getName());
                        echo '<li class="'.($panel === $activePanel ? 'active' : '').'">'.Html::a($label, ['view', 'tag' => $tag, 'panel' => $id]).'</li>';
                    }
                ?>  
            </ul>        
        </div>      
        <div class="box-body">   
            <?php
                $statusCode = $summary['statusCode'];
                if ($statusCode === null) {
                    $statusCode = 200;
                }
                if ($statusCode >= 200 && $statusCode < 300) {
                    $calloutClass = 'callout-success';
                } elseif ($statusCode >= 300 && $statusCode < 400) {
                    $calloutClass = 'callout-info';
                } else {
                    $calloutClass = 'callout-danger';
                }
                ?>
                <div class="callout <?= $calloutClass ?> debug-call-out">
                    <?php
                        $count = 0;
                        $items = [];
                        foreach ($manifest as $meta) {
                            $label = ($meta['tag'] == $tag ? Html::tag('strong', '&#9654;&nbsp;'.$meta['tag']) : $meta['tag'])
                                . ': ' . $meta['method'] . ' ' . $meta['url'] . ($meta['ajax'] ? ' (AJAX)' : '')
                                . ', ' . date('Y-m-d h:i:s a', $meta['time'])
                                . ', ' . $meta['ip'];
                            $url = ['view', 'tag' => $meta['tag'], 'panel' => $activePanel->id];
                            $items[] = [
                                'label' => $label,
                                'url' => $url,
                            ];
                            if (++$count >= 10) {
                                break;
                            }
                        }

                        echo ButtonGroup::widget([
                            'options'=>['class'=>'btn-group-sm'],
                            'buttons' => [
                                Html::a('All', ['index'], ['class' => 'btn btn-default']),
                                Html::a('Latest', ['view', 'panel' => $activePanel->id], ['class' => 'btn btn-default']),
                                ButtonDropdown::widget([
                                    'label' => 'Last 10',
                                    'options' => ['class' => 'btn-default btn-sm'],
                                    'dropdown' => ['items' => $items, 'encodeLabels' => false],
                                ]),
                            ],
                        ]);
                        echo '<BR><BR>';
                        $url = Html::a(Html::encode($summary['url']));
                        $url = str_replace("http://","", $url);
                        $url = str_replace("https://","", $url);
                        $url = substr($url,strpos($url,"/"));
                        if(strlen($url)>60){
                            $url = substr($url,0,60).'...';
                        }
                        echo $summary['method'].' '.$url.'<BR>';
                        echo 'Tag: '.$summary['tag'].' - ';                       
                        echo 'at '.date('Y-m-d h:i:s a', $summary['time']).' - '; 
                        echo 'with ip '. $summary['ip'].' '; 

                       ?>
                </div>
                <?= $activePanel->getDetail() ?>
        </div>
    </div>
</div>
