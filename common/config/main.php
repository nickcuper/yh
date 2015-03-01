<?php

	Yii::setPathOfAlias('root', realpath(__DIR__ . '/../..'));
	Yii::setPathOfAlias('common', realpath(__DIR__ . '/..'));

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
	$config = [
		'basePath'      => __DIR__ . '/..',
		'runtimePath'   => __DIR__ . '/../../runtime',
		'extensionPath' => __DIR__ . '/../extensions',
		'name'          => 'App',
		'theme' 		=> 'simple',

		// Preloading 'log' component.
		'preload'       => ['log'],
		'aliases'       => [
			'bootstrap' => 'root.vendor.crisu83.yiistrap',
		],
		// Autoloading model and component classes.
		'import'        => [
			// Yii autoloaded files.
			'application.models.*',
			'application.components.*',
			'bootstrap.behaviors.*',
			'bootstrap.helpers.*',
			'bootstrap.widgets.*',
		],

		'modules' => [
			'gii' => [
				'class' => 'system.gii.GiiModule',
				'password' => 'first',
				// If removed, Gii defaults to localhost only. Edit carefully to taste.
				'ipFilters' => ['127.0.0.1', '::1'],
			],
		],

		// Application components.
		'components'    => [
			'bootstrap'    => [
				'class' => 'bootstrap.components.TbApi',
			],
			'user'         => [
				'class'          => 'CWebUser',
				// Enable cookie-based authentication.
				'allowAutoLogin' => true,
			],
			'urlManager'   => [
				'showScriptName' => false,
				'urlFormat'      => 'path',
				'rules'          => [
					''                                       => 'site/index',
					'<controller:\w+>/'                      => '<controller>/index',
					'<controller:\w+>/<id:\d+>'              => '<controller>/view',
					'<controller:\w+>/<id:\d+>/<action:\w+>' => '<controller>/<action>',
					'<controller:\w+>/<action:\w+>'          => '<controller>/<action>',
				],
			],
			'db'           => [
				'connectionString'      => 'mysql:host=localhost;dbname=yahooHandler',
				'emulatePrepare'        => true,
				'username'              => 'root',
				'password'              => 'root',
				'charset'               => 'utf8',
				'schemaCachingDuration' => !YII_DEBUG ? 86400 : 0,
				'enableParamLogging'    => YII_DEBUG,
			],
			'cache'        => [
				'class' => 'CFileCache',
			],
			'themeManager' => [
				'basePath' => __DIR__ . '/../../themes',
			],
			'assetManager' => YII_DEBUG ? [] : [
				'class'                  => 'EAssetManagerBoostGz',
				'minifiedExtensionFlags' => ['min.js', 'minified.js', 'packed.js'],
			],
			'clientScript' => [
				'packages'  => [
					// jQuery CDN - provided by (mt) Media Temple.
					'jquery'       => [
						'baseUrl' => 'http://code.jquery.com/',
						'js'      => [YII_DEBUG ? 'jquery-2.0.2.js' : 'jquery-2.0.2.min.js'],
					],
					'bootstrap'    => [
						'baseUrl' => '//maxcdn.bootstrapcdn.com/twitter-bootstrap/2.3.2/',
						// CSS/bootstrap-theme.min.css.
						'css'     => ['css/bootstrap-combined.no-icons.min.css'],
						'js'      => ['js/bootstrap.min.js'],
						'depends' => ['jquery'],
					],
					'font-awesome' => [
						'baseUrl' => '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/',
						'css'     => [YII_DEBUG ? 'font-awesome.css' : 'font-awesome.min.css'],
					],
					'simple' => [
						'depends' => ['bootstrap', 'font-awesome'],
						'basePath' => 'root.themes.simple.assets',
						'css' => ['custom.css'],
						'js' => ['app.js'],
					],
				],
				'behaviors' => [
					[
						'class'     => 'LocalScriptsBehavior',
						'rootAlias' => 'common',
						'publishJs' => true,
						// Uncomment this if your css don't use relative links.
						// 'publishCss' => !YII_DEBUG,
					],
				],
			],
			'errorHandler' => [
				// Use 'site/error' action to display errors.
				'errorAction' => 'site/error',
			],
			'log'          => [
				'class'  => 'CLogRouter',
				'routes' => [
					[
						'class'  => 'CFileLogRoute',
						'levels' => 'error, warning' . PHP_EOL,
					],
					[
						'class'   => 'FormattedFileLogRoute',
						'format'  => "{time}\t{ip}\t{category}\t{uri}\t{message}",
						'except'  => 'exception.CHttpException.404',
						'levels'  => 'error',
						'logFile' => 'error.log',
					],
					[
						'class'      => 'FormattedFileLogRoute',
						'format'     => "{time}\t{ip}\t{uri}\t{sref}",
						'categories' => 'exception.CHttpException.404',
						'logFile'    => 'error404.log',
					],
					[
						'class'   => 'FormattedFileLogRoute',
						'format'  => "{time}\t{ip}\t{uri}\t{msg}\n{trace}",
						'levels'  => 'warning',
						'logFile' => 'warning.log'
					],
					[
						'class'   => 'FormattedFileLogRoute',
						'format'  => "{time}\t{ip}\t{uri}\t{msg}\n{trace}",
						'levels'  => 'quotesSave',
						'logFile' => 'quotesSave.log'
					],
					[
						'class'   => 'FormattedFileLogRoute',
						'format'  => "{time}\t{msg}\n{trace}",
						'levels'  => 'quotesParse',
						'logFile' => 'quotesParse.log'
					],
				],
			],
			'quotes' => [
				'class' => 'Quotes',
				'mode' => 'CURL', // CURL, SOAP
				'format' => 'json', // json, xml
			],
		],
		'params'        => [
			// This is used in contact page.
			'adminEmail' => 'webmaster@example.com',
		],
	];

	if (YII_DEBUG) {
		$config['import'] = array_merge($config['import'], [
			// Composer autoloaded files.
			'common.models.*',
			'common.models.forms.*',
			'common.components.*',
			'common.components.behaviors.*',
		]);
	}

	// Apply local config modifications.
	@include dirname(__FILE__) . '/main-local.php';

	return $config;
