<?php

require_once '../Helpers/Auth.php';
require_once '../controllers/UserController.php';
require_once '../controllers/HelpController.php';
require_once '../controllers/FarmerController.php';
require_once '../controllers/FarmProductionController.php';
require_once '../controllers/CultivationController.php';
require_once '../controllers/PlantingProductivityController.php';

class RouteHandler
{
    private $actionPath;
    public function handleRouting()
    {
        $app = new AppController();

        if (Auth::isLoggedIn()) {
            return $this->getResponse($app);
        }

        if ($this->getActionPath() == RoutesMapping::LOGIN) {
            return LoginController::logar();
        }

        if ($this->getActionPath() == RoutesMapping::CADASTRARUSER) {
            return UserController::store();
        }

        return $app->inicio();
    }

    /**
     * @return int
     */
    private function getActionPath()
    {
        if ($this->actionPath) {
            return $this->actionPath;
        }

        $hash = filter_input(INPUT_GET, 'a');

        if (!$hash) {
            $this->actionPath = RoutesMapping::HOME;

            return $this->actionPath;
        }

        $this->actionPath = base64_decode($hash);

        return $this->actionPath;
    }

    /**
     * @param AppController $app
     *
     * @return void
     */
    private function getResponse($app)
    {
        switch ($this->getActionPath()) {
            case RoutesMapping::INTERPRETACAORESULT:
                return $app->interpretacaoResult();
            case RoutesMapping::SUGERIRADUBACAO:
                return $app->formAdubacao();
            case RoutesMapping::SUGERIRADUBACAORESULT:
                return $app->sugerirAdubacao();
            case RoutesMapping::SUGERIRCULTURA:
                return $app->formSugestaoCultura();
            case RoutesMapping::SUGERIRCULTURARESULT:
                return $app->sugerirCultura();
            case RoutesMapping::PREENCHERANALISE:
                return $app->preencherAnalise();
            case RoutesMapping::INFORMACOES:
                return CultivationController::index();
            case RoutesMapping::INFORMACOESRESULT:
                return CultivationController::show();
            case RoutesMapping::FORMCADASTROANALISE:
                return $app->formCadastroAnalise();
            case RoutesMapping::CADASTRARANALISE:
                return $app->cadastrarAnalise();
            case RoutesMapping::SELECIONARANALISE:
                return $app->selecionarAnalise();
            case RoutesMapping::EDITARANALISE:
                return $app->editarAnalise();
            case RoutesMapping::SALVARANALISE:
                return $app->salvarAnalise();
            case RoutesMapping::FORMCADASTRARPRODUTOR:
                return FarmerController::create();
            case RoutesMapping::CADASTRARPRODUTOR:
                return FarmerController::store();
            case RoutesMapping::SELECIONARPRODUTOR:
                return FarmerController::index();
            case RoutesMapping::EDITARPRODUTOR:
                return FarmerController::edit();
            case RoutesMapping::SALVARPRODUTOR:
                return FarmerController::update();
            case RoutesMapping::FORMCADASTRARPRODUCAO:
                return FarmProductionController::create();
            case RoutesMapping::CADASTRARPRODUCAO:
                return FarmProductionController::store();
            case RoutesMapping::SELECIONARPRODUCAO:
                return FarmProductionController::index();
            case RoutesMapping::CONSULTARPRODUCAO:
                return FarmProductionController::show();
            case RoutesMapping::EDITARPRODUCAO:
                return FarmProductionController::edit();
            case RoutesMapping::SALVARPRODUCAO:
                return FarmProductionController::update();
            case RoutesMapping::FORMPRODUTIVIDADE:
                return PlantingProductivityController::index();
            case RoutesMapping::PRODUTIVIDADE:
                return PlantingProductivityController::show();
            case RoutesMapping::CONSULTARUSUARIO:
                return UserController::show();
            case RoutesMapping::EDITARUSUARIO:
                return UserController::edit();
            case RoutesMapping::SALVARUSUARIO:
                return UserController::update();
            case RoutesMapping::AJUDA:
                return HelpController::show();
            case RoutesMapping::HOME:
                return $app->home();
            case RoutesMapping::FORMLOGIN:
                return LoginController::formLogin();
            case RoutesMapping::LOGIN:
                return LoginController::logar();
            case RoutesMapping::LOGOFF:
                return LoginController::sair();
            case RoutesMapping::CADASTRARUSER:
                return UserController::store();
            default:
                echo '<h2>Opss... Página não encontrada.</h2>';
        }
    }
}
