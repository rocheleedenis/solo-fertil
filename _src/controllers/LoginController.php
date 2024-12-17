<?php

class LoginController{

    public static function verificaLogado(){
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['sf']['userId'])){
            return true;
        }else{
            return false;
        }
    }

    public static function iniciarSessao(){
        $email = (isset($_POST['nEmail'])) ? $_POST['nEmail'] : '';
        $senha = sha1((isset($_POST['nSenha'])) ? $_POST['nSenha'] : '');
        $result = Usuario::selectLogin($email, $senha);

        if (!empty($result)) {
            if (!isset($_SESSION)){
                session_start();
            }
            $_SESSION['sf']['userId'] = $result['id'];
            $_SESSION['sf']['userNome'] = $result['nome'];;
            return true;
        }else{
            return false;
        }
    }
    
    public static function terminaSessao() {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION['sf']);
    }
}
