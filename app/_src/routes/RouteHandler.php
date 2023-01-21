<?php

require_once '../Helpers/Auth.php';
require_once '../controllers/UserController.php';

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
                return $app->formSelecionarInfo();
            case RoutesMapping::INFORMACOESRESULT:
                return $app->infoCultura();
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
                return $app->formCadastroProdutor();
            case RoutesMapping::CADASTRARPRODUTOR:
                return $app->cadastrarProdutor();
            case RoutesMapping::SELECIONARPRODUTOR:
                return $app->selecionarProdutor();
            case RoutesMapping::EDITARPRODUTOR:
                return $app->editarProdutor();
            case RoutesMapping::SALVARPRODUTOR:
                return $app->salvarProdutor();
            case RoutesMapping::FORMCADASTRARPRODUCAO:
                return $app->formCadastroProducao();
            case RoutesMapping::CADASTRARPRODUCAO:
                return $app->cadastrarProducao();
            case RoutesMapping::SELECIONARPRODUCAO:
                return $app->selecionarProducao();
            case RoutesMapping::CONSULTARPRODUCAO:
                return $app->consultarProducao();
            case RoutesMapping::EDITARPRODUCAO:
                return $app->editarProducao();
            case RoutesMapping::SALVARPRODUCAO:
                return $app->salvarProducao();
            case RoutesMapping::FORMPRODUTIVIDADE:
                return $app->formProdutividade();
            case RoutesMapping::PRODUTIVIDADE:
                return $app->produtividade();
            case RoutesMapping::CONSULTARUSUARIO:
                return UserController::show();
            case RoutesMapping::EDITARUSUARIO:
                return UserController::edit();
            case RoutesMapping::SALVARUSUARIO:
                return UserController::update();
            case RoutesMapping::AJUDA:
                return $app->ajuda();
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
