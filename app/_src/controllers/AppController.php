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
	public static function home(){
		ViewAnalise::home();
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
}

$handler = new RouteHandler();
$handler->handleRouting();
