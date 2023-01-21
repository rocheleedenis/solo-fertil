<?php

class FarmProductionController
{
    /**
     * @return void
     */
    public static function create()
    {
        $produtores = Produtor::selectAll($_SESSION['sf']['userId']);
        if (empty($produtores)) {
            ViewApp::mensagem("Você precisa cadastrar pelo menos um produtor primeiro!", "Cadastrar produção", 3);
        } else {
            $culturas = Cultura::selectAll();
            ViewProducao::formCadastroProducao($produtores, $culturas);
        }
    }

    /**
     * @return void
     */
    public static function store()
    {
        $producao = new Producao(
            null,
    		$_SESSION['sf']['userId'],
    		filter_input(INPUT_POST, 'nCultura'),
            Config::dateToUSA(filter_input(INPUT_POST, 'nData')),
            filter_input(INPUT_POST, 'nAreaPlantada'),
    		filter_input(INPUT_POST, 'nUnidadeArea'),
    		filter_input(INPUT_POST, 'nProducao'),
    		filter_input(INPUT_POST, 'nUnidade'),
            Config::preco(filter_input(INPUT_POST, 'nPvenda')),
    		filter_input(INPUT_POST, 'nQtdVendida'),
            filter_input(INPUT_POST, 'nQtdAdubo'),
            Config::preco(filter_input(INPUT_POST, 'nPadubo')),
            Config::preco(filter_input(INPUT_POST, 'nGastosNPK')),
    		filter_input(INPUT_POST, 'nQtdCalcario'),
            Config::preco(filter_input(INPUT_POST, 'nPcalcario')),
            filter_input(INPUT_POST, 'nProdutor')
    	);

    	if($producao->insert()){
    		ViewApp::mensagem("Produção cadastrada com sucesso!", "Cadastro de produção", 1);
    	}else{
    		ViewApp::mensagem("Produção não cadastrada.", "Cadastro de produção", 4);
    	}
    }

    /**
     * @return void
     */
    public static function index()
    {
        if(empty($_POST)){
            $culturas = Cultura::selectAll();
            $produtores = Produtor::selectAll($_SESSION['sf']['userId']);
            ViewProducao::buscarProducao($culturas, $produtores);
        }else{
            if($producoes = Producao::selectBusca($_POST)){
                ViewProducao::selecionarProducao($producoes);
            }else{
                ViewApp::mensagem("Nenhuma produção encontrada na busca.", "Consultar produção", 2);
            }
        }
    }

    /**
     * @return void
     */
    public static function show()
    {
        $producao = new Producao();
        $id=filter_input(INPUT_GET, 'id');
        $info = $producao->selectOne($id);
        ViewProducao::consultarProducao($producao, $info);
    }

    /**
     * @return void
     */
    public static function edit()
    {
        if(isset($_POST['nEditar'])){
            $id=filter_input(INPUT_GET, 'id');
            $producao = new Producao();
            $producao->selectOne($id);
            $culturas = Cultura::selectAll();
            $produtores = Produtor::selectAll($_SESSION['sf']['userId']);
            ViewProducao::editarProducao($producao, $culturas, $produtores);
        }elseif((filter_input(INPUT_GET, 'e') == 1) || (isset($_POST['nExcluir']))){
            if(Producao::delete(filter_input(INPUT_GET, 'id'))){
                ViewApp::mensagem("Produção excluida com sucesso!", "Excluir produção", 1);
            }else{
                ViewApp::mensagem("Não foi possível excluir a produção.", "Excluir produção", 4);
            }
        }
    }

    /**
     * @return void
     */
    public static function update()
    {
        $producao = new Producao(
            filter_input(INPUT_POST, 'nId'),
            $_SESSION['sf']['userId'],
            filter_input(INPUT_POST, 'nCultura'),
            Config::dateToUSA(filter_input(INPUT_POST, 'nData')),
            filter_input(INPUT_POST, 'nAreaPlantada'),
            filter_input(INPUT_POST, 'nUnidadeArea'),
            filter_input(INPUT_POST, 'nProducao'),
            filter_input(INPUT_POST, 'nUnidade'),
            Config::preco(filter_input(INPUT_POST, 'nPvenda')),
            filter_input(INPUT_POST, 'nQtdVendida'),
            filter_input(INPUT_POST, 'nQtdAdubo'),
            Config::preco(filter_input(INPUT_POST, 'nPadubo')),
            Config::preco(filter_input(INPUT_POST, 'nGastosNPK')),
            filter_input(INPUT_POST, 'nQtdCalcario'),
            Config::preco(filter_input(INPUT_POST, 'nPcalcario')),
            filter_input(INPUT_POST, 'nProdutor')
        );
        if($producao->update()){
            ViewApp::mensagem('Dados alterados com sucesso!', "Editar produção", 1);
        }else{
            ViewApp::mensagem('Dados não foram alterados.', "Editar produção", 4);
        }
    }
}
