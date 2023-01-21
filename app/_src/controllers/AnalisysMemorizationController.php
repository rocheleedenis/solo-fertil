<?php

class AnalisysMemorizationController
{
    /**
     * @return void
     */
    public static function create()
    {
		ViewAnalise::home();
	}

	/**
     * @return void
     */
	public function show()
    {
        if( ( ($_POST['nPrem'] != '') && ($_POST['nPrem'] > 0) ) || ( ($_POST['nArgila'] != '') && ($_POST['nArgila'] > 0) ) ){
            $analise = new Analise(null, null,null,null,
    			filter_input(INPUT_POST, 'nPH'),
    			filter_input(INPUT_POST, 'nFosforo'),
    			filter_input(INPUT_POST, 'nPotassio'),
    			filter_input(INPUT_POST, 'nCalcio'),
    			filter_input(INPUT_POST, 'nMagnesio'),
    			filter_input(INPUT_POST, 'nAluminio'),
    			filter_input(INPUT_POST, 'nHAl'),
    			filter_input(INPUT_POST, 'nSB'),
    			filter_input(INPUT_POST, 'nMO'),
    			filter_input(INPUT_POST, 'nPrem'),
    			filter_input(INPUT_POST, 'nArgila'),
                null, null
    			);
            $_SESSION['sf']['analise'] = serialize($analise);
            ViewApp::mensagem("A análise foi armazenada temporariamente! Aproveite todos os nossos recursos!", "Memorizar análise", 1);
        }else{
            ViewApp::mensagem('Você precisa preencher ao menos um destes dois campos: "Arg" e "P-rem".', "Memorizar análise", 4);
        }
	}
}
