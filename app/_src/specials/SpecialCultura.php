<?php 

class SpecialCultura{
	
	private $id;
	private $nome;
	private $familia;
	private $saturacaoAl;
	private $indiceX;
	private $saturacaoBases;
	private $producaoEsperada;
	private $espacamento;
	private $calagem;
	private $adubOrganica;
	private $observacoes;
	private $parcelamentoNPK;
	private $obsQuadroNPK;
	private $adubMineralTable;
	private $parcNPKtable;
	
	function __construct($id=null, $no=null, $fa=null, $m=null, $x=null, $v=null, $pro=null, $esp=null, $cal=null, $ao=null, $obs=null, $pNPK=null, $obsNPK=null, $am=null, $pNPKtable=null){
		$this->setId($id);
		$this->setNome($no);
		$this->setFamilia($fa);
		$this->setSaturacaoAl($m);
		$this->setIndiceX($x);
		$this->setSaturacaoBases($v);
		$this->setProducaoEsperada($pro);
		$this->setEspacamento($esp);
		$this->setCalagem($cal);
		$this->setAdubOrganica($ao);
		$this->setObservacoes($obs);
		$this->setParcelamentoNPK($pNPK);
		$this->setObsQuadroNPK($obsNPK);
		$this->setAdubMineralTable($am);
		$this->setParcNPKtable($pNPKtable);
	}

	public function getId(){
	    return $this->id;
	}
	
	public function setId($id){
	    $this->id = $id;
	}
	
	public function getNome(){
	    return $this->nome;
	}
	
	public function setNome($nome){
	    $this->nome = $nome;
	}
	
	public function getFamilia(){
	    return $this->familia;
	}

	public function setFamilia($familia){
	    $this->familia = $familia;
	}
	
	public function getSaturacaoAl(){
	    return $this->saturacaoAl;
	}
	
	public function setSaturacaoAl($saturacaoAl){
	    $this->saturacaoAl = $saturacaoAl;
	}
	
	public function getIndiceX(){
	    return $this->indiceX;
	}
	
	public function setIndiceX($indiceX){
	    $this->indiceX = $indiceX;
	}
	
	public function getSaturacaoBases(){
	    return $this->saturacaoBases;
	}
	
	public function setSaturacaoBases($saturacaoBases){
	    $this->saturacaoBases = $saturacaoBases;
	}
	
	public function getProducaoEsperada(){
	    return $this->producaoEsperada;
	}
	
	public function setProducaoEsperada($producaoEsperada){
	    $this->producaoEsperada = $producaoEsperada;
	}
	
	public function getEspacamento(){
	    return $this->espacamento;
	}
	
	public function setEspacamento($espacamento){
	    $this->espacamento = $espacamento;
	}
	
	public function getCalagem(){
	    return $this->calagem;
	}
	
	public function setCalagem($calagem){
	    $this->calagem = $calagem;
	}
	
	public function getAdubOrganica(){
	    return $this->adubOrganica;
	}
	
	public function setAdubOrganica($adubOrganica){
	    $this->adubOrganica = $adubOrganica;
	}
	
	public function getObservacoes(){
	    return $this->observacoes;
	}
	
	public function setObservacoes($observacoes){
	    $this->observacoes = $observacoes;
	}
	
	public function getParcelamentoNPK(){
	    return $this->parcelamentoNPK;
	}
	
	public function setParcelamentoNPK($parcelamentoNPK){
	    $this->parcelamentoNPK = $parcelamentoNPK;
	}
	
	public function getObsQuadroNPK(){
	    return $this->obsQuadroNPK;
	}
	
	public function setObsQuadroNPK($obsQuadroNPK){
	    $this->obsQuadroNPK = $obsQuadroNPK;
	}
	
	// conjunto de objetos
	public function getAdubMineralTable(){
	    return $this->adubMineralTable;
	}
	
	public function setAdubMineralTable($adubMineralTable){
	    $this->adubMineralTable = $adubMineralTable;
	}
	
	public function getParcNPKtable(){
	    return $this->parcNPKtable;
	}
	
	public function setParcNPKtable($parcNPKtable){
	    $this->parcNPKtable = $parcNPKtable;
	}
	
}