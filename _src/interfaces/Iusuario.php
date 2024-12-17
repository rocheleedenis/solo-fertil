<?php

interface Iusuario{

	public function insert();
	public static function delete($id);
	public function selectOne($id);
	public static function selectLogin($email, $senha);
	public function update();

}