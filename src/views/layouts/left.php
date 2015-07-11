<?php
use backend\widgets\Nav;

?>
<aside class="main-sidebar">
    <section class="sidebar">   
        <?=Nav::widget(require Yii::$app->getModule('f2ngin')->getNavMenuConfig())?>
    </section>
</aside>
