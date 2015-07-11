<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $generators \yii\gii\Generator[] */
/* @var $content string */

$generators = Yii::$app->controller->module->generators;
$this->title = "Welcome to Gii<small>a magical tool that can write code for you</small>";
$this->params['breadcrumbs'][] = "Gii";
?>
<div class="default-index">
        <?php foreach ($generators as $id => $generator): ?>
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($generator->getName()) ?></h3>
            </div>
            <div class="box-body">
              <?= $generator->getDescription() ?>
            </div>
            <div class="box-footer clearfix">
              <?= Html::a('Start »', ['default/view', 'id' => $id], ['class' => 'btn btn-default']) ?>
            </div>
        </div>       
        <?php endforeach; ?>
        <a class="btn btn-success" href="http://www.yiiframework.com/extensions/?tag=gii">Get More Generators</a>
</div>
