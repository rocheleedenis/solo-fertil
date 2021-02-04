<?php

interface Iproducao{

	public function insert();
	public static function delete($id);
	public function selectOne($id);
	public function update();
	public static function selectBusca($info);
	public static function selectProdutividade($info);

	public static function sugerirAdubacao($analise, $cultura);
	public static function sugerirCultura($analise, $id);
}