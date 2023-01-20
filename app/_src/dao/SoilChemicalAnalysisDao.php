<?php

require_once '../../_connection/Connection.php';
require_once '../specials/SpecialAnalise.php';

class SoilChemicalAnalysisDao extends SpecialAnalise
{
	/**
	 * @param int $idU
	 *
	 * @return array
	 */
	public static function selectAll($idU)
	{
		$query = "select a.id, a.data, a.local, p.fazenda, p.nome from analise as a join produtor as p on p.id = a.idProdutor and a.idUsuario = :idU";

		try {
			$pdo = self::prepareQuery($query);

			$pdo->bindParam(":idU", $idU, PDO::PARAM_INT);

			$pdo->execute();

			return $pdo->fetchAll();
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.select'), 500);
		}
	}

	/**
	 * @param int $id
	 *
	 * @return array
	 */
	public function selectOne($id)
	{
		$query = "select a.*, p.nome, p.fazenda from analise as a join produtor as p on p.id = a.idProdutor and a.id = :id";

		try {
			$pdo = self::prepareQuery($query);

			$pdo->bindParam(":id", $id, PDO::PARAM_INT);

			$pdo->execute();

			$data = $pdo->fetch();

			if (!empty($data)) {
				$this->setId($data['id']);
				$this->setData(Config::dateToBr($data['data']));
				$this->setLocal($data['local']);
				$this->setProfundidade($data['profundidade']);
				$this->setPh($data['pH']);
				$this->setFosforo($data['fosforo']);
				$this->setPotassio($data['potassio']);
				$this->setCalcio($data['calcio']);
				$this->setMagnesio($data['magnesio']);
				$this->setAluminio($data['aluminio']);
				$this->setAcidezPotencial($data['acidezPotencial']);
				$this->setSomaBases($data['somaBases']);
				$this->setMatOrganica($data['matOrganica']);

				if ($data['teorArgila']) {
					$this->setTeorArgila($data['teorArgila']);
					$this->setIndiceY();
					$this->setPrem($data['prem']);
				} else {
					$this->setPrem($data['prem']);
					$this->setIndiceY();
					$this->setTeorArgila($data['teorArgila']);
				}

				$this->setIdProdutor($data['idProdutor']);
				$this->setIdUsuario($_SESSION['sf']['userId']);
				$this->setCtcEfetiva();
				$this->setCtcPH7();
				$this->setSaturacaoBases();
				$this->setSaturacaoAl();

				return array(
					'nome' =>$data['nome'],
					'fazenda' => $data['fazenda']
				);
			}
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.select'), 500);
		}
	}

	/**
	 * @return int
	 */
	public function insert()
	{
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
			throw new \Exception(Translator::get('exceptions.query_execution.save'), 500);
		}
	}

	/**
	 * @return int
	 */
	public function update()
	{
		$query = "update analise set data=:data, local=:local, profundidade=:profundidade, pH=:pH, fosforo=:fosforo, potassio=:potassio, calcio=:calcio, magnesio=:magnesio, aluminio=:aluminio, somaBases=:somaBases, acidezPotencial=:acidezPotencial, matOrganica=:matOrganica, teorArgila=:teorArgila, prem=:prem, idProdutor=:idProdutor where id=:id";

		try {
			$pdo = self::prepareQuery($query);

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
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.save'), 500);
		}
	}

	/**
	 * @param int $id
	 *
	 * @return int
	 */
	public static function delete($id)
	{
		$query = "delete from analise where id = :id";

		try {
			$pdo = self::prepareQuery($query);

			$pdo->bindParam(':id', $id, PDO::PARAM_INT);

			$pdo->execute();

			return $pdo->rowCount();
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.delete'), 500);
		}
	}

	/**
	 * @param string $query
	 *
	 * @return PDOStatement
	 */
	private function prepareQuery($query)
	{
		$connection = Connection::connect();

		return $connection->prepare($query);
	}
}