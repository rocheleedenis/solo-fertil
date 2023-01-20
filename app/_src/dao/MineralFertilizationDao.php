<?php

class MineralFertilizationDao {
	public static function select($idCultura){
		$database = Connection::connect();
		$query = "select disponibNutriente, p2o5soloArgiloso, p2o5soloMedio, p2o5soloArenoso, k2o, nitrogenio from adubacaoMineral where idCultura = :id";
		try {
			$pdo = $database->prepare($query);
			$pdo->bindParam(":id", $idCultura, PDO::PARAM_INT);
			if ($pdo->execute()){
				return $pdo->fetchAll();
			}
		} catch (PDOException $e) {
			var_dump($e->getMessage());
		}
	}
}