<?php

class RouteHandler
{
    private $actionPath;

    public function handleRouting()
    {
        $app = new AppController();

        if (LoginController::verificaLogado()) {
            return $this->getResponse($app);
        }

        if ($this->getActionPath() == RoutesMapping::LOGIN) {
            return $app->logar();
        }

        if ($this->getActionPath() == RoutesMapping::CADASTRARUSER) {
            return $app->cadastrarUser();
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
        }

        $this->actionPath = base64_decode($hash);

        return $this->actionPath;
    }

    private function getResponse($app)
    {
        switch ($this->getActionPath()) {
            case RoutesMapping::INTERPRETACAORESULT:
                $app->interpretacaoResult();
                break;
            case RoutesMapping::SUGERIRADUBACAO:
                $app->formAdubacao();
                break;
            case RoutesMapping::SUGERIRADUBACAORESULT:
                $app->sugerirAdubacao();
                break;
            case RoutesMapping::SUGERIRCULTURA:
                $app->formSugestaoCultura();
                break;
            case RoutesMapping::SUGERIRCULTURARESULT:
                $app->sugerirCultura();
                break;
            case RoutesMapping::PREENCHERANALISE:
                $app->preencherAnalise();
                break;
            case RoutesMapping::INFORMACOES:
                $app->formSelecionarInfo();
                break;
            case RoutesMapping::INFORMACOESRESULT:
                $app->infoCultura();
                break;
            case RoutesMapping::FORMCADASTROANALISE:
                $app->formCadastroAnalise();
                break;
            case RoutesMapping::CADASTRARANALISE:
                $app->cadastrarAnalise();
                break;
            case RoutesMapping::SELECIONARANALISE:
                $app->selecionarAnalise();
                break;
            case RoutesMapping::EDITARANALISE:
                $app->editarAnalise();
                break;
            case RoutesMapping::SALVARANALISE:
                $app->salvarAnalise();
                break;
            case RoutesMapping::FORMCADASTRARPRODUTOR:
                $app->formCadastroProdutor();
                break;
            case RoutesMapping::CADASTRARPRODUTOR:
                $app->cadastrarProdutor();
                break;
            case RoutesMapping::SELECIONARPRODUTOR:
                $app->selecionarProdutor();
                break;
            case RoutesMapping::EDITARPRODUTOR:
                $app->editarProdutor();
                break;
            case RoutesMapping::SALVARPRODUTOR:
                $app->salvarProdutor();
                break;
            case RoutesMapping::FORMCADASTRARPRODUCAO:
                $app->formCadastroProducao();
                break;
            case RoutesMapping::CADASTRARPRODUCAO:
                $app->cadastrarProducao();
                break;
            case RoutesMapping::SELECIONARPRODUCAO:
                $app->selecionarProducao();
                break;
            case RoutesMapping::CONSULTARPRODUCAO:
                $app->consultarProducao();
                break;
            case RoutesMapping::EDITARPRODUCAO:
                $app->editarProducao();
                break;
            case RoutesMapping::SALVARPRODUCAO:
                $app->salvarProducao();
                break;
            case RoutesMapping::FORMPRODUTIVIDADE:
                $app->formProdutividade();
                break;
            case RoutesMapping::PRODUTIVIDADE:
                $app->produtividade();
                break;
            case RoutesMapping::CONSULTARUSUARIO:
                $app->consultarUsuario();
                break;
            case RoutesMapping::EDITARUSUARIO:
                $app->editarUsuario();
                break;
            case RoutesMapping::SALVARUSUARIO:
                $app->salvarUsuario();
                break;
            case RoutesMapping::AJUDA:
                $app->ajuda();
                break;
            // relacionados a login
            case RoutesMapping::HOME:
                $app->home();
                break;
            case RoutesMapping::FORMLOGIN:
                $app->formLogin();
                break;
            case RoutesMapping::LOGIN:
                $app->logar();
                break;
            case RoutesMapping::LOGOFF:
                $app->sair();
                break;
            case RoutesMapping::CADASTRARUSER:
                $app->cadastrarUser();
                break;
            default:
                if(!LoginController::verificaLogado()){
                    $app->inicio();
                }else{
                    $app->home();
                }
                break;

        }
    }
}
