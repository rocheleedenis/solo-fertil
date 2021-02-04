<?php 

class SpecialProducao{
	
	private $id;
	private $idUsuario;
	private $idCultura;
	private $data;
	private $areaPlantada;
	private $unidadeArea;
	private $producao;
	private $unidade;
	private $precoVenda;
	private $qtdVendida;
	private $qtdAduboOrganico;
	private $precoAduboOrganico;
	private $gastosNPK;
	private $qtdCalcario;
	private $precoCalcario;
	private $idProdutor;

	function __construct($id=null, $idU=null, $idC=null, $data=null, $aP=null, $unA=null, $pro=null, $un=null, $pV=null, $qV=null, $qA=null, $pA=null, $g=null, $qC=null, $pC=null, $iP=null){
		$this->setId($id);
		$this->setIdUsuario($idU);
		$this->setIdCultura($idC);
		$this->setData($data);
		$this->setAreaPlantada($aP);
		$this->setUnidadeArea($unA);
		$this->setProducao($pro);
		$this->setUnidade($un);
		$this->setPrecoVenda($pV);
		$this->setQtdVendida($qV);
		$this->setPrecoAduboOrganico($pA);
		$this->setQtdAduboOrganico($qA);
		$this->setGastosNPK($g);
		$this->setQtdCalcario($qC);
		$this->setPrecoCalcario($pC);
		$this->setIdProdutor($iP);
	}

	public function getId(){
	    return $this->id;
	}
	
	public function setId($id){
	    $this->id = $id;
	}
	
	public function getIdUsuario(){
	    return $this->idUsuario;
	}
	
	public function setIdUsuario($idUsuario){
	    $this->idUsuario = $idUsuario;
	}
	
	public function getIdCultura(){
	    return $this->idCultura;
	}
	
	public function setIdCultura($idCultura){
	    $this->idCultura = $idCultura;
	}
	
	public function getData(){
	    return $this->data;
	}
	
	public function setData($data){
	    $this->data = $data;
	}
	
	public function getAreaPlantada(){
	    return $this->areaPlantada;
	}
	
	public function setAreaPlantada($areaPlantada){
	    $this->areaPlantada = str_replace(',', '.', $areaPlantada);
	}
	
	public function getUnidadeArea(){
	    return $this->unidadeArea;
	}
	
	public function setUnidadeArea($unidadeArea){
	    $this->unidadeArea = $unidadeArea;
	}
	
	public function getProducao(){
	    return $this->producao;
	}
	
	public function setProducao($producao){
	    $this->producao = str_replace(',', '.', $producao);
	}

	public function getUnidade(){
	    return $this->unidade;
	}
	
	public function setUnidade($unidade){
	    $this->unidade = $unidade;
	}
	
	public function getPrecoVenda(){
	    return $this->precoVenda;
	}
	
	public function setPrecoVenda($precoVenda){
	    $this->precoVenda = str_replace(',', '.', $precoVenda);
	}
	
	public function getQtdVendida(){
	    return $this->qtdVendida;
	}
	
	public function setQtdVendida($qtdVendida){
	    $this->qtdVendida = str_replace(',', '.', $qtdVendida);
	}
	
	public function getQtdAduboOrganico(){
	    return $this->qtdAduboOrganico;
	}
	
	public function setQtdAduboOrganico($qtdAduboOrganico){
	    $this->qtdAduboOrganico = str_replace(',', '.', $qtdAduboOrganico);
	}
	
	public function getPrecoAduboOrganico(){
	    return $this->precoAduboOrganico;
	}
	
	public function setPrecoAduboOrganico($precoAduboOrganico){
	    $this->precoAduboOrganico = str_replace(',', '.', $precoAduboOrganico);
	}
	
	public function getGastosNPK(){
	    return $this->gastosNPK;
	}
	
	public function setGastosNPK($gastosNPK){
	    $this->gastosNPK = str_replace(',', '.', $gastosNPK);
	}

	public function getQtdCalcario(){
	    return $this->qtdCalcario;
	}
	
	public function setQtdCalcario($qtdCalcario){
	    $this->qtdCalcario = str_replace(',', '.', $qtdCalcario);
	}
	
	public function getPrecoCalcario(){
	    return $this->precoCalcario;
	}
	
	public function setPrecoCalcario($precoCalcario){
	    $this->precoCalcario = str_replace(',', '.', $precoCalcario);
	}
	
	public function getIdProdutor(){
	    return $this->idProdutor;
	}
	
	public function setIdProdutor($idProdutor){
	    $this->idProdutor = $idProdutor;
	}
}