<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $generators \yii\gii\Generator[] */
/* @var $activeGenerator \yii\gii\Generator */
/* @var $content string */
yii\gii\GiiAsset::register($this);
$generators = Yii::$app->controller->module->generators;
$activeGenerator = Yii::$app->controller->generator;
?>
<?php $this->beginContent('@f2ngin/views/layouts/main.php'); ?>
	<?= $content ?>  	
<?php $this->endContent(); ?>
