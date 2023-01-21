<?php

class FarmerController
{
    /**
     * @return void
     */
    public static function create()
    {
        ViewProdutor::formCadastroProdutor();
    }

    /**
     * @return void
     */
    public static function store()
    {
        $produtor = new Produtor(
    		null,
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
    	if($produtor->insert()){
    		ViewApp::mensagem("Produtor cadastrado com sucesso!", "Cadastrar produtor", 1);
    	}else{
    		ViewApp::mensagem("Produtor não cadastrado.", "Cadastrar produtor", 4);
    	}
    }

    /**
     * @return void
     */
    public static function index()
    {
    	if(!filter_input(INPUT_GET, 'id')){
    		$produtores = Produtor::selectAll($_SESSION['sf']['userId']);
    		if(empty($produtores)){
                ViewApp::mensagem("Nenhum produtor encontrado!", "Selecionar produtor", 2);
            }else{
                ViewProdutor::selecionarProdutor($produtores);
            }
    	}else{
    		$produtor = new Produtor();
    		$produtor->selectOne(filter_input(INPUT_GET, 'id'));
    		ViewProdutor::consultarProdutor($produtor);
		}
    }

    /**
     * @return void
     */
    public static function edit()
    {
        if(isset($_POST['nEditar'])){
            $produtor = new Produtor();
            $produtor->selectOne(filter_input(INPUT_GET, 'id'));
            ViewProdutor::editarProdutor($produtor);
        }elseif((filter_input(INPUT_GET, 'e') == 1) || (isset($_POST['nExcluir']))){
            if(Produtor::delete(filter_input(INPUT_GET, 'id'))) {
                ViewApp::mensagem("Produtor excluido com sucesso!", "Excluir produtor", 1);
            }else{
                ViewApp::mensagem("Não foi possível excluir o Produtor.", "Excluir produtor", 4);
            }
        }
    }

    /**
     * @return void
     */
    public static function update()
    {
    	$produtor = new Produtor(
    		filter_input(INPUT_GET, 'id'),
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
    	if($produtor->update()>0){
			ViewApp::mensagem('Dados alterados!', "Editar produtor", 1);
    	}else{
            ViewApp::mensagem('Dados não foram alterados.', "Editar produtor", 4);
    	}
    }
}
