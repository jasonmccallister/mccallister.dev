<?php

return [
    'id' => 'mccallister-dev',
    'basePath' => __DIR__,
    'controllerNamespace' => 'app\controllers',
    'aliases' => [
        '@app' => __DIR__,
        '@tmp' => '/tmp'
    ],
    'layout' => 'main.html.twig',
    'components' => [
        'view' => [
            'class' => 'yii\web\View',
            'renderers' => [
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    'cachePath' => '@tmp/twig/cache',
                    'options' => [
                        'auto_reload' => true,
                    ],
                    'globals' => [
                        'html' => ['class' => '\yii\helpers\Html'],
                    ],
                    'uses' => ['yii\bootstrap'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '/' => 'site/home',
            ],
        ],
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'scriptUrl' => 'index.php',
        ],
    ],
];
