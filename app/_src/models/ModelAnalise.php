<?php

require_once '../dao/SoilChemicalAnalysisDao.php';
require_once '../interfaces/Ianalise.php';

class Analise extends SoilChemicalAnalysisDao implements Ianalise{

	public function interpretacao(){
		$r['tipoSolo'] = $this->classificaSolo();
		$r['ph'] = $this->classificaPH();
		$r['fosforo'] = $this->classificaFosforoPrem();
		$r['potassio'] = $this->classificaPotassio();
		$r['calcio'] = $this->classificaCalcio();
		$r['magnesio'] = $this->classificaMagnesio();
		$r['aluminio'] = $this->classificaAluminio();
		$r['SB'] = $this->classificaSomaBases();
		$r['ctcEfetiva'] = $this->classificaCtcEfetiva();
		$r['HAl'] = $this->classificaAcidezPotencial();
		$r['ctcPH7'] = $this->classificaCtcPH7();
		$r['V'] = $this->classificaSaturacaoBases();
		$r['M'] = $this->classificaSaturacaoAl();
		$r['MO'] = $this->classificaMatOrganica();

		return $r;
	}

	public function classificaSolo(){
		$a = (-0.000257);
		$b = 0.06532;
		$c = 0.0302-$this->getIndiceY();
		$delta = ($b * $b) - (4 * $a * $c);
		if ($delta >= 0) {
			$arg1 = (-$b+sqrt($delta))/(2 * $a);
			$arg2 = (-$b-sqrt($delta))/(2 * $a);
			if(($arg1 >=0 && $arg1 <= 100) || ($arg2 >=0 && $arg2 <= 100)){
				if    ($arg1 <=15){	$tipo = "Arenoso"; }
				elseif($arg1 <=35){	$tipo = "Textura média"; }
				elseif($arg1 <=60){	$tipo = "Argiloso"; }
				else{ $tipo = "Muito argiloso";	}
			}else{
				$tipo = "Indefinido";
			}
		}else{
			$tipo = "Indefinido";
		}
		return $tipo;
	}

	public function classificaPH(){
		if 	   ($this->getPh() < 4.5) $c = 1;
		elseif ($this->getPh() <= 5.4) $c = 2;
		elseif ($this->getPh() <= 6) $c = 3;
		elseif ($this->getPh() <= 7) $c = 4;
		elseif ($this->getPh() > 7) $c = 5;

		return $c;
	}

	public function classificaFosforoPrem(){
		if ($this->getPrem() < 4) {
			if 	   ($this->getFosforo() <= 3) $c = 1;
			elseif ($this->getFosforo() <= 4.3) $c = 2;
			elseif ($this->getFosforo() <= 6) $c = 3;
			elseif ($this->getFosforo() <= 9) $c = 4;
			elseif ($this->getFosforo() > 9) $c = 5;
		}elseif ($this->getPrem() < 10) {
			if 	   ($this->getFosforo() <= 4) $c = 1;
			elseif ($this->getFosforo() <= 6) $c = 2;
			elseif ($this->getFosforo() <= 8.3) $c = 3;
			elseif ($this->getFosforo() <= 12.5) $c = 4;
			elseif ($this->getFosforo() > 12.5) $c = 5;
		}elseif ($this->getPrem() < 19) {
			if 	   ($this->getFosforo() <= 6) $c = 1;
			elseif ($this->getFosforo() <= 8.3) $c = 2;
			elseif ($this->getFosforo() <= 11.4) $c = 3;
			elseif ($this->getFosforo() <= 17.5) $c = 4;
			elseif ($this->getFosforo() > 17.5) $c = 5;
		}elseif ($this->getPrem() < 30) {
			if 	   ($this->getFosforo() <= 8) $c = 1;
			elseif ($this->getFosforo() <= 11.4) $c = 2;
			elseif ($this->getFosforo() <= 15.8) $c = 3;
			elseif ($this->getFosforo() <= 24) $c = 4;
			elseif ($this->getFosforo() > 24) $c = 5;
		}elseif ($this->getPrem() > 44) {
			if 	   ($this->getFosforo() <= 11) $c = 1;
			elseif ($this->getFosforo() <= 15.8) $c = 2;
			elseif ($this->getFosforo() <= 21.8) $c = 3;
			elseif ($this->getFosforo() <= 33) $c = 4;
			elseif ($this->getFosforo() > 33) $c = 5;
		}elseif ($this->getPrem() > 60) {
			if 	   ($this->getFosforo() <= 15) $c = 1;
			elseif ($this->getFosforo() <= 21.8) $c = 2;
			elseif ($this->getFosforo() <= 30) $c = 3;
			elseif ($this->getFosforo() <= 45) $c = 4;
			elseif ($this->getFosforo() > 45) $c = 5;
		}
		return $c;
	}

