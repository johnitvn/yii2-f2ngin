<?php
use backend\widgets\Nav;

?>
<aside class="main-sidebar">
    <section class="sidebar">   
        <?=Nav::widget(require Yii::getAlias('@backend/config/nav-menu').'.php')?>
    </section>
</aside>
