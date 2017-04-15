<?php 
	require_once 'conexao.php';
	/*
	WHERE = CONDITIONS
	SELECT * FROM TABLE WHERE X=Y LIMIT 0,50
	*/
	$usuario=Users::find("all",array("conditions"=>array("status=?",0),"order"=>"id DESC"));
	echo '<pre>';
	print_r($usuario);
	echo '</pre>';

	$hxtutors=Users::find_by_nome_or_status('Hxtutors',0);
	var_dump($hxtutors);
	
