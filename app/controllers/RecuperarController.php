<?php

class RecuperarController extends \HXPHP\System\Controller
{
	public function __construct($configs)
	{
		parent::__construct($configs);
		$this->load('Services\Auth',
		$configs->auth->after_login ,
		$configs->auth->after_logout ,
		true
		);
	$this->auth->redirectCheck(true);//true

	$this->view->setTitle('SistemaHX - Alterar sua senha');

	$this->load('Modules\Messages','password-recovery');
	$this->messages->setBlock('alerts');
	}

	public function solicitarAction()
	{
		$this->view->setFile('index');

		$this->request->setCustomFilters(array(
			'email'=> FILTER_VALIDATE_EMAIL
			));

		$email=$this->request->post('email');

		$error=null;

		if (!is_null($email) && $email !== false) {
			$validar = Recovery::validar($email);

				if ($validar->status === false) {
					$error= $this->messages->getByCode($validar->code);
				}
				else{
					$this->load(
						'Services\PasswordRecovery',
						$this->configs->site->url . $this->configs->baseURI .'recuperar/redefinir/'
					);

					Recovery::create(array(
						'user_id'=>$validar->user->id,
						'token'=>$this->passwordrecovery->token,
						'status' => 0
					));
					$message=$this->messages->messages->getBycode('link-enviado',array(
						'message'=> array(
							$validar->user->name,
							$this->passwordrecovery->link,
							$this->passwordrecovery->link
						)
					));
									
					$this->load('Services\Email');

					$envioDoEmail=$this->email->send(
						$validar->user->email,
						'HXPHP -' . $message ['subject'],
						$message['message'] . 'HXPHP',
						array(
							'email'=>$this->configs->mail->from_mail,
							'remetente'=>$this->configs->mail->from
						)
					);
				if($envioDoEmail===false){
					$error= $this->messages->getByCode('email-nao-enviado');
				}
			}
		}
		else{
			$error= $this->messages->getByCode('nenhum-usuario-encontrado');
			}

		if(!is_null($error)){
			$this->load('Helpers\Alert', $error);
		}
			else{
				$success =$this->messages->getByCode('link-enviado');
				$this->view->setFile('blank');

				$this->load('Helpers\Alert', $success);
			}
	}

	public function redefinirAction($token)
	{
		$this->view->setTitle('SistemaHX - Alterar sua senha');
		$validartoken= Recovery::validartoken($token);
		$error=null;

		if ($validartoken->status === false) {
			$error= $this->messages->getByCode($validartoken->code);

		}

		if (! is_null($error)) {
			$this->view->setFile('blank');
			$this->load('Helpers\Alert', $error);
		}
			else{
				$this->view->setVar('token', $token);
			}

	}

	public function alterarSenhaAction($token)
	{
		
	}
}