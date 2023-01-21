<?php

class UserController
{
    // God, why?
    const MAXIMUM_PASSWORD_LENGTH = 10;
    CONST MINIMUM_PASSWORD_LENGTH = 6;

    public static function show()
    {
        $usuario = new Usuario();

        $usuario->selectOne($_SESSION['sf']['userId']);

        ViewUsuario::consultar($usuario);
    }

    /**
     * @return void
     */
    public static function store()
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
}
