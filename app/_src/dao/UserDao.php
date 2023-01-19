<?php

require_once '../../_connection/Connection.php';
require_once '../specials/SpecialUsuario.php';
require_once '../lang/Translator.php';

class UserDao extends SpecialUsuario
{
	/**
	 * @param int $id
	 *
	 * @return void
	 */
	public function selectOne($id)
	{
		$query = 'select id, nome, email from usuario where id = :id';

		try {
			$pdo = self::prepareQuery($query);

			$pdo->bindParam(':id', $id, PDO::PARAM_STR);

			$pdo->execute();

			$data = $pdo->fetch();

			if (!empty($data)) {
				$this->setId($data['id']);
				$this->setNome($data['nome']);
				$this->setEmail($data['email']);
			} else {
				echo Translator::get('errors.query_execution.not_found');
			}
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.select'), 500);
		}
	}

	/**
	 * @param string $email
	 * @param string $senha
	 *
	 * @return array|bool
	 */
	public static function selectLogin($email, $senha)
	{
		$query = 'select id, nome, senha, email from usuario where email = :email and senha = :senha';

		try {
			$pdo = self::prepareQuery($query);

			$pdo->bindParam(':email', $email, PDO::PARAM_STR);
			$pdo->bindParam(':senha', $senha, PDO::PARAM_STR);

			$pdo->execute();

			return $pdo->fetch();
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.select'), 500);
		}
	}

	/**
	 * @return int
	 */
	public function insert()
	{
		$query = 'insert into usuario values (default, :nome, :senha, :email)';

		try {
			$pdo = self::prepareQuery($query);

			$pdo->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
			$pdo->bindValue(':senha', $this->getSenha(), PDO::PARAM_STR);
			$pdo->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);

			$pdo->execute();

			return $pdo->rowCount();
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.save'), 500);
		}
	}

	/**
	 * @return int
	 */
	public function update()
	{
		$query = 'update usuario set nome=:nome, email=:email, senha=:senha where id=:id';

		try {
			$pdo = self::prepareQuery($query);

			$pdo->bindValue(':id', $this->getId(), PDO::PARAM_INT);
			$pdo->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
			$pdo->bindValue(':senha', $this->getSenha(), PDO::PARAM_STR);
			$pdo->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);

			$pdo->execute();

			return $pdo->rowCount();
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.save'), 500);
		}
	}

	/**
	 * @param int $id
	 *
	 * @return int
	 */
	public static function delete($id)
	{
		$query = 'delete from usuario where id = :id';

		try {
			$pdo = self::prepareQuery($query);

			$pdo->bindParam(':id', $id, PDO::PARAM_INT);

			$pdo->execute();

			return $pdo->rowCount();
		} catch (PDOException $e) {
			throw new \Exception(Translator::get('exceptions.query_execution.delete'), 500);
		}
	}

	/**
	 * @param string $query
	 *
	 * @return PDOStatement
	 */
	private function prepareQuery($query)
	{
		$connection = Connection::connect();

		return $connection->prepare($query);
	}
}