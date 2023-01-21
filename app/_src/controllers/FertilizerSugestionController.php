<?php

class FertilizerSugestionController
{
    /**
     * @return void
     */
    public function create()
    {
		if (!isset($_SESSION['sf']['analise'])) {
            ViewApp::mensagem("Você precisa memorizar alguma análise primeiro!", "Sugestão de adubação", 3);
		}else{
			$todas = Cultura::selectAll();
			if (empty($todas)) {
				ViewApp::mensagem("Falha ao buscar culturas no banco de dados.", '', 4);
			}else{
				ViewCultura::formAdubacao($todas);
			}
		}
	}

    /**
     * @return void
     */
	public function show()
    {
        $pdf = (filter_input(INPUT_GET, 'p') == 1);
		$analise = unserialize($_SESSION['sf']['analise']);
		if(!$pdf){
			$cultura = new Cultura();
        	$cultura->selectOne(filter_input(INPUT_GET, 'id'));
        	$_SESSION['sf']['cultura'] = serialize($cultura);
            $_SESSION['sf']['adubo']=null;
        }else{
            $cultura = unserialize($_SESSION['sf']['cultura']);
            if(filter_input(INPUT_POST, 'nSimular') == 1){
            	$_SESSION['sf']['adubo'] = $_POST;
            }elseif (count($_POST)>0) {
            	$_SESSION['sf']['adubo'] = null;
            }
        }
        $adubo = $_SESSION['sf']['adubo'];
        $r = Producao::sugerirAdubacao($analise, $cultura);
        ViewCultura::sugerirAdubacao($r, $cultura, $pdf, $adubo);
    }
}
