<?php

class MineralFertilizationDao
{
	/**
	 * @param int $idCultura
	 *
	 * @return array|void
	 */
	public static function select($idCultura)
	{
		$query = "select disponibNutriente, p2o5soloArgiloso, p2o5soloMedio, p2o5soloArenoso, k2o, nitrogenio from adubacaoMineral where idCultura = :id";

		try {
			$pdo = Connection::prepareQuery($query);

			$pdo->bindParam(":id", $idCultura, PDO::PARAM_INT);

			if ($pdo->execute()) {
				return $pdo->fetchAll();
			}
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.select'), 500);
		}
	}
}