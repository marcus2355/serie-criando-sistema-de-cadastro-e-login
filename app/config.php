<?php
	//Constantes
	$configs = new HXPHP\System\Configs\Config;

	$configs->env->add('development');

	$configs->env->development->baseURI = '/sistema/';

	$configs->env->development->database->setConnectionData(array(
		'host' => 'localhost',
		'user' => 'Marcus_Vinicius',
		'password' => 'p5000702mv',
		'dbname' => 'sistemahx'
	));

	return $configs;
