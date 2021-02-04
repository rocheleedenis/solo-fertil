<?php 

class SpecialAnalise{
	
	private $id;
	private $data;
	private $local;
	private $profundidade;
	private $ph;
	private $fosforo;
	private $potassio;
	private $calcio;
	private $magnesio;
	private $aluminio;
	private $acidezPotencial;
	private $somaBases;
	private $ctcEfetiva;
	private $ctcPH7;
	private $saturacaoBases;
	private $saturacaoAl;
	private $matOrganica;
	private $prem;
	private $teorArgila;
	private $idProdutor;
	private $indiceY;
	private $idUsuario;

	function __construct($id=null, $dt=null, $local=null, $pr=null, $pH=null, $p=null, $k=null, $ca=null, $mg=null, $al=null, $hal=null, $sb=null, $mo=null, $prem=null, $ta=null, $idp=null, $idU=null){
		$this->setId($id);
		$this->setData($dt);
		$this->setLocal($local);
		$this->setProfundidade($pr);
		$this->setPh($pH);
		$this->setFosforo($p);
		$this->setPotassio($k);
		$this->setCalcio($ca);
		$this->setMagnesio($mg);
		$this->setAluminio($al);
		$this->setAcidezPotencial($hal);
		$this->setSomaBases($sb);
		$this->setMatOrganica($mo);
		$this->setIdProdutor($idp);
		$this->setIdUsuario($idU);
		$this->setPrem($prem);
		if ($ta) {
			$this->setTeorArgila($ta);
			$this->setIndiceY();
		}else{
			$this->setIndiceY();
			$this->setTeorArgila($ta);
		}
		if($this->getSomaBases()){
			$this->setCtcEfetiva();
			$this->setCtcPH7();
			$this->setSaturacaoBases();
			$this->setSaturacaoAl();
		}
	}

	public function getId(){
	    return $this->id;
	}
	
	public function setId($id){
	    $this->id = $id;
	}
	
	public function getData(){
	    return $this->data;
	}
	
	public function setData($data){
		$this->data = $data;
	}
	
	public function getProfundidade(){
	    return $this->profundidade;
	}
	
	public function setProfundidade($profundidade){
	    $this->profundidade = str_replace(',', '.', $profundidade);
	}
	
	public function getPh(){
	    return $this->ph;
	}
	
	public function setPh($ph){
	    $this->ph = str_replace(',', '.', $ph);
	}
	
	public function getFosforo(){
	    return $this->fosforo;
	}
	
	public function setFosforo($fosforo){
	    $this->fosforo = str_replace(',', '.', $fosforo);
	}
	
	public function getPotassio(){
	    return $this->potassio;
	}
	
	public function setPotassio($potassio){
	    $this->potassio = str_replace(',', '.', $potassio);
	}
	
	public function getCalcio(){
	    return $this->calcio;
	}
	
	public function setCalcio($calcio){
	    $this->calcio = str_replace(',', '.', $calcio);
	}
	
	public function getMagnesio(){
	    return $this->magnesio;
	}
	
	public function setMagnesio($magnesio){
	    $this->magnesio = str_replace(',', '.', $magnesio);
	}
	
	public function getAluminio(){
	    return $this->aluminio;
	}
	
	public function setAluminio($aluminio){
	    $this->aluminio = str_replace(',', '.', $aluminio);
	}
	
	public function getAcidezPotencial(){
	    return $this->acidezPotencial;
	}
	
	public function setAcidezPotencial($acidezPotencial){
	    $this->acidezPotencial = str_replace(',', '.', $acidezPotencial);
	}
	
	public function getSomaBases(){
	    return $this->somaBases;
	}
	
	//verficar outras bibliografias
	public function setSomaBases($somaBases){
	    $this->somaBases = str_replace(',', '.', $somaBases);
	}
	
	public function getCtcEfetiva(){
	    return $this->ctcEfetiva;
	}
	
	public function setCtcEfetiva(){
	    $this->ctcEfetiva = round($this->getPotassio()*0.002558+$this->getCalcio()+$this->getMagnesio()+$this->getAluminio(), 2);
	}
	
	public function getCtcPH7(){
	    return $this->ctcPH7;
	}
	
	public function setCtcPH7(){
	    $this->ctcPH7 = round($this->getSomaBases()+$this->getAcidezPotencial(), 2);
	}

	public function getSaturacaoBases(){
	    return $this->saturacaoBases;
	}
	
	public function setSaturacaoBases(){
	    $this->saturacaoBases = round(100*$this->getSomaBases()/$this->getCtcPH7(), 2);
	}
	
	public function getSaturacaoAl(){
	    return $this->saturacaoAl;
	}
	
	public function setSaturacaoAl(){
	    $this->saturacaoAl = round(100*$this->getAluminio()/$this->getCtcEfetiva(), 2);
	}
	
	public function getMatOrganica(){
	    return $this->matOrganica;
	}
	
	public function setMatOrganica($matOrganica){
	    $this->matOrganica = str_replace(',', '.', $matOrganica);
	}
	
	public function getPrem(){
	    return $this->prem;
	}
	
	public function setPrem($prem){
		if(!$prem){
	    	$this->prem = null;
	    }else{
	    	$this->prem = round(str_replace(',', '.', $prem), 2);
	    }
	}
	
	public function getTeorArgila(){
	    return $this->teorArgila;
	}
	
	public function setTeorArgila($teorArgila){
	    if($teorArgila){
	    	$this->teorArgila = $teorArgila;
	    }else{
	    	$a = (-0.000257); 
			$b = 0.06532; 
			$c = 0.0302-$this->getIndiceY();
			$delta = ($b * $b) - (4 * $a * $c);
			if ($delta >= 0) {
				$arg1 = (-$b+sqrt($delta))/(2 * $a);
				$arg2 = (-$b-sqrt($delta))/(2 * $a);
				if($arg1 >=0 && $arg1 <= 100){
					$this->teorArgila = round($arg1, 2);
				}elseif ($arg2 >= 0 && $arg2 <= 100) {
					$this->teorArgila = round($arg2, 2);
				}else{
					$this->teorArgila = -1;
				}
			}else{
				$this->teorArgila = -1;
			}
	    }
	}
	
	public function getLocal(){
	    return $this->local;
	}
	
	public function setLocal($local){
	    $this->local = $local;
	}
	
	public function getIdProdutor(){
	    return $this->idProdutor;
	}
	
	public function setIdProdutor($idProdutor){
	    $this->idProdutor = $idProdutor;
	}
	
	public function getIndiceY(){
	    return $this->indiceY;
	}
	
	public function setIndiceY(){
	    if($this->getPrem()){
	    	$y = 4.002-0.125901*$this->getPrem()+0.001205*pow($this->getPrem(),2) - 0.00000362*pow($this->getPrem(),3);
			$this->indiceY = $y;
	    }else{
	    	$y = 0.0302+0.06532*$this->getTeorArgila()-0.000257*pow($this->getTeorArgila(), 2);
	    	$this->indiceY = $y;
	    }
	}
	
	public function getIdUsuario(){
	    return $this->idUsuario;
	}
	
	public function setIdUsuario($idUsuario){
	    $this->idUsuario = $idUsuario;
	}
	
}