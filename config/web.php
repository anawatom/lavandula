<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'language'],
	'language' => 'en_US',
    'defaultRoute' => 'home',
    'modules' => [
        // More information http://demos.krajee.com/grid#installation
       'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'HN4a1NyP7UlwLvLzJxad',
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
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info', 'warning', 'error'],
                ],
            ],
        ],
	    'authManager' => [
	         'class' => 'yii\rbac\DbManager',
        ],
        'db' => require(__DIR__ . '/db.php'),
        'language' => [
            'class' => 'app\components\Language',
        ],
        'i18n' => [
            'translations' => [
                    '*' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                        'basePath' => '@app/messages',
                        'fileMap' => [
                            'app' => 'app.php',
                            'app/frontend' => 'frontend.php',
                            'app/backend' => 'backend.php',
                            'app/ctt_staticdata_language' => 'ctt_staticdata_language.php',
                            'app/ctt_staticdata_country' => 'ctt_staticdata_country.php',
                            'app/ctt_staticdata_docsource' => 'ctt_staticdata_docsource.php',
                            'app/ctt_staticdata_authortype' => 'ctt_staticdata_authortype.php',
                            'app/ctt_staticdata_documenttype' => 'ctt_staticdata_documenttype.php',
                            'app/ctt_staticdata_sourcetype' => 'ctt_staticdata_sourcetype.php',
                            'app/ctt_staticdata_revisiontype' => 'ctt_staticdata_revisiontype.php',
                            'app/ctt_staticdata_affiliation' => 'ctt_staticdata_affiliation.php',
                            'app/ctt_staticdata_organization' => 'ctt_staticdata_organization.php',
                            'app/ctt_staticdata_subjectarea' => 'ctt_staticdata_subjectarea.php',
                        ],
                        // - ctt_staticdata_docsources
                        // - ctt_staticdata_authortypes
                        // - ctt_staticdata_documenttypes
                        // - ctt_staticdata_sourcetypes
                        // - ctt_staticdata_revisiontypes
                    ],
                ],
        ],
         'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
        ],
    ],
    'params' => $params,
    'as AccessBehavior' => [
        'class' => 'app\components\AccessBehavior'
    ],
];

if (YII_DEBUG && YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '103.13.28.239'],
    ];
}

return $config;
