<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'ru_RU',
    'name'=>'tests',
    
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'EA_zaaCyweDmsUF9N_oRChVTU91-RWbl',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
              'identityClass' => 'budyaga\users\models\User',
			   'enableAutoLogin' => true,
			   'loginUrl' => ['/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'mailer' => [
             'class' => 'yii\swiftmailer\Mailer',
			'viewPath' => '@app/mail',
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'smtp.timeweb.ru',
				'username' => '',
				'password' => '',
				'port' => '465',
				'encryption' => 'ssl', // у яндекса SSL
			],
			'useFileTransport' => false, 
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
        
        'authManager' => [
		   'class' => 'yii\rbac\DbManager',
		],
		'urlManager' => [ 
		   'enablePrettyUrl' => true, 
		   'showScriptName' => true, 
		    'rules' => [
				'<controller>/<action>'=>'<controller>/<action>',
				'/signup' => '/user/user/signup',
				'/login' => '/user/user/login',
				'/logout' => '/user/user/logout',
				'/requestPasswordReset' => '/user/user/request-password-reset',
				'/resetPassword' => '/user/user/reset-password',
				'/profile' => '/user/user/profile',
				'/retryConfirmEmail' => '/user/user/retry-confirm-email',
				'/confirmEmail' => '/user/user/confirm-email',
				'/unbind/<id:[\w\-]+>' => '/user/auth/unbind',
				'/oauth/<authclient:[\w\-]+>' => '/user/auth/index'
		   ],
	   ],
        'authClientCollection' => [
		   'class' => 'yii\authclient\Collection',
		   'clients' => [
			   'vkontakte' => [
				   'class' => 'budyaga\users\components\oauth\VKontakte',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
				   'scope' => 'email'
			   ],
			   'google' => [
				   'class' => 'budyaga\users\components\oauth\Google',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
			   ],
			   'facebook' => [
				   'class' => 'budyaga\users\components\oauth\Facebook',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
			   ],
			   'github' => [ 
				   'class' => 'budyaga\users\components\oauth\GitHub',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
				   'scope' => 'user:email, user'
			   ],
			   'linkedin' => [
				   'class' => 'budyaga\users\components\oauth\LinkedIn',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
			   ],
			   'live' => [
				   'class' => 'budyaga\users\components\oauth\Live',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
			   ],
			   'yandex' => [
				   'class' => 'budyaga\users\components\oauth\Yandex',
				   'clientId' => 'XXX',
				   'clientSecret' => 'XXX',
			   ],
			   'twitter' => [
				   'class' => 'budyaga\users\components\oauth\Twitter',
				   'consumerKey' => 'XXX',
				   'consumerSecret' => 'XXX',
			   ],
		   ],
	   ],
        
    ],
    'modules' => [
	   'user' => [
		   'class' => 'budyaga\users\Module',
		   'userPhotoUrl' => 'http://example.com/uploads/user/photo',
		   'userPhotoPath' => '@frontend/web/uploads/user/photo'
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
        'allowedIPs' => ['127.0.0.1', '::1', '178.161.223.2'],
    ];
}

return $config;
