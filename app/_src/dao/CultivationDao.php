<?php

require_once '../../_connection/Connection.php';
require_once '../specials/SpecialCultura.php';
require_once '../models/ModelAdubacaoMineral.php';
require_once '../models/ModelParcelamentoAdubNPK.php';

class CultivationDao extends SpecialCultura
{
	/**
	 * @return array
	 */
	public static function selectAll()
	{
		$query = 'select id, nome, familia from cultura order by nome asc';

		try {
			$pdo = Connection::prepareQuery($query);

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
	public static function selectSucessao($id)
	{
		$query = 'select cultura.id, nome, disponibNutriente, p2o5soloArgiloso, p2o5soloMedio, p2o5soloArenoso,
			k2o, nitrogenio from cultura, adubacaoMineral where
			cultura.id = adubacaoMineral.idCultura and familia <> (select familia from cultura where id = :id);';

		try {
			$pdo = Connection::prepareQuery($query);

			$pdo->bindParam(':id', $id, PDO::PARAM_INT);

			$pdo->execute();

			$data = $pdo->fetchAll();

			return self::formatData($data);
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.select'), 500);
		}
	}

	/**
	 * @param int $id
	 *
	 * @return void
	 */
	public function selectOne($id)
	{
		$query = 'select * from cultura where id = :id';

		try {
			$pdo = Connection::prepareQuery($query);

			$pdo->bindParam(':id', $id, PDO::PARAM_INT);

			if ($pdo->execute()){
				$oi = $pdo->fetch();

				$this->setId($oi['id']);
				$this->setNome($oi['nome']);
				$this->setFamilia($oi['familia']);
				$this->setSaturacaoAl($oi['saturacaoAl']);
				$this->setIndiceX($oi['indiceX']);
				$this->setSaturacaoBases($oi['saturacaoBases']);
				$this->setProducaoEsperada($oi['producaoEsperada']);
				$this->setEspacamento($oi['espacamento']);
				$this->setCalagem($oi['calagem']);
				$this->setAdubOrganica($oi['adubacaoOrg']);
				$this->setObservacoes($oi['observacoes']);
				$this->setParcelamentoNPK($oi['parcelamentoNPK']);
				$this->setObsQuadroNPK($oi['obsQuadroNPK']);

				$this->setAdubMineralTable(AdubacaoMineral::select($this->getId()));

				$this->setParcNPKtable(ParcelamentoAdubNPK::select($this->getId()));
			} else {
				echo 'Não foi possivel recuperar dados. Verificar erro.';
			}
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.select'), 500);
		}
	}

	/**
	 * @param array $data
	 *
	 * @return array
	 */
	private function formatData($data)
	{
		$aux = [];
		$a = null;
		$position = 0;
		$cult = 0;

		foreach ($data as $index => $cultivation) {
			$a = $index;

			if ((++$a) % 4 == 1) {
				$position = 0;
				$cult = $index;
				$cult = (++$cult) / 4;
				$cult = (int) $cult;
				$aux[$cult]['id'] = $cultivation['id'];
				$aux[$cult]['nome'] = $cultivation['nome'];
			}

			$aux[$cult]['adubacao'][$position]['disponibNutriente'] = $cultivation['disponibNutriente'];
			$aux[$cult]['adubacao'][$position]['p2o5soloArgiloso'] = $cultivation['p2o5soloArgiloso'];
			$aux[$cult]['adubacao'][$position]['p2o5soloMedio'] = $cultivation['p2o5soloMedio'];
			$aux[$cult]['adubacao'][$position]['p2o5soloArenoso'] = $cultivation['p2o5soloArenoso'];
			$aux[$cult]['adubacao'][$position]['k2o'] = $cultivation['k2o'];
			$aux[$cult]['adubacao'][$position]['nitrogenio'] = $cultivation['nitrogenio'];

			$position++;
		}

		return $aux;
	}
}