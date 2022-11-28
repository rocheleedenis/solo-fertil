<?php
    
class Connection{
	public static function connect(){
		$iniData = parse_ini_file('../../_config/db.ini');
		try {
			$pdo = new PDO($iniData['driver'].':host='.$iniData['host'].';dbname='.$iniData['database'], $iniData['username'], $iniData['password']);
		} catch (PDOException $e) {
			echo "Erro na conexão com o banco. ".$e;
		}

		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $pdo->exec('SET NAMES utf8');
		return $pdo;
	}
}