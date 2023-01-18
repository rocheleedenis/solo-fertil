<?php

    require_once '../../_connection/Connection.php';
    require_once '../specials/SpecialProducao.php';

class FarmProductionDao extends SpecialProducao{

	public static function selectBusca($info){
		$database = Connection::connect();
		$query = 'select producao.id, producao.idCultura, producao.`data`, cultura.nome as c_nome, produtor.nome as pr_nome, produtor.fazenda from producao, cultura, produtor where produtor.id = :idP and cultura.id = :idC and cultura.id=producao.idCultura  and produtor.id=producao.idprodutor and `data` between :dataI and :dataF order by `data` asc';
		$dataI = Config::dateToUSA($info['nDataI']);
		$dataF = Config::dateToUSA($info['nDataF']);
		try{
			$pdo = $database->prepare($query);
			$pdo->bindParam(":idP", $info['nProdutor'], PDO::PARAM_INT);
			$pdo->bindParam(":idC", $info['nCultura'], PDO::PARAM_INT);
			$pdo->bindParam(":dataI", $dataI, PDO::PARAM_STR);
			$pdo->bindParam(":dataF", $dataF, PDO::PARAM_STR);
			$pdo->execute();
			return $pdo->fetchAll();
		}catch(PDOException $e){
			var_dump($e->getMessage());
		}
	}

	public static function selectProdutividade($info){
		$database = Connection::connect();
		$query = 'select producao.*, cultura.nome as c_nome, produtor.nome as pr_nome, produtor.fazenda from producao, cultura, produtor where produtor.id = :idP and cultura.id = :idC and cultura.id=producao.idCultura  and produtor.id=producao.idprodutor order by `data` asc';
		try{
			$pdo = $database->prepare($query);
			$pdo->bindParam(":idP", $info['nProdutor'], PDO::PARAM_INT);
			$pdo->bindParam(":idC", $info['nCultura'], PDO::PARAM_INT);
			$pdo->execute();
			return $pdo->fetchAll();
		}catch(PDOException $e){
			var_dump($e->getMessage());
		}
	}

	public function selectOne($id){
		$database = Connection::connect();
		$query = "select producao.*, produtor.nome as pt_nome, cultura.nome as c_nome, produtor.fazenda from producao join cultura join produtor on producao.id = :id and producao.idProdutor = produtor.id and cultura.id = producao.IdCultura";
		try{
			$pdo = $database->prepare($query);
			$pdo->bindParam(":id", $id, PDO::PARAM_INT);
			$pdo->execute();
			$oi = $pdo->fetch();
			if (!empty($oi)) {
				$this->setId($oi['id']);
				$this->setIdCultura($oi['idCultura']);
				$this->setIdUsuario($oi['idUsuario']);
				$this->setData($oi['data']);
				$this->setAreaPlantada($oi['areaPlantada']);
				$this->setUnidadeArea($oi['unidadeArea']);
				$this->setProducao($oi['producao']);
				$this->setUnidade($oi['unidade']);
				$this->setPrecoVenda($oi['precoVenda']);
				$this->setQtdVendida($oi['qtdVendida']);
				$this->setQtdAduboOrganico($oi['qtdAduboOrganico']);
				$this->setPrecoAduboOrganico($oi['precoAduboOrganico']);
				$this->setGastosNPK($oi['gastosNPK']);
				$this->setQtdCalcario($oi['qtdCalcario']);
				$this->setPrecoCalcario($oi['precoCalcario']);
				$this->setIdProdutor($oi['idProdutor']);
				return array('cultura' => $oi['c_nome'], 'produtor' => $oi['pt_nome'], 'fazenda' => $oi['fazenda']);
			}else{
				echo "Nenhum registro encontrado com esse id";
			}
		}catch(PDOException $e){
			var_dump($e->getMessage());
		}
	}

