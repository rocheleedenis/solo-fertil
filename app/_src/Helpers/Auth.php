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
