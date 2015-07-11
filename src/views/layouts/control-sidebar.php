<?php
use johnitvn\f2ngin\widgets\ControlSidebarTabs;
use johnitvn\f2ngin\models\AdministratorConfigForm;

$adminConfigView = '@f2ngin/views/control-sidebar/administrator-config.php';
$userSettingView = '@f2ngin/views/control-sidebar/user-settings.php';

echo ControlSidebarTabs::widget([   
    'items' => [        
        [
            'label' => '<i class="fa fa-wrench"></i>',
            'linkOptions'=>['title'=>'User Settings'],
            'content'=>$this->render($userSettingView),
            'active' => true,
        ],
        [
            'label' => '<i class="fa fa-gear"></i>',
            'linkOptions'=>['title'=>'Adiminstrator Config'],
            'content' => $this->render($adminConfigView,[
                    'model' => new AdministratorConfigForm(),
                ]),
            'visible'=>Yii::$app->user->identity->isSuperuser(),
        ],       
    ],
]);
