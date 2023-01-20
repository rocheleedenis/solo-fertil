<?php session_start();

require_once '../view/ViewAnalise.php';
require_once '../view/ViewApp.php';
require_once '../view/ViewCultura.php';
require_once '../view/ViewUsuario.php';
require_once '../view/ViewProdutor.php';
require_once '../view/ViewProducao.php';
require_once '../models/ModelAnalise.php';
require_once '../models/ModelCultura.php';
require_once '../models/ModelUsuario.php';
require_once '../models/ModelProducao.php';
require_once '../models/ModelProdutor.php';
require_once 'LoginController.php';
require_once '../../_config/config.php';
require_once '../routes/RoutesMapping.php';
require_once '../routes/RouteHandler.php';

class AppController {
	public static function inicio(){
		ViewApp::inicio();
	}

	public function home(){
		ViewAnalise::home();
	}

	public function formLogin(){
		ViewUsuario::formLogin();
	}
	// opicional
	public function preencherAnalise(){
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

	public function cadastrarUser(){
        if((strlen(filter_input(INPUT_POST, 'nSenha')) >= 6) && (strlen(filter_input(INPUT_POST, 'nSenha')) <= 10)){
            $usuario = new Usuario(
                null,
                filter_input(INPUT_POST, 'nNome'),
                filter_input(INPUT_POST, 'nEmail'),
                sha1(filter_input(INPUT_POST, 'nSenha'))
            );
            $x = $usuario->insert();
            if($x > 0){
                LoginController::iniciarSessao();
                ViewAnalise::home();
            }else{
                ViewApp::mensagem('Não foi possível cadastrar usuário.', "Cadastrar usuário", 4);
            }
        }else{
            ViewApp::mensagem('<p>Não foi possível cadastrar usuário.<p><p>Senha muito grande ou muito curta.</p>', "Cadastrar usuário", 4);
        }
	}

	public function logar(){
		if(LoginController::iniciarSessao()){
    		self::home();
	    }else{
	    	ViewApp::loginIncorreto();
	    }
	}

	public function sair(){
		LoginController::terminaSessao();
		self::inicio();
	}

	public function interpretacaoResult(){
        $pdf = (filter_input(INPUT_GET, 'p') == 1);
		if (!isset($_SESSION['sf']['analise'])) {
			ViewApp::mensagem("Você precisa memorizar alguma análise primeiro!", "Interpretação de análise de solo", 3);
		}else{
            $analise = unserialize($_SESSION['sf']['analise']);
			$r = $analise->interpretacao();
            if(!empty($analise->getId())){
                $r['produtor'] = $analise->selectOne($analise->getId());
            }
			ViewAnalise::interpretacaoResult($r, $pdf);
		}
	}

	public function formAdubacao(){
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

	public function sugerirAdubacao(){
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

    public function formSugestaoCultura(){
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

    public function sugerirCultura(){
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

    public function formSelecionarInfo(){
    	$culturas = Cultura::selectAll();
    	ViewCultura::formSelecionarInfo($culturas);
    }

	public function infoCultura(){
        $pdf = filter_input(INPUT_GET, 'p');
        if(!$pdf){
        	$cultura = new Cultura();
        	$cultura->selectOne(filter_input(INPUT_GET, 'id'));
            $_SESSION['sf']['cultura'] = serialize($cultura);
        }else{
        	$cultura = unserialize($_SESSION['sf']['cultura']);
        }
        ViewCultura::infoCultura($cultura, $pdf);
    }

    public function formCadastroAnalise(){
    	if (isset($_SESSION['sf']['analise'])){
    		$analise = unserialize($_SESSION['sf']['analise']);
    	}else{
    		$analise = new Analise();
    	}
    	$produtores = Produtor::selectAll($_SESSION['sf']['userId']);
        ViewAnalise::formCadastroAnalise($analise, $produtores);
    }

    public function cadastrarAnalise(){
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

    public function selecionarAnalise(){
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

    public function salvarAnalise(){
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

    public function editarAnalise(){
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

    public function formCadastroProdutor(){
        ViewProdutor::formCadastroProdutor();
    }

    public function cadastrarProdutor(){
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

    public function selecionarProdutor(){
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

    public function editarProdutor(){
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

    public function salvarProdutor(){
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

    public function formCadastroProducao(){
        $produtores = Produtor::selectAll($_SESSION['sf']['userId']);
        if(empty($produtores)){
            ViewApp::mensagem("Você precisa cadastrar pelo menos um produtor primeiro!", "Cadastrar produção", 3);
        }else{
            $culturas = Cultura::selectAll();
        ViewProducao::formCadastroProducao($produtores, $culturas);
        }
    }

    public function cadastrarProducao(){
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
        // echo "<pre>";
        // print_r($producao);
        // echo "</pre>";die();
    	if($producao->insert()){
    		ViewApp::mensagem("Produção cadastrada com sucesso!", "Cadastro de produção", 1);
    	}else{
    		ViewApp::mensagem("Produção não cadastrada.", "Cadastro de produção", 4);
    	}
    }

    public function selecionarProducao(){
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

    public function consultarProducao(){
        $producao = new Producao();
        $id=filter_input(INPUT_GET, 'id');
        $info = $producao->selectOne($id);
        ViewProducao::consultarProducao($producao, $info);
    }

    public function editarProducao(){
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

    public function salvarProducao(){
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

    public function formProdutividade(){
        $produtores = Produtor::selectAll($_SESSION['sf']['userId']);
        $culturas = Cultura::selectAll();
        ViewProducao::formProdutividade($culturas, $produtores);
    }

    public function produtividade(){
        $producoes = Producao::selectProdutividade($_POST);
        if(empty($producoes)){
            ViewApp::mensagem("Nenhuma produção encontrada.", "Gráficos da produtividade", 3);
        }else{
            ViewProducao::produtividade($producoes);
        }
    }

    public function consultarUsuario(){
        $usuario = new Usuario();
        $usuario->selectOne($_SESSION['sf']['userId']);
        ViewUsuario::consultar($usuario);
    }

    public function editarUsuario(){
        if(isset($_POST['nEditar'])){
            $usuario = new Usuario();
            $usuario->selectOne($_SESSION['sf']['userId']);
            ViewUsuario::editar($usuario);
        }elseif((filter_input(INPUT_GET, 'e') == 1) || (isset($_POST['nExcluir']))){
            if(Usuario::delete($_SESSION['sf']['userId'])) {
                ViewApp::inicio();
                LoginController::terminaSessao();
            }else{
                ViewApp::mensagem("Não foi possível excluir conta.", "Excluir conta", 4);
            }
        }
    }

    public function salvarUsuario(){
        $usuario = new Usuario($_SESSION['sf']['userId'], filter_input(INPUT_POST, 'nNome'), filter_input(INPUT_POST, 'nEmail'), sha1(filter_input(INPUT_POST, 'nSenha')));
        if ($usuario->update()) {
            ViewApp::mensagem("Dados alterados com sucesso!", "Editar conta", 1);
        }else{
            ViewApp::mensagem("Não foi possível alterar os dados.", "Editar conta", 4);
        }
    }

    public function ajuda(){
        ViewApp::ajudaUsuario();
    }
}

$handler = new RouteHandler();
$handler->handleRouting();
