<?php

class LoginController
{
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
    public static function formLogin()
    {
		ViewUsuario::formLogin();
	}
}
