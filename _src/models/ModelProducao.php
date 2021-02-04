<?php

require_once "../dao/DaoProducao.php";
require_once "../interfaces/Iproducao.php";

class Producao extends DaoProducao implements Iproducao{

	public static function sugerirAdubacao($analise, $cultura){
		$r['calagemAl'] = self::calagemNeutAluminio($analise, $cultura);
		$r['calagemBas'] = self::calagemSatBases($analise, $cultura);
        $r['solo'] = $analise->classificaSolo();
        $r['disponibFosforo'] = $analise->classificaFosforoPrem();
        $r['disponibPotassio'] = $analise->classificaPotassio();
        $r['qtdeP2O5'] = self::calculaP2O5($analise, $cultura->getAdubMineralTable());
        $r['qtdeK2O'] = self::calculaK2O($analise, $cultura->getAdubMineralTable());
        $r['qtdeN'] = self::calculaNitrogenio($cultura->getAdubMineralTable());
        $r['formulacao'] = str_replace('.', ',', self::formulacao($analise, $cultura->getAdubMineralTable()));
        return $r;
	}

	public static function sugerirCultura($analise, $info){
		$culturas = Cultura::selectSucessao($info['idCultura']);
        foreach ($culturas as $key => $value) {
	        $r['qtdeP2O5'] = self::calculaP2O5($analise, $value['adubacao']);
	    	$r['qtdeK2O'] = self::calculaK2O($analise, $value['adubacao']);
	    	$r['qtdeN'] = self::calculaNitrogenio($value['adubacao']);
	    	// a linha abaixo mostra com detalhes o que veio do banco
        	// $culturas[$key]['adubacao'][4] = $r;
        	unset($culturas[$key]['adubacao']);
        	$culturas[$key]['adubacao'] = $r;
        }
    	$cultOrdenadas = self::quickSort($culturas,0,count($culturas)-1, $info['nutri1']);
		$cultOrdenadas = self::insertionSort($cultOrdenadas, $info['nutri1'], $info['nutri2']);
		$cultOrdenadas = self::insertionSort2($cultOrdenadas, $info['nutri1'], $info['nutri2'], $info['nutri3']);
		// retorna as 10 primeiras culturas
		$cont = count($cultOrdenadas);
		for ($i=$cont; $i >= 10; $i--) {
			unset($cultOrdenadas[$i]);
		}
		return $cultOrdenadas;
	}

	public static function partition(&$culturas,$leftIndex,$rightIndex, $nutri1){
	    $pivot=$culturas[($leftIndex+$rightIndex)/2];

	    while ($leftIndex <= $rightIndex) {
	        while ($culturas[$leftIndex]['adubacao'][$nutri1] < $pivot['adubacao'][$nutri1]) {
	            $leftIndex++;
	        }

	        while ($culturas[$rightIndex]['adubacao'][$nutri1] > $pivot['adubacao'][$nutri1]){
	        	$rightIndex--;
	        }

	        if ($leftIndex <= $rightIndex) {
                $tmp = $culturas[$leftIndex];
                $culturas[$leftIndex] = $culturas[$rightIndex];
                $culturas[$rightIndex] = $tmp;
                $leftIndex++;
                $rightIndex--;
	        }
	    }
	    return $leftIndex;
	}

	public static function quickSort(&$culturas, $leftIndex, $rightIndex, $nutri1){
	    $index = self::partition($culturas,$leftIndex,$rightIndex, $nutri1);
	    if ($leftIndex < $index - 1)
	        self::quickSort($culturas, $leftIndex, $index - 1, $nutri1);
	    if ($index < $rightIndex)
	        self::quickSort($culturas, $index, $rightIndex, $nutri1);
	   	return $culturas;
	}

	public static function insertionSort($array, $nutri1, $nutri2) {
        $length=count($array);
        for ($i=1;$i<$length;$i++) {
            $element=$array[$i];
            $j=$i;
            while($j>0 && $array[$j-1]['adubacao'][$nutri1]==$element['adubacao'][$nutri1] && $array[$j-1]['adubacao'][$nutri2]>$element['adubacao'][$nutri2]) {
                $array[$j]=$array[$j-1];
                $j=$j-1;
            }
            $array[$j]=$element;
        }
        return $array;
    }

    public static function insertionSort2($array, $nutri1, $nutri2, $nutri3) {
        $length=count($array);
        for ($i=1;$i<$length;$i++) {
            $element=$array[$i];
            $j=$i;
            while($j>0 && $array[$j-1]['adubacao'][$nutri1]==$element['adubacao'][$nutri1] && $array[$j-1]['adubacao'][$nutri2] == $element['adubacao'][$nutri2] && $array[$j-1]['adubacao'][$nutri3]>$element['adubacao'][$nutri3]) {
                $array[$j]=$array[$j-1];
                $j=$j-1;
                }
            $array[$j]=$element;
            }
        return $array;
    }

