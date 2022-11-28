<?php

interface Ianalise{

	public static function selectAll($idP);
	public function selectOne($id);
	public function update();
	public static function delete($id);
	public function insert();

	public function interpretacao();
}