	public function insert(){
		$database = Connection::connect();
		$query = "insert into producao values (default, :idUsuario, :idCultura, :data, :areaPlantada, :unidadeArea, :producao, :unidade, :precoVenda, :qtdVendida, :qtdAduboOrganico, :precoAduboOrganico, :gastosNPK, :qtdCalcario, :precoCalcario, :idProdutor)";
		try {
			$pdo = $database->prepare($query);
			$pdo->bindValue(':idCultura', $this->getIdCultura(), PDO::PARAM_INT);
			$pdo->bindValue(':idUsuario', $this->getIdUsuario(), PDO::PARAM_INT);
			$pdo->bindValue(':data', $this->getData(), PDO::PARAM_STR);
			$pdo->bindValue(':areaPlantada', $this->getAreaPlantada(), PDO::PARAM_STR);
			$pdo->bindValue(':unidadeArea', $this->getUnidadeArea(), PDO::PARAM_STR);
			$pdo->bindValue(':producao', $this->getProducao(), PDO::PARAM_STR);
			$pdo->bindValue(':unidade', $this->getUnidade(), PDO::PARAM_STR);
			$pdo->bindValue(':precoVenda', $this->getPrecoVenda(), PDO::PARAM_STR);
			$pdo->bindValue(':qtdVendida', $this->getQtdVendida(), PDO::PARAM_STR);
			$pdo->bindValue(':qtdAduboOrganico', $this->getQtdAduboOrganico(), PDO::PARAM_STR);
			$pdo->bindValue(':precoAduboOrganico', $this->getPrecoAduboOrganico(), PDO::PARAM_STR);
			$pdo->bindValue(':gastosNPK', $this->getGastosNPK(), PDO::PARAM_STR);
			$pdo->bindValue(':qtdCalcario', $this->getQtdCalcario(), PDO::PARAM_STR);
			$pdo->bindValue(':precoCalcario', $this->getPrecoCalcario(), PDO::PARAM_STR);
			$pdo->bindValue(':idProdutor', $this->getIdProdutor(), PDO::PARAM_STR);
			$pdo->execute();
			return $pdo->rowCount();
		} catch (PDOException $e) {
			var_dump($e->getMessage());die();
		}
	}

	public function update(){
		$database = Connection::connect();
		$query = "update producao set idCultura=:idCultura, data=:data, areaPlantada=:areaPlantada, producao=:producao, unidade=:unidade, precoVenda=:precoVenda, qtdVendida=:qtdVendida, gastosNPK=:gastosNPK, qtdAduboOrganico=:qtdAduboOrganico, precoAduboOrganico=:precoAduboOrganico, qtdCalcario=:qtdCalcario, precoCalcario=:precoCalcario, idProdutor=:idProdutor where id=:id";
		try{
			$pdo = $database->prepare($query);
			$pdo->bindValue(':id', $this->getId(), PDO::PARAM_INT);
			$pdo->bindValue(':idCultura', $this->getIdCultura(), PDO::PARAM_INT);
			$pdo->bindValue(':data', $this->getData(), PDO::PARAM_STR);
			$pdo->bindValue(':areaPlantada', $this->getAreaPlantada(), PDO::PARAM_STR);
			$pdo->bindValue(':producao', $this->getProducao(), PDO::PARAM_STR);
			$pdo->bindValue(':gastosNPK', $this->getGastosNPK(), PDO::PARAM_STR);
			$pdo->bindValue(':precoVenda', $this->getPrecoVenda(), PDO::PARAM_STR);
			$pdo->bindValue(':unidade', $this->getUnidade(), PDO::PARAM_STR);
			$pdo->bindValue(':qtdVendida', $this->getQtdVendida(), PDO::PARAM_STR);
			$pdo->bindValue(':precoCalcario', $this->getPrecoCalcario(), PDO::PARAM_STR);
			$pdo->bindValue(':precoAduboOrganico', $this->getPrecoAduboOrganico(), PDO::PARAM_STR);
			$pdo->bindValue(':qtdCalcario', $this->getQtdCalcario(), PDO::PARAM_STR);
			$pdo->bindValue(':qtdAduboOrganico', $this->getQtdAduboOrganico(), PDO::PARAM_STR);
			$pdo->bindValue(':idProdutor', $this->getIdProdutor(), PDO::PARAM_STR);
			$pdo->execute();
			return $pdo->rowCount();
		}catch(PDOException $e){
			var_dump($e->getMessage());
		}
	}

	public static function delete($id){
		$database = Connection::connect();
		$query = "delete from producao where id=:id";
		try {
			$pdo = $database->prepare($query);
			$pdo->bindParam(':id', $id, PDO::PARAM_INT);
			$pdo->execute();
			return $pdo->rowCount();
		} catch (PDOException $e) {
			var_dump($e->getMessage());
		}
	}
}