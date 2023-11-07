<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '4GhNH-cNv7j36SkJ7UjQ6J4bNStKAaOy',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true, //  ativa URLs amigáveis, tornando as URLs mais legíveis para os usuários.
            'enableStrictParsing' => true, // Se uma URL não corresponder a nenhuma regra, um erro será gerado.
            'showScriptName' => false, // Isso remove o nome do script (geralmente "index.php") das URLs, tornando as URLs mais limpas.
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'user',
                    'pluralize' => false, // PESQUISAR
                    'extraPatterns' => [
                        'GET' => 'index',
                        'GET <id:\d+>' => 'view', 
                        'GET user/<id:\d+>/companies' => 'user/companies', // TO-DO
                        'POST create' => 'create',
                        'PUT <id:\d+>' => 'update',
                        'DELETE <id:\d+>' => 'delete',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'company',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET' => 'index',
                        'GET <id:\d+>' => 'view',
                        'GET user/<id:\d+>/companies' => 'user/company', // TO-DO
                        'POST create' => 'create',
                        'PUT update/<id:\d+>' => 'update',
                        'DELETE delete/<id:\d+>' => 'delete',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
