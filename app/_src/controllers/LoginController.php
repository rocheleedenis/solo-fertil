<?php

class LoginController
{
    /**
     * @return void
     */
    public static function sair(){
		LoginController::terminaSessao();
		AppController::inicio();
	}

    /**
     * @return void
     */
    public static function logar(){
		if(LoginController::iniciarSessao()){
    		AppController::home();
	    }else{
	    	ViewApp::loginIncorreto();
	    }
	}

    /**
     * @return void
     */
    public static function cadastrarUser(){
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

    /**
     * @return void
     */
    public static function formLogin()
    {
		ViewUsuario::formLogin();
	}

    /**
     * @return bool
     */
    public static function iniciarSessao()
    {
        $request = $_POST;

        $email = isset($request['nEmail']) ? $request['nEmail'] : '';
        $password = sha1((isset($request['nSenha'])) ? $request['nSenha'] : '');

        $user = Usuario::selectLogin($email, $password);

        if (empty($user)) {
            return false;
        }

        if (!isset($_SESSION)){
            session_start();
        }

        $_SESSION['sf']['userId'] = $user['id'];
        $_SESSION['sf']['userNome'] = $user['nome'];

        return true;
    }

    /**
     * @return void
     */
    public static function terminaSessao()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        unset($_SESSION['sf']);
    }
}
