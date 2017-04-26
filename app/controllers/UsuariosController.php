<?php 

class UsuariosController extends \HXPHP\System\Controller
{
	public function __construct($configs)
	{
		parent::__construct($configs);

		$this->load(
			'Services\Auth',
			$configs->auth->after_login,
			$configs->auth->after_logout,
			true
		);

		$this->auth->redirectCheck();

		$user_id = $this->auth->getUserId();
		$user = User::find($user_id);
		$role = Role::find($user->role_id);

		$this->auth->roleCheck(array(
			'administrator'// somente o administrador tem acesso a esse link
		));

		$this->load(
			'Helpers\Menu',
			$this->request,
			$this->configs,
			$role->role

			);

		

		$this->view->setTitle('HXPHP - Administrativo')
					->setVars([
						'user'=>$user,
						'users'=> User::all()
						]);
	}

	
}