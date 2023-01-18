<?php

require_once '../../_connection/Connection.php';
require_once "../specials/SpecialProdutor.php";

class FarmerDao extends SpecialProdutor{
    public static function selectAll($id) {
        $database = Connection::connect();
        $query = "select id, nome, fazenda from produtor where idUsuario = :id order by nome asc";
        try{
            $pdo = $database->prepare($query);
            $pdo->bindValue(':id', $id, PDO::PARAM_STR);
            $pdo->execute();
            return $pdo->fetchAll();
        }catch(PDOException $e){
            var_dump($e->getMessage());
        }
    }

    public function insert(){
        $database = Connection::connect();
        $query = "insert into produtor values (default, :nome, :fazenda, :logradouro, :bairro, :area, :cidade, :telefone, :celular, :idUsuario)";
        try {
            $pdo = $database->prepare($query);
            $pdo->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $pdo->bindValue(':fazenda', $this->getFazenda(), PDO::PARAM_STR);
            $pdo->bindValue(':logradouro', $this->getLogradouro(), PDO::PARAM_STR);
            $pdo->bindValue(':bairro', $this->getBairro(), PDO::PARAM_STR);
            $pdo->bindValue(':area', $this->getArea(), PDO::PARAM_STR);
            $pdo->bindValue(':cidade', $this->getCidade(), PDO::PARAM_STR);
            $pdo->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $pdo->bindValue(':celular', $this->getCelular(), PDO::PARAM_STR);
            $pdo->bindValue(':idUsuario', $this->getIdUsuario(), PDO::PARAM_INT);

            $pdo->execute();
            return $database->lastInsertId();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function selectOne($id){
        $database = Connection::connect();
        $query = "select id, nome, fazenda, logradouro, bairro, area, cidade, telefone, celular from produtor where id = :id";
        try {
            $pdo = $database->prepare($query);
            $pdo->bindValue(':id', $id, PDO::PARAM_INT);
            if($pdo->execute()){
                ;
                $oi = $pdo->fetch();
                $this->setId($oi['id']);
                $this->setNome($oi['nome']);
                $this->setFazenda($oi['fazenda']);
                $this->setLogradouro($oi['logradouro']);
                $this->setBairro($oi['bairro']);
                $this->setArea($oi['area']);
                $this->setCidade($oi['cidade']);
                $this->setTelefone($oi['telefone']);
                $this->setCelular($oi['celular']);
            }else{
                echo "Não foi possível recuperar dados";
            }
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function update(){
        $database = Connection::connect();
        $query = "update produtor set nome = :nome, fazenda=:fazenda, logradouro = :logradouro, bairro = :bairro, area = :area, cidade = :cidade, telefone = :telefone, celular = :celular where id = :id";
        try {
            $pdo = $database->prepare($query);
            $pdo->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $pdo->bindValue(':fazenda', $this->getFazenda(), PDO::PARAM_STR);
            $pdo->bindValue(':logradouro', $this->getLogradouro(), PDO::PARAM_STR);
            $pdo->bindValue(':bairro', $this->getBairro(), PDO::PARAM_STR);
            $pdo->bindValue(':area', $this->getArea(), PDO::PARAM_STR);
            $pdo->bindValue(':cidade', $this->getCidade(), PDO::PARAM_STR);
            $pdo->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_INT);
            $pdo->bindValue(':celular', $this->getCelular(), PDO::PARAM_INT);
            $pdo->bindValue(':id', $this->getId(), PDO::PARAM_INT);
            $pdo->execute();
            return $pdo->rowCount();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public static function delete($id){
        $database = Connection::connect();
        $query = "delete from produtor where id = :id";
        try {
            $pdo = $database->prepare($query);
            $pdo->bindValue(':id', $id, PDO::PARAM_INT);
            $pdo->execute();
            return $pdo->rowCount();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}