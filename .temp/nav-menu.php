<?php 
/* @var $this \yii\web\View */

return[
    'options' => ['class' => 'sidebar-menu'],
    'items' => [
        /* Administrator Menu */
        [
            'content'=>'<li class="header">Administrator Menu</li>',  
            'visible'=> Yii::$app->user->identity->isSuperuser(),
        ],
        [
            'label'=>'Usser manager',
            'url'=>['/user/manager'],
            'icon'=>'fa-user',
            'visible'=>Yii::$app->user->identity->isSuperuser(),
        ], 

        /* Global Menu */

            /*
            * Register global menu here 
            */


        /* Development Menu */
        [
            'content'=>'<li class="header">Development Menu</li>',  
            'visible'=> YII_ENV=='dev',
        ],
        [
            'label'=>'Gii',
            'url'=>['/gii'],
            'icon'=>'fa-code',
            'visible'=>YII_ENV=='dev',
        ],    
        [
            'label'=>'Debug',
            'icon'=>'fa-bug',
            'url'=>['/debug'],
            'visible'=>YII_ENV=='dev',
        ],       
    ],
];