	public static function calculaP2O5($analise, $adubacaoMineral){
		$disponibFosforo = $analise->classificaFosforoPrem();
		if ($disponibFosforo == 1) $disponibFosforo = 2;

		$qtdeP2O5 = null;
		if (($adubacaoMineral[0]['p2o5soloArgiloso'] == null) && ($adubacaoMineral[0]['p2o5soloArenoso'] == null)){
			foreach ($adubacaoMineral as $key => $value){
				if ($disponibFosforo == $value['disponibNutriente']){
					$qtdeP2O5 = $value['p2o5soloMedio'];
				}
			}
		}
		else{
			if ($analise->classificaSolo() == "Argiloso"){
				foreach ($adubacaoMineral as $key => $value){
					if ($disponibFosforo == $value['disponibNutriente']){
						$qtdeP2O5 = $value['p2o5soloArgiloso'];
					}
				}
			}
			elseif ($analise->classificaSolo() == "Textura média"){
				foreach ($adubacaoMineral as $key => $value){
					if ($disponibFosforo == $value['disponibNutriente']){
						$qtdeP2O5 = $value['p2o5soloMedio'];
					}
				}
			}
			elseif ($analise->classificaSolo() == "Arenoso"){
				foreach ($adubacaoMineral as $key => $value){
					if ($disponibFosforo == $value['disponibNutriente']){
						$qtdeP2O5 = $value['p2o5soloArenoso'];
					}
				}
			}
		}
		return $qtdeP2O5;
	}

	public static function calculaK2O($analise, $adubacaoMineral){
		$disponibPotassio = $analise->classificaPotassio();
		if ($disponibPotassio == 1) $disponibPotassio = 2;
		foreach ($adubacaoMineral as $key => $value)
			if ($disponibPotassio == $value['disponibNutriente'])
				$qtdeK2O = $value['k2o'];

		return $qtdeK2O;
	}

	public static function calculaNitrogenio($adubacaoMineral){
		return $qtdeN = $adubacaoMineral[0]['nitrogenio'];
	}

	public static function calagemNeutAluminio($analise, $cultura){
		$ca = $analise->getIndiceY() * ($analise->getAluminio() - $cultura->getSaturacaoAl() * $analise->getCtcEfetiva() / 100);
		$cd = $cultura->getIndiceX() - ($analise->getCalcio() + $analise->getMagnesio());

		if($ca < 0) $ca = 0;
		if ($cd < 0) $cd = 0;
		$nc = $ca + $cd;

		return round($nc, 2);
	}

	public static function calagemSatBases($analise, $cultura){
		$nc = $analise->getCtcPH7() * ($cultura->getSaturacaoBases()-$analise->getSaturacaoBases())/100;
		//A linha abaixo retorna o mesmo valor
		//$nc = ($this->cultura->getSaturacaoBases()/100) * $this->analise->getCtcPH7() - $this->analise->getSomaBases();
		return round($nc, 2);
	}

	public static function formulacao($analise, $adubacaoMineral){
		$p = self::calculaP2O5($analise, $adubacaoMineral);
		$k = self::calculaK2O($analise, $adubacaoMineral);
		$n = self::calculaNitrogenio($adubacaoMineral);

		if (min($p, $k, $n) != 0){
			if ($n <= $p && $n <= $k) {
				$formulacao = '1 : ' . round(($p/$n), 1) . ' : ' . round(($k/$n), 1);
			}
			elseif($p <= $n && $p <= $k){
				$formulacao = round(($n/$p), 1) . ' : 1 : ' . round(($k/$p), 1);
			}
			elseif ($k <= $p && $k <= $n){
				$formulacao = round(($n/$k), 1) . ' : ' . round(($p/$k), 1) . ' : 1';
			}
		}
		else {
			if(max($p, $k, $n) == 0){
				$formulacao = '0 : 0 : 0'; // 0 0 0
			}
			elseif ($n == $p && $p == 0) {
				$formulacao = '0 : 0 : 1'; // 0 0 x
			}
			elseif ($n == $k && $k == 0) {
				$formulacao = '0 : 1 : 0'; // 0 x 0
			}
			elseif ($k == $p && $k == 0) {
				$formulacao = '1 : 0 : 0'; // x 0 0
			}
			elseif ($n == 0 && max($p, $k) == $p) {
				$formulacao = '0 : ' . round(($p/$k), 1) . ' : 1'; // 0 > <
			}
			elseif ($n == 0 && max($p, $k) == $k) {
				$formulacao = '0 : 1 : ' . round(($k/$p), 1); // 0 < >
			}
			elseif ($p == 0 && max($n, $k) == $n) {
				$formulacao = round(($n/$k), 1) . ' : 0 : 1'; // > 0 <
			}
			elseif ($p == 0 && max($n, $k) == $k) {
				$formulacao = '1 : 0 : ' . round(($k/$n), 1); // < 0 >
			}
			elseif ($k == 0 && max($n, $p) == $n) {
				$formulacao = round(($n/$p), 1) . ' : 1 : 0'; // > < 0
			}
			else{
				$formulacao = '1 : ' . round(($p/$n), 1) . ' : 0'; // < > 0
			}
		}
		return $formulacao;
	}
}