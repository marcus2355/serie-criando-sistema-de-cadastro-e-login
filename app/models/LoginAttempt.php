<?php

class LoginAttempt extends \HXPHP\System\Model
{
	public static Totaldetentativas($user_id)
	{
		return cout(self::fild_all_by_user_id($user_id));// verifica quantas vezes foi realizada a tentativa de login
	}
	public static Tentativasrestantes($user_id)
	{
		return intval(5-self::Totaldetentativas());
	}

	public static function Registrartentativas($user_id)
	{
		self::create(array(
			'user_id'=>$user_id
		));
	}

	public static function Limpartentativas($user_id)
	{
		self:: delete_all (array(

			'conditions'=>array(
				'user_id = ?',
				$user_id
			)
		));
	}
	public static function Existemtentativas($user_id)
	{
		return self::Totaldetentativas() < 5 ? true : false ;
	}
}
