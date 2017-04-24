<?php

class User extends \HXPHP\System\Model
{
	static $validates_presence_of = array(
		array(
			'name',
			'message' => 'O nome é um campo obrigatório.'
		),
		array(
			'email',
			'message' => 'O e-mail é um campo obrigatório.'
		),
		array(
			'username',
			'message' => 'O nome de usuário é um campo obrigatório.'
		),
		array(
			'password',
			'message' => 'A senha é um campo obrigatório.'
		)
	);

	static $validates_uniqueness_of = array(
		array(
			'username',
			'message' => 'Já existe um usuário com este nome de usuário cadastrado.'
		),
		array('email',
			'message' => 'Já existe um usuário com este e-mail cadastrado.'
		)
	);



	public static function cadastrar(array $post)
	{
		$callbackObj = new \stdClass;
		$callbackObj->user = null;
		$callbackObj->status = false;
		$callbackObj->errors = array();

		$role = Role::find_by_role('user');

		if (is_null($role)) {
			array_push($callbackObj->errors, 'A role user não existe. Contate o administrador');
			return $callbackObj;
		}

		$user_data = array(
			'role_id' => $role->id,
			'status' => 1
		);

		$password = \HXPHP\System\Tools::hashHX($post['password']);// cria uma senha criptografada

		$post = array_merge($post,$user_data,$password);

		$cadastrar = self::create($post);

		if ($cadastrar->is_valid()) {
			$callbackObj->user = $cadastrar;
			$callbackObj->status = true;
			return $callbackObj;
		}

		$errors = $cadastrar->errors->get_raw_errors();

		foreach ($errors as $field => $message) {
			array_push($callbackObj->errors, $message[0]);
		}

		return $callbackObj;
	}
	public static function login(array $post)
	{
		$callbackObj = new \stdClass;
		$callbackObj->user = null;
		$callbackObj->status = false;
		$callbackObj->code = null;
		$callbackObj->Tentativasrestantes = null;




		$user = self::find_by_username($post['username']);

		if(!is_null($user)){
			$password= \HXPHP\System\Tools::hashHX($post['password'], $user->salt );// compara a senha criptografada

			if($user->status===1){
				if(LoginAttempt::Existemtentativas($user->id)){

			 		if($password['password'] === $user->password){
						$callbackObj->user = $user;
						$callbackObj->status = true;

						LoginAttempt::Limpartentativas($user->id);
						}

						else{

							if (LoginAttempt::Tentativasrestantes($user->id)<= 3) {
								$callbackObj->code = 'tentativas-esgotando';
								$callbackObj->Tentativasrestantes = LoginAttempt::Tentativasrestantes($user->id);
							}
							else{
								$callbackObj->code = 'dados-incorretos';
							}
						
						LoginAttempt::Registrartentativas($user->id);
						}
					}
				
				else{

					$callbackObj->code = 'usuario-bloqueado';
					$user->status=0;
					$user->save(false);

				}
				
			}
			else {
			$callbackObj->code = 'usuario-bloqueado';
			}		
		}
		else {
			$callbackObj->code = 'usuario-inexistente';
		}
		return $callbackObj;			
	}
	public static function atualizarSenha($user,$newPassword)	
	{
		$user= self::find_by_id($user->id);
		$password = \HXPHP\System\Tools::hashHX($newPassword);
		$user->password = $password['password'];
		$user->salt= $password['salt'];

		return $user=save(false);
	}
}
