<?php 
	require_once 'conexao.php';

	$user=Users::find(1);
	$user->update_attributes(array("nome"=>"HxTutors"));
	print_r($user);

