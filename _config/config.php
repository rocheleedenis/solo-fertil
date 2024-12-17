<?php 

class Config{
	
	public static function dateToUSA($data){
		$data = explode('/', $data);
		return $data[2].'-'.$data[1].'-'.$data[0];
	}

	public static function dateToBr($data){
		$data = explode('-', $data);
		return $data[2].'/'.$data[1].'/'.$data[0];
	}

	public static function telefone($telefone){
		$chars = array("(", ")", "-", " ");
        return str_replace($chars, "", $telefone);
	}

	public static function preco($preco){
		$preco = str_replace(",", ".", $preco);
        return str_replace("R$ ", "", $preco);
	}

// driver = 'mysql'
// host = 'mysql.hostinger.com.br'
// database = 'u256996856_sofe'
// username = 'u256996856_root'
// password = '654321'
}