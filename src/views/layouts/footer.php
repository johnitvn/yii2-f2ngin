<?=Yii::$app->params['copyright']?>
<div class="pull-right">
	<?php $version = Yii::$app->params['version'];
		if($version!==false){
			echo '<b>Version</b> '.$version;
		}
	?>
</div>