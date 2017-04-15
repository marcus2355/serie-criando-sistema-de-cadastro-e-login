<?php 
	require_once 'conexao.php';
	
	$user=Users::find_by_nome_or_status('Bruno Santos',1);
	//$user->nome='Alterado';
	//$user->save();
	//echo $user->nome;
	if(count($user) > 0){
		$data=array(
			'nome'=>'Alterado #3',
			'status'=>1
		);
		$user->update_attributes($data);
		echo $user->nome;
	}else
		echo 'Usu&aacute;rio n&atilde;o encontrado!';