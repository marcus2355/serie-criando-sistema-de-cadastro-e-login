<?php
	class Users extends ActiveRecord\Model{
		public static function criar($args){
			self::create($args);
		}
		public static function deletar($user_id){
			$user=self::find($user_id);
			$user->delete();
		}
	}