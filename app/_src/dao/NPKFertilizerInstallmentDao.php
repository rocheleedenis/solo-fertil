<?php

require_once '../../_connection/Connection.php';
require_once '../lang/Translator.php';

class NPKFertilizerInstallmentDao
{
	/**
	 * @param int $idCultura
	 *
	 * @return array
	 */
	public static function select($idCultura)
	{
		$query = "select nutriente, ciclo, porcentagem from parcelamentoAdubNPK where idCultura = :id";

		try {
			$pdo = Connection::prepareQuery($query);

			$pdo->bindParam(":id", $idCultura, PDO::PARAM_INT);

			return $pdo->fetchAll();
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.select'), 500);
		}
	}
}