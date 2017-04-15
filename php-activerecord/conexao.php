<?php
	require_once 'vendor/php-activerecord/php-activerecord/ActiveRecord.php';
	$cfg = ActiveRecord\Config::instance();
	$cfg->set_model_directory('models');
	$cfg->set_connections(array('development' =>
	  'mysql://root:@localhost/composer'));