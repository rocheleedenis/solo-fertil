<?php

class Auth
{
    /**
     * @return boolean
     */
    public static function isLoggedIn()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        return isset($_SESSION['sf']['userId']);
    }

    /**
     * @return bool
     */
    public static function login()
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
    public static function logout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        unset($_SESSION['sf']);
    }
}
