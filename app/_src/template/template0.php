<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" type="text/css" href="../template/css/bootstrap.min.css">
    <link rel="stylesheet"  href="../template/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../template/css/css.css">
    <link rel="stylesheet" href="../template/css/table.css">
    <script src="../template/js/jquery.min.js"></script>
    <script src="../template/js/bootstrap.min.js"></script>
    <script src="../template/js/script0.js"></script>
    <script src="../template/js/jquery.mask.js"></script>
    <link rel="stylesheet" href="../template/css/responsive0.css">

</head>
<body>
	<!-- cabeçalho -->
    <div class="drop navbar-fixed-top">	
        <nav rule="navigation" class="nav nav-aberta">
            <div class="container">
                <div id="div-master" class="cont-nav">
                    <a href="../controllers/AppController.php">
                    	<img src="../template/img/logo-menor.png">
    	                <hgroup>
    	                	<h1>SoloFértil</h1>
    	                	<h2>Sistema de Interpratação<br>de Análise de Solo</h2>
    	                </hgroup>
                    </a>    
                </div>

                <div class="wrap">
                    <form name="nLogin" method="POST" action="../controllers/AppController.php?a=Mg==" class="navbar-form navbar-right">
                        <div class="input-group margin-bottom-sm">
                            <input class="form-control" size="15" required type="email" name="nEmail" placeholder="E-mail">
                            <span class="input-group-addon"><i class="fa-green fa fa-at fa-fw"></i></span>
                        </div>
                        <div class="input-group margin-bottom-sm">
                            <input class="form-control" size="15" required type="password" name="nSenha" id="iSenhaE" maxlength="10" minlenght="6" placeholder="Senha">
                            <span class="input-group-addon"><i class="fa-green fa fa-unlock-alt fa-fw"></i></span>
                        </div>
                        <button type="submit" id="iEnviar" class="btn btn-primary">Enviar</button>
                    </form>
                </div>  
            </div>
        </nav>
    </div>

    <section id="conteudo">
        <div class="container">
            <?php echo $conteudo; ?>
        </div>
    </section>

    <footer class="navbar-fixed-bottom">
        <div class="well">Desenvolvido por</div>
    </footer>

    <script>
        $(document).ready(function(){
            $('#iEnviar').attr('disabled', true);
            $('#iSenhaE').keyup(function(){
                if($(this).val().length < 6 || $('#iSenhaE').val().length > 10){
                    $('#iEnviar').prop('disabled', true);
                }else{
                    $('#iEnviar').attr('disabled', false);
                }
            });
        });
    </script>
</body>
</html>