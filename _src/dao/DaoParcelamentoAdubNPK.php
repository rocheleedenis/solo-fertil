<?php 

	require_once '../../_connection/Connection.php';

class DaoParcelamentoAdubNPK{

	public static function select($idCultura){
		$database = Connection::connect();
		$query = "select nutriente, ciclo, porcentagem from parcelamentoAdubNPK where idCultura = :id";
		try{
			$pdo = $database->prepare($query);
			$pdo->bindParam(":id", $idCultura, PDO::PARAM_INT);
			if($pdo->execute()){
				$oi = $pdo->fetchAll();
			}
			unset($database);
			return $oi;
		}catch(PDOException $e){
			var_dump($e);
		}
	}
}