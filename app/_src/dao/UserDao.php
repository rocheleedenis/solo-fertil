<?php

    require_once '../../_connection/Connection.php';
    require_once '../specials/SpecialUsuario.php';

class UserDao extends SpecialUsuario{

	public function selectOne($id){
		$database = Connection::connect();
		$query = "select id, nome, email from usuario where id = :id";
		try{
			$pdo = $database->prepare($query);
			$pdo->bindParam(":id", $id, PDO::PARAM_STR);
			$pdo->execute();
			$oi = $pdo->fetch();
			if (!empty($oi)) {
				$this->setId($oi['id']);
				$this->setNome($oi['nome']);
				$this->setEmail($oi['email']);
			}else{
				echo "Não foi possível encontrar os dados.";
			}
		}catch(PDOException $e){
			var_dump($e->getMessage());
		}
	}

	public static function selectLogin($email, $senha){
		$database = Connection::connect();
		$query = "select id, nome, senha, email from usuario where email = :email and senha = :senha";
		try{
			$pdo = $database->prepare($query);
			$pdo->bindParam(":email", $email, PDO::PARAM_STR);
			$pdo->bindParam(":senha", $senha, PDO::PARAM_STR);
			$pdo->execute();
			$oi = $pdo->fetch();
			return $oi;
		}catch(PDOException $e){
			var_dump($e->getMessage());
		}
	}

	public function insert(){
		$database = Connection::connect();
		$query = "insert into usuario values (default, :nome, :senha, :email)";
		try {
			$pdo = $database->prepare($query);
			$pdo->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
			$pdo->bindValue(':senha', $this->getSenha(), PDO::PARAM_STR);
			$pdo->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);

			$pdo->execute();
			unset($database);
			return $pdo->rowCount();
		} catch (PDOException $e) {
			var_dump($e->getMessage());
		}
	}

	public function update(){
		$database = Connection::connect();
		$query = "update usuario set nome=:nome, email=:email, senha=:senha where id=:id";
		try{
			$pdo = $database->prepare($query);
			$pdo->bindValue(':id', $this->getId(), PDO::PARAM_INT);
			$pdo->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
			$pdo->bindValue(':senha', $this->getSenha(), PDO::PARAM_STR);
			$pdo->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
			$pdo->execute();
			return $pdo->rowCount();
		}catch(PDOException $e){
			var_dump($e->getMessage());
		}
	}

	public static function delete($id){
		$database = Connection::connect();
		$query = "delete from usuario where id = :id";
		try {
			$pdo = $database->prepare($query);
			$pdo->bindParam(':id', $id, PDO::PARAM_INT);
			$pdo->execute();
			return $pdo->rowCount();
		} catch (PDOException $e) {
			var_dump($e->getMessage());
		}
	}
}