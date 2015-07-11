<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'f2ngin'=>[
            'class'=>'johnitvn\f2ngin\Module',
            // The path of f2ngin's config files
            'config'=>'@backend/config/f2n-config',
            // Config for user plus module
            'userplus'=>[],
            // Config for user compoments
            'user'=>[],
        ],
    ],
    'components' => [
        // 'request' => [
        //     'baseUrl' => '/admin',
        // ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],       
    ],
    'params' => $params,
];