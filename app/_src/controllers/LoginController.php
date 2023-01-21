<?php

class LoginController
{
    /**
     * @return void
     */
    public static function sair()
    {
		Auth::logout();
		ViewApp::inicio();
	}

    /**
     * @return void
     */
    public static function logar()
    {
		Auth::login()
            ? ViewAnalise::home()
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
