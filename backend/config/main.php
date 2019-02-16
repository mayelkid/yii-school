<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id'         => 'app-backend',
    'name'       => '智慧班牌管理系统',
    'basePath'   => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap'  => ['log'],
    'modules'    => [
		'gii' => [
			'class' => 'yii\gii\Module',
			//'password'=>'alenplum',
			'allowedIPs'=>array('180.*.*.225','::1','222.247.83.40'),
		],
	],
    'language'   => 'zh-CN',
    'components' => [
        // 权限管理
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],

        // 资源管理修改
        'assetManager' => [
            'bundles' => [
                // 去掉自己的bootstrap 资源
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => []
                ],
                // 去掉自己加载的Jquery
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => [],
                ],
            ],
        ],

        // 图片处理
        'image' => [
            'class'  => 'yii\image\ImageDriver',
            'driver' => 'GD'
        ],

        // 用户信息
        'user' => [
            'identityClass'   => 'common\models\Admin',
            'enableAutoLogin' => true,
        ],

        // 错误页面
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		//缓存
		'cache' => [ 
			'class' => 'yii\caching\FileCache', 
			'cachePath' => '@runtime/cache', 
		], 
    ],

    'params' => $params,
];