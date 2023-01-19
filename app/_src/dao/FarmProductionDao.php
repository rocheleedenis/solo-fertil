<?php

require_once '../../_connection/Connection.php';
require_once '../specials/SpecialProducao.php';
require_once '../lang/Translator.php';

class FarmProductionDao extends SpecialProducao
{
	/**
	 * @param array $data
	 *
	 * @return array
	 */
	public static function selectBusca($data)
	{
		$query = 'select producao.id, producao.idCultura, producao.`data`, cultura.nome as c_nome, produtor.nome as pr_nome, produtor.fazenda from producao, cultura, produtor where produtor.id = :idP and cultura.id = :idC and cultura.id=producao.idCultura  and produtor.id=producao.idprodutor and `data` between :dataI and :dataF order by `data` asc';

		try {
			$pdo = self::prepareQuery($query);

			$pdo->bindParam(':idP', $data['nProdutor'], PDO::PARAM_INT);
			$pdo->bindParam(':idC', $data['nCultura'], PDO::PARAM_INT);
			$pdo->bindParam(':dataI', Config::dateToUSA($data['nDataI']), PDO::PARAM_STR);
			$pdo->bindParam(':dataF', Config::dateToUSA($data['nDataF']), PDO::PARAM_STR);

			$pdo->execute();

			return $pdo->fetchAll();
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.select'), 500);
		}
	}

	/**
	 * @param array $data
	 *
	 * @return array
	 */
	public static function selectProdutividade($data)
	{
		$query = 'select producao.*, cultura.nome as c_nome, produtor.nome as pr_nome, produtor.fazenda from producao, cultura, produtor where produtor.id = :idP and cultura.id = :idC and cultura.id=producao.idCultura  and produtor.id=producao.idprodutor order by `data` asc';
		try{
			$pdo = self::prepareQuery($query);

			$pdo->bindParam(':idP', $data['nProdutor'], PDO::PARAM_INT);
			$pdo->bindParam(':idC', $data['nCultura'], PDO::PARAM_INT);

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
		$query = 'select producao.*, produtor.nome as pt_nome, cultura.nome as c_nome, produtor.fazenda from producao join cultura join produtor on producao.id = :id and producao.idProdutor = produtor.id and cultura.id = producao.IdCultura';

		try{
			$pdo = self::prepareQuery($query);

			$pdo->bindParam(':id', $id, PDO::PARAM_INT);

			$pdo->execute();

			$data = $pdo->fetch();

			if (!empty($data)) {
				$this->setId($data['id']);
				$this->setIdCultura($data['idCultura']);
				$this->setIdUsuario($data['idUsuario']);
				$this->setData($data['data']);
				$this->setAreaPlantada($data['areaPlantada']);
				$this->setUnidadeArea($data['unidadeArea']);
				$this->setProducao($data['producao']);
				$this->setUnidade($data['unidade']);
				$this->setPrecoVenda($data['precoVenda']);
				$this->setQtdVendida($data['qtdVendida']);
				$this->setQtdAduboOrganico($data['qtdAduboOrganico']);
				$this->setPrecoAduboOrganico($data['precoAduboOrganico']);
				$this->setGastosNPK($data['gastosNPK']);
				$this->setQtdCalcario($data['qtdCalcario']);
				$this->setPrecoCalcario($data['precoCalcario']);
				$this->setIdProdutor($data['idProdutor']);

				return array(
					'cultura' => $data['c_nome'],
					'produtor' => $data['pt_nome'],
					'fazenda' => $data['fazenda']
				);
			} else {
				echo Translator::get('errors.query_execution.not_found');
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
		$query = 'insert into producao values (default, :idUsuario, :idCultura, :data, :areaPlantada, :unidadeArea, :producao, :unidade, :precoVenda, :qtdVendida, :qtdAduboOrganico, :precoAduboOrganico, :gastosNPK, :qtdCalcario, :precoCalcario, :idProdutor)';

		try {
			$pdo = self::prepareQuery($query);

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
			throw new \Exception(Translator::get('exceptions.query_execution.save'), 500);
		}
	}

	/**
	 * @return int
	 */
	public function update()
	{
		$query = 'update producao set idCultura=:idCultura, data=:data, areaPlantada=:areaPlantada, producao=:producao, unidade=:unidade, precoVenda=:precoVenda, qtdVendida=:qtdVendida, gastosNPK=:gastosNPK, qtdAduboOrganico=:qtdAduboOrganico, precoAduboOrganico=:precoAduboOrganico, qtdCalcario=:qtdCalcario, precoCalcario=:precoCalcario, idProdutor=:idProdutor where id=:id';

		try{
			$pdo = self::prepareQuery($query);

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
		$query = 'delete from producao where id=:id';

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