<?php

class SoilChemicalAnalysisController
{
    /**
     * @return void
     */
    public static function create()
    {
    	if (isset($_SESSION['sf']['analise'])){
    		$analise = unserialize($_SESSION['sf']['analise']);
    	}else{
    		$analise = new Analise();
    	}
    	$produtores = Produtor::selectAll($_SESSION['sf']['userId']);
        ViewAnalise::formCadastroAnalise($analise, $produtores);
    }

    /**
     * @return void
     */
    public static function store()
    {
        if( ( ($_POST['nPrem'] != '') && ($_POST['nPrem'] > 0) ) || ( ($_POST['nArgila'] != '') && ($_POST['nArgila'] > 0) ) ){
            $analise = new Analise(
    			null,
    			Config::dateToUSA(filter_input(INPUT_POST, 'nData')),
                filter_input(INPUT_POST, 'nLocal'),
                filter_input(INPUT_POST, 'nProfundidade'),
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
    			null,
    			null,
    			$_SESSION['sf']['userId']
    		);
            if (!filter_input(INPUT_POST, 'nIdProdutor')) {
                $produtor = new Produtor(null,
                    filter_input(INPUT_POST, 'nNome'),
                    filter_input(INPUT_POST, 'nFazenda'),
                    filter_input(INPUT_POST, 'nLogradouro'),
                    filter_input(INPUT_POST, 'nBairro'),
                    filter_input(INPUT_POST, 'nArea'),
                    filter_input(INPUT_POST, 'nCidade'),
                    Config::telefone(filter_input(INPUT_POST, 'nTelefone')),
                    Config::telefone(filter_input(INPUT_POST, 'nCelular')),
                    $_SESSION['sf']['userId']
                );
                $analise->setIdProdutor($produtor->insert());
            }else{
                $analise->setIdProdutor(filter_input(INPUT_POST, 'nIdProdutor'));
            }
            $x = $analise->insert();
            if($x>0){
                $analise->setId($x);
                $_SESSION['sf']['analise'] = serialize($analise);
                ViewApp::mensagem('Análise cadastrada com sucesso!', "Cadastrar análise", 1);
            }else{
                ViewApp::mensagem('Análise não pode ser cadastrada.', "Cadastrar análise", 4);
            }
        }else{
            ViewApp::mensagem('Análise não pode ser cadastrada. É preciso preencher pelo menos Arg ou P-rem e todos os demais campos.', "Cadastrar análise", 4);
        }
    }

    /**
     * @return void
     */
    public static function index()
    {
    	if(!filter_input(INPUT_GET, 'id')){
    		$analises = Analise::selectAll($_SESSION['sf']['userId']);
    		if(empty($analises)){
    			ViewApp::mensagem("Nenhuma análise cadastrada", "Consultar análise", 2);
    		}else{
    			ViewAnalise::selecionarAnalise($analises);
    		}
    	}else{
    		$analise = new Analise();
    		$produtor = $analise->selectOne(filter_input(INPUT_GET, 'id'));
    		$analise->setIdUsuario($_SESSION['sf']['userId']);
			$_SESSION['sf']['analise'] = serialize($analise);
    		ViewAnalise::consultarAnalise($analise, $produtor, 0);
    	}
    }

    /**
     * @return void
     */
    public static function update()
    {
        if( ( ($_POST['nPrem'] != '') && ($_POST['nPrem'] > 0) ) || ( ($_POST['nArgila'] != '') && ($_POST['nArgila'] > 0) ) ){
            $analise = new Analise(
        		filter_input(INPUT_POST, 'nId'),
                Config::dateToUSA(filter_input(INPUT_POST, 'nData')),
                filter_input(INPUT_POST, 'nLocal'),
    			filter_input(INPUT_POST, 'nProfundidade'),
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
    			filter_input(INPUT_POST, 'nIdProdutor'),
    			$_SESSION['sf']['userId']
    		);
    		if($analise->update()){
    			$_SESSION['sf']['analise'] = serialize($analise);
    			ViewApp::mensagem('Dados alterados com sucesso!', "Editar análise", 1);
    		}else{
    			ViewApp::mensagem('Não foi possível alterar dados.', "Editar análise", 4);
    		}
        }else{
            ViewApp::mensagem('Análise não pode ser cadastrada. É preciso preencher pelo menos Arg ou P-rem e todos os demais campos.', "Cadastrar análise", 4);
        }
    }

    /**
     * @return void
     */
    public static function edit()
    {
        if(isset($_POST['nEditar'])){
            $analise = unserialize($_SESSION['sf']['analise']);
            $produtores = Produtor::selectAll($_SESSION['sf']['userId']);
            ViewAnalise::editarAnalise($analise, $produtores);
        }elseif(filter_input(INPUT_GET, 'p') == 1){
            $analise = new Analise();
            $produtor = $analise->selectOne(filter_input(INPUT_GET, 'id'));
            $analise->setIdUsuario($_SESSION['sf']['userId']);
            $_SESSION['sf']['analise'] = serialize($analise);
            ViewAnalise::consultarAnalise($analise, $produtor, 1);
        }elseif( (filter_input(INPUT_GET, 'e') == 1) || (isset($_POST['nExcluir'])) ){
            if(Analise::delete(filter_input(INPUT_GET, 'id'))){
                ViewApp::mensagem("Analise excluida com sucesso!", "Excluir análise", 1);
            }else{
                ViewApp::mensagem("Não foi possível excluir a análise.", "Excluir análise", 4);
            }
        }
    }
}
