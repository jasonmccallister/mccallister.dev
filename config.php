<?php

return [
    'id' => 'mccallister-dev',
    'basePath' => __DIR__ . '/src/',
    'controllerNamespace' => 'app\controllers',
    'aliases' => [
        '@app' => __DIR__ . '/src/',
        '@content' => __DIR__ . '/src/content',
        '@web' => __DIR__ . '/web',
        '@tmp' => '/tmp'
    ],
    'layout' => 'layout.html.twig',
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
                '/articles' => 'articles/index',
                '/articles/<slug>' => 'articles/show',
            ],
        ],
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'scriptUrl' => 'index.php',
        ],
    ],
];
