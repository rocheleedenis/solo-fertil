<?php
    class SpecialProdutor{
        private $id;
        private $nome;
        private $fazenda;
        private $logradouro;
        private $bairro;
        private $area;
        private $cidade;
        private $telefone;
        private $celular;
        private $idUsuario;

        public function __construct($id=null,$no=null, $fa=null, $lo=null, $ba=null, $ar=null, $ci=null, $te=null, $ce=null, $idU=null){
            $this->setId($id);
            $this->setIdUsuario($idU);
            $this->setNome($no);
            $this->setFazenda($fa);
            $this->setLogradouro($lo);
            $this->setBairro($ba);
            $this->setArea($ar);
            $this->setCidade($ci);
            $this->setTelefone($te);
            $this->setCelular($ce);
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

        public function getFazenda(){
            return $this->fazenda;
        }
        
        public function setFazenda($fazenda){
            $this->fazenda = $fazenda;
        }
        
        public function getLogradouro(){
            return $this->logradouro;
        }

        public function setLogradouro($logradouro){
            $this->logradouro = $logradouro;
        }

        public function getBairro(){
            return $this->bairro;
        }

        public function setBairro($bairro){
            $this->bairro = $bairro;
        }

        public function getArea(){
            return $this->area;
        }

        public function setArea($area){
            $this->area = $area;
        }

        public function getCidade(){
            return $this->cidade;
        }

        public function setCidade($cidade){
            $this->cidade = $cidade;
        }

        public function getTelefone(){
            return $this->telefone;
        }

        public function setTelefone($telefone){
            $this->telefone = $telefone;
        }

        public function getCelular(){
            return $this->celular;
        }

        public function setCelular($celular){
            $this->celular = $celular;
        }

        public function getIdUsuario(){
            return $this->idUsuario;
        }
        
        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }
        
    }