	public function classificaFosforoArg(){
		if ($this->getTeorArgila() <= 15) {
			if 	   ($this->getFosforo() <= 10) $c = 1;
			elseif ($this->getFosforo() <= 20) $c = 2;
			elseif ($this->getFosforo() <= 30) $c = 3;
			elseif ($this->getFosforo() <= 45) $c = 4;
			elseif ($this->getFosforo() > 45) $c = 5;
		}elseif ($this->getTeorArgila() <= 35) {
			if 	   ($this->getFosforo() <= 6.6) $c = 1;
			elseif ($this->getFosforo() <= 12) $c = 2;
			elseif ($this->getFosforo() <= 20) $c = 3;
			elseif ($this->getFosforo() <= 30) $c = 4;
			elseif ($this->getFosforo() > 30) $c = 5;
		}elseif ($this->getTeorArgila() <= 60) {
			if 	   ($this->getFosforo() <= 4) $c = 1;
			elseif ($this->getFosforo() <= 8) $c = 2;
			elseif ($this->getFosforo() <= 12) $c = 3;
			elseif ($this->getFosforo() <= 18) $c = 4;
			elseif ($this->getFosforo() > 18) $c = 5;
		}elseif ($this->getTeorArgila() <= 100) {
			if 	   ($this->getFosforo() <= 2.7) $c = 1;
			elseif ($this->getFosforo() <= 5.4) $c = 2;
			elseif ($this->getFosforo() <= 8) $c = 3;
			elseif ($this->getFosforo() <= 12) $c = 4;
			elseif ($this->getFosforo() > 12) $c = 5;
		}
		return $c;
	}

	public function classificaPotassio(){
		if 	   ($this->getPotassio() <= 15) $c = 1;
		elseif ($this->getPotassio() <= 40) $c = 2;
		elseif ($this->getPotassio() <= 70) $c = 3;
		elseif ($this->getPotassio() <= 120) $c = 4;
		elseif ($this->getPotassio() > 120) $c = 5;

		return $c;
	}

	public function classificaCalcio(){
		if 	   ($this->getCalcio() <= 0.4) $c = 1;
		elseif ($this->getCalcio() <= 1.2) $c = 2;
		elseif ($this->getCalcio() <= 2.4) $c = 3;
		elseif ($this->getCalcio() <= 4) $c = 4;
		elseif ($this->getCalcio() > 4) $c = 5;

		return $c;
	}

	public function classificaMagnesio(){
		if 	   ($this->getMagnesio() <= 0.15) $c = 1;
		elseif ($this->getMagnesio() <= 0.45) $c = 2;
		elseif ($this->getMagnesio() <= 0.9) $c = 3;
		elseif ($this->getMagnesio() <= 1.5) $c = 4;
		elseif ($this->getMagnesio() > 1.5) $c = 5;

		return $c;
	}

	public function classificaAluminio(){
		if 	   ($this->getAluminio() <= 0.2) $c = 1;
		elseif ($this->getAluminio() <= 0.5) $c = 2;
		elseif ($this->getAluminio() <= 1) $c = 3;
		elseif ($this->getAluminio() <= 2) $c = 4;
		elseif ($this->getAluminio() > 2) $c = 5;

		return $c;
	}

	public function classificaAcidezPotencial(){
		if 	   ($this->getAcidezPotencial() <= 1) $c = 1;
		elseif ($this->getAcidezPotencial() <= 2.5) $c = 2;
		elseif ($this->getAcidezPotencial() <= 5) $c = 3;
		elseif ($this->getAcidezPotencial() <= 9) $c = 4;
		elseif ($this->getAcidezPotencial() > 9) $c = 5;

		return $c;
	}

	public function classificaSomaBases(){
		if 	   ($this->getSomaBases() <= 0.6) $c = 1;
		elseif ($this->getSomaBases() <= 1.8) $c = 2;
		elseif ($this->getSomaBases() <= 3.6) $c = 3;
		elseif ($this->getSomaBases() <= 6) $c = 4;
		elseif ($this->getSomaBases() > 6) $c = 5;

		return $c;
	}

	public function classificaCtcEfetiva(){
		if 	   ($this->getCtcEfetiva() <= 0.8) $c = 1;
		elseif ($this->getCtcEfetiva() <= 2.3) $c = 2;
		elseif ($this->getCtcEfetiva() <= 4.6) $c = 3;
		elseif ($this->getCtcEfetiva() <= 8) $c = 4;
		elseif ($this->getCtcEfetiva() > 8) $c = 5;

		return $c;
	}

	public function classificaCtcPH7(){
		if 	   ($this->getCtcPH7() <= 1.6) $c = 1;
		elseif ($this->getCtcPH7() <= 4.3) $c = 2;
		elseif ($this->getCtcPH7() <= 8.6) $c = 3;
		elseif ($this->getCtcPH7() <= 15) $c = 4;
		elseif ($this->getCtcPH7() > 15) $c = 5;

		return $c;
	}

	public function classificaSaturacaoBases(){
		if ($this->getSaturacaoBases() <= 20 ) $c = 1;
		elseif($this->getSaturacaoBases() <= 40) $c = 2;
		elseif($this->getSaturacaoBases() <= 60) $c = 3;
		elseif($this->getSaturacaoBases() <= 80) $c = 4;
		elseif($this->getSaturacaoBases() > 80 ) $c = 5;

		return $c;
	}

	public function classificaSaturacaoAl(){
		if ($this->getSaturacaoAl() <= 15 ) $c = 1;
		elseif($this->getSaturacaoAl() <= 30) $c = 2;
		elseif($this->getSaturacaoAl() <= 50) $c = 3;
		elseif($this->getSaturacaoAl() <= 75) $c = 4;
		elseif($this->getSaturacaoAl() > 75 ) $c = 5;

		return $c;
	}

	public function classificaMatOrganica(){
		if ($this->getMatOrganica() <= 0.7) $c = 1;
		elseif ($this->getMatOrganica() <= 2) $c = 2;
		elseif ($this->getMatOrganica() <= 4) $c = 3;
		elseif ($this->getMatOrganica() <= 7) $c = 4;
		elseif ($this->getMatOrganica() > 7) $c = 5;

		return $c;
	}
}