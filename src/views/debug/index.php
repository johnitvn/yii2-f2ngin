<?php
/* @var $this \yii\web\View */
/* @var $manifest array */
/* @var $searchModel \yii\debug\models\search\Debug */
/* @var $dataProvider ArrayDataProvider */
/* @var $panels \yii\debug\Panel[] */

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;


yii\debug\DebugAsset::register($this);


$this->title = 'Yii Debugger';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="default-index">

    <div id="yii-debug-toolbar" class="yii-debug-toolbar-top">       
        <?php foreach ($panels as $panel): ?>
            <?= $panel->getSummary() ?>
        <?php endforeach; ?>
    </div>

<?php

if (isset($this->context->module->panels['db']) && isset($this->context->module->panels['request'])) {

    $codes = [];
    foreach ($manifest as $tag => $vals) {
        if (!empty($vals['statusCode'])) {
            $codes[] = $vals['statusCode'];
        }
    }
    $codes = array_unique($codes, SORT_NUMERIC);
    $statusCodes = !empty($codes) ? array_combine($codes, $codes) : null;

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,  
        'pjax'=>true,
        'export' => false,
        'toolbar'=>['content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])                    
                ],
        'panel' => [
            'type' => 'primary', 
            'heading' => 'Available Debug Data',
            'after'=>false,
        ],      
        'rowOptions' => function ($model, $key, $index, $grid) use ($searchModel) {
            $dbPanel = $this->context->module->panels['db'];

            if ($searchModel->isCodeCritical($model['statusCode']) || $dbPanel->isQueryCountCritical($model['sqlCount'])) {
                return ['class'=>'danger'];
            } else {
                return [];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'tag',
                'value' => function ($data) {
                    return Html::a($data['tag'], ['view', 'tag' => $data['tag']]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'time',
                'value' => function ($data) {
                    return '<span class="nowrap">' . Yii::$app->formatter->asDatetime($data['time'], 'yyyy-MM-dd HH:mm:ss') . '</span>';
                },
                'format' => 'html',
            ],
            //'ip',
            [
                'attribute' => 'sqlCount',
                'label' => 'Query',
                'width'=> '50px',
                'value' => function ($data) {
                    $dbPanel = $this->context->module->panels['db'];

                    if ($dbPanel->isQueryCountCritical($data['sqlCount'])) {

                        $content = Html::tag('b', $data['sqlCount']) . ' ' . Html::tag('span', '', ['class' => 'glyphicon glyphicon-exclamation-sign']);

                        return Html::a($content, ['view', 'panel' => 'db', 'tag' => $data['tag']], [
                            'title' => 'Too many queries. Allowed count is ' . $dbPanel->criticalQueryThreshold,
                        ]);

                    } else {
                        return $data['sqlCount'];
                    }
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'mailCount',
                'label'=>'Mails',
                'width'=> '50px',
                'visible' => isset($this->context->module->panels['mail']),
            ],
            [
                'attribute' => 'method',
                'filter' => ['get' => 'GET', 'post' => 'POST', 'delete' => 'DELETE', 'put' => 'PUT', 'head' => 'HEAD'],
                'width'=> '50px',
            ],
            [
                'attribute'=>'ajax',
                'value' => function ($data) {
                    return $data['ajax'] ? 'Yes' : 'No';
                },
                'filter' => ['No', 'Yes'],
            ],
            [
                'attribute' => 'url',
                'label' => 'URL',
                'value'=>function($data){
                    $url = str_replace("http://","", $data['url']);
                    $url = str_replace("https://","", $url);
                    $url = substr($url,strpos($url,"/"));
                    return $url;
                }
            ],
            [
                'attribute' => 'statusCode',
                'value' => function ($data) {
                    $statusCode = $data['statusCode'];
                    if ($statusCode === null) {
                        $statusCode = 200;
                    }
                    if ($statusCode >= 200 && $statusCode < 300) {
                        $class = 'label-success';
                    } elseif ($statusCode >= 300 && $statusCode < 400) {
                        $class = 'label-info';
                    } else {
                        $class = 'label-danger';
                    }
                    return "<span class=\"label {$class}\">$statusCode</span>";
                },
                'format' => 'raw',
                'filter' => $statusCodes,
                'label' => 'Status'
            ],
        ],
    ]);

} else {
    echo "<div class='alert alert-warning'>No data available. Panel <code>db</code> or <code>request</code> not found.</div>";
}

?>
    
</div>
