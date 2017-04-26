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
		'Home/dashboard' => '%baseURI%/home',
		'Projetos/briefcase' => '%baseURI%/projetos',
		'Editar perfil/cog' => '%baseURI%/perfil/editar',
		'Sair/sign-out' => '%baseURI%/login/sair'
	), 'user');

	$configs->env->development->menu->setMenus(array(
		'Home/dashboard' => '%baseURI%/home',
		'Usuários/users' => '%baseURI%/usuarios',
		'Editar perfil/cog' => '%baseURI%/perfil/editar',
		'Sair/sign-out' => '%baseURI%/login/sair'
	), 'administrator');

	$configs->env->development->menu->setMenus(array(
		'Home/dashboard' => '%baseURI%/home'
	));
	$configs->env->development->menu->setConfigs(array(
		'container' => 'nav',
		'container_class' => 'navbar navbar-default',
		'menu_class' => 'nav navbar-nav'
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


	$configs->env->production->menu->setMenus(array(
		'Home/dashboard' => '%baseURI%/home',
		'Projetos/briefcase' => '%baseURI%/projetos',
		'Editar perfil/cog' => '%baseURI%/perfil/editar',
		'Sair/sign-out' => '%baseURI%/login/sair'
	), 'user');

	$configs->env->production->menu->setMenus(array(
		'Home/dashboard' => '%baseURI%/home',
		'Usuários/users' => '%baseURI%/usuarios',
		'Editar perfil/cog' => '%baseURI%/perfil/editar',
		'Sair/sign-out' => '%baseURI%/login/sair'
	), 'administrator');

	$configs->env->production->menu->setMenus(array(
		'Home/dashboard' => '%baseURI%/home'
	));
	$configs->env->production->menu->setConfigs(array(
		'container' => 'nav',
		'container_class' => 'navbar navbar-default',
		'menu_class' => 'nav navbar-nav'
	));



	return $configs;