<?php

/*$config['modules']['gii'] = array(
	'class'=>'system.gii.GiiModule',
	'password' => false,
	// If removed, Gii defaults to localhost only. Edit carefully to taste.
	'ipFilters'=>array('127.0.0.1','::1'),
    'generatorPaths' => array('bootstrap.gii'),
);*/

$group = &$config['components']['db'];
$group = array_merge($group, array(
	'connectionString' => 'mysql:host=localhost;dbname=yahooHandler',
	'username' => 'username',
	'password' => 'password',
));

