<?php 
	require_once 'conexao.php';
	//Users::delete_all(array("conditions"=>array("status=?",1)));
	//DELETE FROM users WHERE status=1;
	//$delete=mysql_query("DELETE FROM users WHERE status=1");

	//Users::deletar(1);

	/*$data=array(
		'nome'=>'Bruno Santos',
		'status'=>0
	);
	Users::criar($data);*/

	Users::deletar(1);