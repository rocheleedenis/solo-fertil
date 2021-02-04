<?php 

    require_once '../../_connection/Connection.php';
    require_once '../specials/SpecialAnalise.php';

class DaoAnalise extends SpecialAnalise{

	public static function selectAll($idU){
		$database = Connection::connect();
		$query = "select a.id, a.data, a.local, p.fazenda, p.nome from analise as a join produtor as p on p.id = a.idProdutor and a.idUsuario = :idU";
		try{
			$pdo = $database->prepare($query);
			$pdo->bindParam(":idU", $idU, PDO::PARAM_INT);
			$pdo->execute();
			return $pdo->fetchAll();
		}catch(PDOException $e){ 
			var_dump($e->getMessage());
		}
	}

	public function selectOne($id){
		$database = Connection::connect();
		$query = "select a.*, p.nome, p.fazenda from analise as a join produtor as p on p.id = a.idProdutor and a.id = :id";
		try{
			$pdo = $database->prepare($query);
			$pdo->bindParam(":id", $id, PDO::PARAM_INT);
			$pdo->execute();
			$oi = $pdo->fetch();
			if (!empty($oi)) {
				$this->setId($oi['id']);
				$this->setData(Config::dateToBr($oi['data']));
				$this->setLocal($oi['local']);
				$this->setProfundidade($oi['profundidade']);
				$this->setPh($oi['pH']);
				$this->setFosforo($oi['fosforo']);
				$this->setPotassio($oi['potassio']);
				$this->setCalcio($oi['calcio']);
				$this->setMagnesio($oi['magnesio']);
				$this->setAluminio($oi['aluminio']);
				$this->setAcidezPotencial($oi['acidezPotencial']);
				$this->setSomaBases($oi['somaBases']);
				$this->setMatOrganica($oi['matOrganica']);
				if ($oi['teorArgila']) {
					$this->setTeorArgila($oi['teorArgila']);
					$this->setIndiceY();
					$this->setPrem($oi['prem']);
				}else{
					$this->setPrem($oi['prem']);
					$this->setIndiceY();
					$this->setTeorArgila($oi['teorArgila']);
				}
				$this->setIdProdutor($oi['idProdutor']);
				$this->setIdUsuario($_SESSION['sf']['userId']);
				$this->setCtcEfetiva();
				$this->setCtcPH7();
				$this->setSaturacaoBases();
				$this->setSaturacaoAl();
				
				return array('nome' =>$oi['nome'], 'fazenda' => $oi['fazenda']);
			}
		}catch(PDOException $e){
			var_dump($e->getMessage());
		}
	}

	public function insert(){
		$database = Connection::connect();
		$query = "insert into analise values (default, :data, :local, :profundidade, :pH, :fosforo, :potassio, :calcio, :magnesio, :aluminio, :somaBases, :acidezPotencial, :matOrganica, :prem, :teorArgila, :idProdutor, :idUsuario)";
		try {
			$pdo = $database->prepare($query);
			$pdo->bindValue(':data', $this->getData(), PDO::PARAM_STR);
			$pdo->bindValue(':local', $this->getLocal(), PDO::PARAM_STR);
			$pdo->bindValue(':profundidade', $this->getProfundidade(), PDO::PARAM_STR);
			$pdo->bindValue(':pH', $this->getPh(), PDO::PARAM_STR);
			$pdo->bindValue(':fosforo', $this->getFosforo(), PDO::PARAM_STR);
			$pdo->bindValue(':potassio', $this->getPotassio(), PDO::PARAM_STR);
			$pdo->bindValue(':calcio', $this->getCalcio(), PDO::PARAM_STR);
			$pdo->bindValue(':magnesio', $this->getMagnesio(), PDO::PARAM_STR);
			$pdo->bindValue(':aluminio', $this->getAluminio(), PDO::PARAM_STR);
			$pdo->bindValue(':somaBases', $this->getSomaBases(), PDO::PARAM_STR);
			$pdo->bindValue(':acidezPotencial', $this->getAcidezPotencial(), PDO::PARAM_STR);
			$pdo->bindValue(':matOrganica', $this->getMatOrganica(), PDO::PARAM_STR);
			$pdo->bindValue(':prem', $this->getPrem(), PDO::PARAM_STR);
			$pdo->bindValue(':teorArgila', $this->getTeorArgila(), PDO::PARAM_STR);
			$pdo->bindValue(':idProdutor', $this->getIdProdutor(), PDO::PARAM_INT);
			$pdo->bindValue(':idUsuario', $this->getIdUsuario(), PDO::PARAM_INT);
			
			$pdo->execute();
			
			return $database->lastInsertId();
		} catch (PDOException $e) {
			var_dump($e->getMessage());die();
		}
	}

	public function update(){
		$database = Connection::connect();
		$query = "update analise set data=:data, local=:local, profundidade=:profundidade, pH=:pH, fosforo=:fosforo, potassio=:potassio, calcio=:calcio, magnesio=:magnesio, aluminio=:aluminio, somaBases=:somaBases, acidezPotencial=:acidezPotencial, matOrganica=:matOrganica, teorArgila=:teorArgila, prem=:prem, idProdutor=:idProdutor where id=:id";
		try{
			$pdo = $database->prepare($query);

			$pdo->bindValue(':id', $this->getId(), PDO::PARAM_INT);
			$pdo->bindValue(':data', $this->getData(), PDO::PARAM_STR);
			$pdo->bindValue(':local', $this->getLocal(), PDO::PARAM_STR);
			$pdo->bindValue(':profundidade', $this->getProfundidade(), PDO::PARAM_INT);
			$pdo->bindValue(':pH', $this->getPh(), PDO::PARAM_STR);
			$pdo->bindValue(':fosforo', $this->getFosforo(), PDO::PARAM_STR);
			$pdo->bindValue(':potassio', $this->getPotassio(), PDO::PARAM_STR);
			$pdo->bindValue(':calcio', $this->getCalcio(), PDO::PARAM_STR);
			$pdo->bindValue(':magnesio', $this->getMagnesio(), PDO::PARAM_STR);
			$pdo->bindValue(':aluminio', $this->getAluminio(), PDO::PARAM_STR);
			$pdo->bindValue(':somaBases', $this->getSomaBases(), PDO::PARAM_STR);
			$pdo->bindValue(':acidezPotencial', $this->getAcidezPotencial(), PDO::PARAM_STR);
			$pdo->bindValue(':matOrganica', $this->getMatOrganica(), PDO::PARAM_STR);
			$pdo->bindValue(':teorArgila', $this->getTeorArgila(), PDO::PARAM_STR);
			$pdo->bindValue(':prem', $this->getPrem(), PDO::PARAM_STR);
			$pdo->bindValue(':idProdutor', $this->getIdProdutor(), PDO::PARAM_INT);
			$pdo->execute();
			return $pdo->rowCount();
		}catch(PDOException $e){
			var_dump($e->getMessage());
		}
	}

	public static function delete($id){
		$database = Connection::connect();
		$query = "delete from analise where id = :id";
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