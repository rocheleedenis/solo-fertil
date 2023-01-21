<?php session_start();

require_once '../view/ViewAnalise.php';
require_once '../view/ViewApp.php';
require_once '../view/ViewCultura.php';
require_once '../view/ViewUsuario.php';
require_once '../view/ViewProdutor.php';
require_once '../view/ViewProducao.php';
require_once '../models/ModelAnalise.php';
require_once '../models/ModelCultura.php';
require_once '../models/ModelUsuario.php';
require_once '../models/ModelProducao.php';
require_once '../models/ModelProdutor.php';
require_once 'LoginController.php';
require_once '../../_config/config.php';
require_once '../routes/RoutesMapping.php';
require_once '../routes/RouteHandler.php';

class AppController {

}

$handler = new RouteHandler();
$handler->handleRouting();
