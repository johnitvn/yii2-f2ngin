<?php
use johnitvn\f2ngin\Module;
/* @var $panel yii\debug\panels\ConfigPanel */
?>
<div class="yii-debug-toolbar-block">
    <a href="<?= $panel->getUrl() ?>">
    	F2Ngin
    	<span class="label"><?= Module::VERSION ?></span>
    	Yii
        <span class="label"><?= $panel->data['application']['yii'] ?></span>
        PHP
        <span class="label"><?= $panel->data['php']['version'] ?></span>
    </a>
</div>
