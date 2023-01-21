<?php

class LoginController
{
    // Why my god?
    const MAXIMUM_PASSWORD_LENGTH = 10;
    CONST MINIMUM_PASSWORD_LENGTH = 6;

    /**
     * @return void
     */
    public static function sair()
    {
		Auth::logout();
		AppController::inicio();
	}

    /**
     * @return void
     */
    public static function logar()
    {
		Auth::login()
            ? AppController::home()
	        : ViewApp::loginIncorreto();
	}

    /**
     * @return void
     */
    public static function cadastrarUser()
    {
        $request = $_POST;

        $passwordLength = strlen($request['nSenha']);

        if (
            $passwordLength < self::MINIMUM_PASSWORD_LENGTH
            || $passwordLength > self::MAXIMUM_PASSWORD_LENGTH
        ) {
            ViewApp::mensagem('<p>Não foi possível cadastrar usuário.<p><p>Senha muito grande ou muito curta.</p>', "Cadastrar usuário", 4);

            return;
        }

        $user = new Usuario(
            null,
            $request['nNome'],
            $request['nEmail'],
            sha1($request['nSenha'])
        );

        if (!$user->insert()) {
            ViewApp::mensagem('Não foi possível cadastrar usuário.', "Cadastrar usuário", 4);

            return;
        }

        Auth::login();
        ViewAnalise::home();
	}

    /**
     * @return void
     */
    public static function formLogin()
    {
		ViewUsuario::formLogin();
	}
}
