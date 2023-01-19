<?php

    require_once '../../_connection/Connection.php';
    require_once '../specials/SpecialCultura.php';
    require_once '../models/ModelAdubacaoMineral.php';
    require_once '../models/ModelParcelamentoAdubNPK.php';

class CultivationDao extends SpecialCultura{

	public static function selectAll(){
		$database = Connection::connect();
		$query = "select id, nome, familia from cultura order by nome asc";

		try{
			$pdo = $database->prepare($query);
			$pdo->execute();
			return $pdo->fetchAll();
		}catch(PDOException $e){
			var_dump($e->getMessage());
		}
	}

	public static function selectSucessao($id){
		$database = Connection::connect();
		$query = "select cultura.id, nome, disponibNutriente, p2o5soloArgiloso, p2o5soloMedio, p2o5soloArenoso,
			k2o, nitrogenio from cultura, adubacaoMineral where
			cultura.id = adubacaoMineral.idCultura and familia <> (select familia from cultura where id = :id);";
		try {
			$pdo = $database->prepare($query);
			$pdo->bindParam(":id", $id, PDO::PARAM_INT);

			$pdo->execute();
			$oi = $pdo->fetchAll();

			foreach ($oi as $key => $value) {
				$a = $key;
				if(((++$a)%4 == 1)){
					$p=0;
					$cult = $key;
					$cult = (++$cult)/4;
					$cult = (int)$cult;
					$aux[$cult]['id']= $value['id'];
					$aux[$cult]['nome']= $value['nome'];
					$aux[$cult]['adubacao'][$p]['disponibNutriente'] = $value['disponibNutriente'];
					$aux[$cult]['adubacao'][$p]['p2o5soloArgiloso'] = $value['p2o5soloArgiloso'];
					$aux[$cult]['adubacao'][$p]['p2o5soloMedio'] = $value['p2o5soloMedio'];
					$aux[$cult]['adubacao'][$p]['p2o5soloArenoso'] = $value['p2o5soloArenoso'];
					$aux[$cult]['adubacao'][$p]['k2o'] = $value['k2o'];
					$aux[$cult]['adubacao'][$p]['nitrogenio'] = $value['nitrogenio'];
					unset($oi[$key]);
					$p++;
					$ei=0;
				}else{
					$aux[$cult]['adubacao'][$p]['disponibNutriente'] = $value['disponibNutriente'];
					$aux[$cult]['adubacao'][$p]['p2o5soloArgiloso'] = $value['p2o5soloArgiloso'];
					$aux[$cult]['adubacao'][$p]['p2o5soloMedio'] = $value['p2o5soloMedio'];
					$aux[$cult]['adubacao'][$p]['p2o5soloArenoso'] = $value['p2o5soloArenoso'];
					$aux[$cult]['adubacao'][$p]['k2o'] = $value['k2o'];
					$aux[$cult]['adubacao'][$p]['nitrogenio'] = $value['nitrogenio'];
					unset($oi[$key]);
					$p++;
				}
			}
			unset($oi);
			return $aux;
		} catch (PDOException $e) {
			var_dump($e->getMessage());
		}
	}

	public function selectOne($id){
		$database = Connection::connect();
		$query = "select * from cultura where id = :id";
		try{
			$pdo = $database->prepare($query);
			$pdo->bindParam(":id", $id, PDO::PARAM_INT);
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
			}else{
				echo "Não foi possivel recuperar dados. Verificar erro.";
			}
		}catch(PDOException $e){
			var_dump($e->getMessage());
		}
	}
}