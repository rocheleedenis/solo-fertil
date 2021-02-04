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
    <script src="../template/js/jquery.maskedinput.min.js"></script>
    <script src="../template/js/jquery.mask.js"></script>
    <script src="../template/js/bootstrap.min.js"></script>
    <script src="../template/js/script.js"></script>
    <link rel="stylesheet" href="../template/css/responsive.css">
</head>
<body>
    <!-- cabeçalho -->
    <div class="drop navbar-fixed-top">
        <nav rule="navigation" class="nav nav-aberta ">
            <div id="div-master" class="cont-nav container">
                <a href="../controllers/AppController.php">
                    <img src="../template/img/logo-menor.png">
                    <hgroup>
                        <h1>SoloFértil</h1>
                        <h2>Sistema de Interpratação<br>de Análise de Solo</h2>
                    </hgroup>
                </a>

                <div class="wrap">
                    <ul class="listaNav">
                        <li id="iMemo"><a href="../controllers/AppController.php">Memorizar Análise</a></li>
                        <li id="iInterp"><a href="../controllers/AppController.php?a=<?php echo base64_encode(7); ?>">Interpretação</a></li>
                        <li id="iSugest"><a href="../controllers/AppController.php?a=<?php echo base64_encode(8); ?>">Sugestão</a></li>
                        <li id="iSuces"><a href="../controllers/AppController.php?a=<?php echo base64_encode(10); ?>">Sucessão</a></li>
                        <li id="iInfo"><a href="../controllers/AppController.php?a=<?php echo base64_encode(13); ?>">Informações</a></li>
                        <li id="iDados" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Dados <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li id="iCadAna"><a tabindex="-1" href="../controllers/AppController.php?a=<?php echo base64_encode(15); ?>">Cadastrar análise</a></li>
                                <li id="iConsAna"><a tabindex="-1" href="../controllers/AppController.php?a=<?php echo base64_encode(17); ?>">Consultar análise</a></li>
                                <!-- <li role="separator" class="divider"></li> -->
                                <li id="iCadProdutor"><a href="../controllers/AppController.php?a=<?php echo base64_encode(21); ?>">Cadastrar produtor</a></li>
                                <li id="iConsProdutor"><a href="../controllers/AppController.php?a=<?php echo base64_encode(23); ?>"> Consultar produtor</a></li>
                                <!-- <li role="separator" class="divider"></li> -->
                                <li id="iCadProducao"><a tabindex="-1" href="../controllers/AppController.php?a=<?php echo base64_encode(27); ?>">Cadastrar produção</a></li>
                                <li id="iConsProducao"><a href="../controllers/AppController.php?a=<?php echo base64_encode(29); ?>">Consultar produção</a></li>
                                <!-- <li role="separator" class="divider"></li> -->
                                <li id="iProdutividade"><a href="../controllers/AppController.php?a=<?php echo base64_encode(34); ?>">Produtividade</a></li>
                            </ul>
                        </li>
                        <li id="iAjuda"><a href="../controllers/AppController.php?a=<?php echo base64_encode(39); ?>">Ajuda</a></li>
                        <?php if(isset($_SESSION['sf']['userNome'])): ?>
                                <?php 
                                    $nome = explode(" ",$_SESSION['sf']['userNome']);
                                    $pNome = $nome[0];
                                    unset($nome); 
                                ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user-circle-o fa-lg" aria-hidden="true"></i><?php echo $pNome; ?></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="../controllers/AppController.php?a=<?php echo base64_encode(36); ?>"> <i class="fa fa-address-card-o" aria-hidden="true"></i> Ver dados da conta </a></li>
                                        <li><a href="../controllers/AppController.php?a=<?php echo base64_encode(3); ?>"> <i class="fa fa-sign-out fa-lg" aria-hidden="true"></i> Sair </a></li>
                                    </ul>
                                </li>
                                <?php else: ?>
                            <li><a  href="../controllers/AppController.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>  
            </div> 
        </nav>
    </div>
    <section id="conteudo">
        <div class="container">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-tittle"><?php echo $tituloConteudo; ?></h3>
                </div>
                <?php echo $conteudo; ?>
            </div>
        </div>
        <footer class="navbar-fixed-bottom">
            <div class="well">Desenvolvido por</div>
        </footer>
    </section>
</body>
</html>