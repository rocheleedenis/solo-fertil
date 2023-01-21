<?php

class CultivationSuggestionController
{
    /**
     * @return void
     */
    public static function index()
    {
    	if (!isset($_SESSION['sf']['analise'])) {
            ViewApp::mensagem("Você precisa memorizar alguma análise primeiro!", "Sugestão para próxima cultura", 3);
		}else{
			$todas = Cultura::selectAll();
			if (empty($todas)) {
				ViewApp::mensagem("Falha ao buscar culturas no banco de dados.", "Sugestão para próxima cultura", 4);
			}else{
				ViewCultura::formSugestaoCultura($todas);
			}
		}
    }

    /**
     * @return void
     */
    public static function show()
    {
    	$pdf = (filter_input(INPUT_GET, 'p') == 1);
        if(!$pdf){
			$info['idCultura'] = filter_input(INPUT_POST, 'nCultura');
        	$info['peso'] = filter_input(INPUT_POST, 'nPeso');
        	$info['p2o5'] = filter_input(INPUT_POST, 'nP2O5');
        	$info['k2o'] = filter_input(INPUT_POST, 'nK2O');
        	$info['n'] = filter_input(INPUT_POST, 'nN');
        	$info['nutri1'] = filter_input(INPUT_POST, 'nNutr1');
        	$info['nutri2'] = filter_input(INPUT_POST, 'nNutr2');
        	$info['nutri3'] = filter_input(INPUT_POST, 'nNutr3');
        	$_SESSION['sf']['info'] = $info;
        }
        $analise = unserialize($_SESSION['sf']['analise']);
        $info = $_SESSION['sf']['info'];
		$r = Producao::sugerirCultura($analise, $info);
        ViewCultura::sugerirCultura($r, $pdf, $info);
    }
}
