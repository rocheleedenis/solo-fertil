<?php

require_once '../../_connection/Connection.php';
require_once "../specials/SpecialProdutor.php";

class FarmerDao extends SpecialProdutor
{
    /**
     * @param int $id
     *
     * @return array
     */
    public static function selectAll($id)
    {
        $query = "select id, nome, fazenda from produtor where idUsuario = :id order by nome asc";

        try{
            $pdo = self::prepareQuery($query);

            $pdo->bindValue(':id', $id, PDO::PARAM_STR);

            $pdo->execute();

            return $pdo->fetchAll();
        } catch (PDOException $e) {
            throw new \Exception('Erro ao buscar informações de usuário.', 500);
        }
    }

    /**
     * @return int
     */
    public function insert()
    {
        $query = "insert into produtor values (default, :nome, :fazenda, :logradouro, :bairro, :area, :cidade, :telefone, :celular, :idUsuario)";

        try {
            $database = Connection::connect();
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
            throw new \Exception('Erro ao buscar informações de usuário.', 500);
        }
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function selectOne($id)
    {
        $query = "select id, nome, fazenda, logradouro, bairro, area, cidade, telefone, celular from produtor where id = :id";

        try {
            $pdo = self::prepareQuery($query);

            $pdo->bindValue(':id', $id, PDO::PARAM_INT);

            if ($pdo->execute()) {
                $data = $pdo->fetch();

                $this->setId($data['id']);
                $this->setNome($data['nome']);
                $this->setFazenda($data['fazenda']);
                $this->setLogradouro($data['logradouro']);
                $this->setBairro($data['bairro']);
                $this->setArea($data['area']);
                $this->setCidade($data['cidade']);
                $this->setTelefone($data['telefone']);
                $this->setCelular($data['celular']);
            } else {
                echo "Não foi possível recuperar dados";
            }
        } catch (PDOException $e) {
            throw new \Exception('Erro ao buscar informações de usuário.', 500);
        }
    }

    /**
     * @return int
     */
    public function update()
    {
        $query = "update produtor set nome = :nome, fazenda=:fazenda, logradouro = :logradouro, bairro = :bairro, area = :area, cidade = :cidade, telefone = :telefone, celular = :celular where id = :id";

        try {
            $pdo = self::prepareQuery($query);

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
			throw new \Exception('Erro ao atualizar informações.', 500);
        }
    }

    /**
	 * @param int $id
	 *
	 * @return int
	 */
    public static function delete($id)
    {
        $query = "delete from produtor where id = :id";

        try {
            $pdo = self::prepareQuery($query);

            $pdo->bindValue(':id', $id, PDO::PARAM_INT);

            $pdo->execute();

            return $pdo->rowCount();
        } catch (PDOException $e) {
            throw new \Exception('Erro ao remover informações.', 500);
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