<?php

class Connection
{
	const DATABASE_CONFIG_PATH = '../../_config/db.ini';

	/**
	 * @return PDO
	 */
	public static function connect()
	{
		$connection = self::createConnection();

		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $connection->exec('SET NAMES utf8');

		return $connection;
	}

	/**
	 * @return PDO
	 */
	private static function createConnection()
	{
		$config = self::getConfig();

		try {
			return new PDO(
				"{$config['driver']}:host={$config['host']};dbname={$config['database']}",
				$config['username'],
				$config['password']
			);
		} catch (PDOException $e) {
			throw new \Exception("Erro ao conectar ao banco de dados.", 500);
		}
	}

	/**
	 * @return array
	 */
	private function getconfig()
	{
		return parse_ini_file(self::DATABASE_CONFIG_PATH);
	}
}