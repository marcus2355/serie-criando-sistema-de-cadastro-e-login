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

	$configs->env->development->auth->setURLs('/sistema/home/','/sistema/login/');


	$configs->env->development->menu->setMenus(array(
		'Home/dashboard'=>'%daseURI%/home',
		'Link/user'=>'http://www.google.com',
		'Submenus/cog'=> array(
			'Paneil/dashboard'=>'%daseURI%/home',
			'Atualizações/hand-o-up'=>'%daseURI%/atualizacoes'
			)
		), 'user');

	$configs->env->development->menu->setConfigs(array(
		'conteiner'=> 'nav',
		'conteiner_class'=> 'nav navbar-default',
		'menu_class'=> 	'nav navbar-nav'

		));


	$configs->env->development->menu->setMenus(array(
		'Home/dashboard'=>'%daseURI%/home'
		));




	$configs->env->add('production');

	$configs->env->production->baseURI = '/';

	$configs->env->production->database->setConnectionData(array(
		'host' => 'localhost',
		'user' => 'id1409722_marcusvinicius',
		'password' => 'mvmh150219',
		'dbname' => 'id1409722_sistema'
	));

	$configs->env->production->auth->setURLs('/home/','/login/');


	return $configs;