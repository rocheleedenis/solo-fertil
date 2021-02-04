<?php 

class SpecialUsuario{
	
	private $id;
	private $nome;
	private $senha;
	private $email;

	function __construct($id=null, $no=null, $em=null, $se=null){
		$this->setId($id);
		$this->setNome($no);
		$this->setSenha($se);
		$this->setEmail($em);		
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
	
	public function getSenha(){
	    return $this->senha;
	}
	
	public function setSenha($senha){
	    $this->senha = $senha;
	}
	
	public function getEmail(){
	    return $this->email;
	}
	
	public function setEmail($email){
	    $this->email = $email;
	}
	
}