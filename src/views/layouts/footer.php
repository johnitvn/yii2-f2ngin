<?=Yii::$app->getModule('f2ngin')->getParam('copyright')?>
<div class="pull-right">
	<?php $version = Yii::$app->getModule('f2ngin')->getParam('version');
		if($version!==false){
			echo '<b>Version</b> '.$version;
		}
	?>
</div>