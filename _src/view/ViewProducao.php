<?php

class ViewProducao{
    
    public static function formCadastroProducao($produtores, $culturas){
		$tituloConteudo = "Cadastrar produção";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = "<div class='row voltar'>
                        <a href='../controllers/AppController.php'>INÍCIO</a> » CADASTRAR PRODUÇÃO
                    </div>
            <div class='panel-body'>
                <div class='row'>
                    <form method='post' action='../controllers/AppController.php?a=".base64_encode(28)."'>
                        <div class='col-md-6 col-lg-6 col-sm-6'>
                            <h3 class='subtitulo'>Dados da colheita</h3>
                            <div class='input-group margin-bottom-sm' style='width:400px;' >
                                <span class='input-group-addon'><i class='fa'></i>Produtor</span>
                                <select required class='form-control' name = 'nProdutor' size = 1>
                                    <option selected='' value='' placeholder=''>Selecione um produtor</option>";
        foreach ($produtores as $key => $value){
            $conteudo .="<option value='".$value['id']."'>".$value['nome'].", Fazenda ".$value['fazenda']."</option>";
        }
        $conteudo.="        </select>
                        </div><br />
                        <div class='input-group margin-bottom-sm' style='width:400px;' >
                            <span class='input-group-addon'><i class='fa'></i>Cultura</span>
                            <select required class='form-control' name = 'nCultura' size = 1>
                                <option selected='' value='' placeholder=''>Selecione uma cultura</option>";
        foreach ($culturas as $key => $value){
            $conteudo .="       <option value='".$value['id']."'>".$value['nome']."</option>";
        }
        $conteudo.="        </select>
                        </div><br />";

        $conteudo .= file_get_contents('../template/formulario-cadastro-producao.html').'
                <div class="row text-center">
                    <button class="btn btn-success" type="submit">Salvar</button>
                </div>
                <br><br>
            </form></div>
            <script> 
                $(document).ready(function(){
                    $("#iCadProducao").addClass("active");
                    $("#iDados").addClass("activeD");
                });
            </script>';
		require_once "../template/template.php";
    }

    public static function buscarProducao($culturas, $produtores){
      	$tituloConteudo = "Consultar produção";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = '<div class="row voltar">
                        <a href="../controllers/AppController.php">INÍCIO</a> » BUSCAR PRODUÇÃO
                    </div>
            <div class="panel-body">
                <div class="row">
                    <form method="POST" action="../controllers/AppController.php?a='.base64_encode(29).'">
                        <div class="input-group margin-bottom-sm">
                            <span class="input-group-addon"><i class="fa fa-vcard fa-fw"></i> | Produtor</span>
                            <select class="form-control" name = "nProdutor" size = 1>
                                <option selected="" value="" placeholder="">Selecione o produtor</option>';
        foreach ($produtores as $key => $value){
            $conteudo .="           <option value='".$value['id']."'>".$value['nome'].", Fazenda ".$value['fazenda']."</option>";
        }
        $conteudo.='        </select>
                        </div><br />
                        <div class="input-group margin-bottom-sm">
                            <span class="input-group-addon"><i class="fa fa-leaf fa-fw"></i> | Cultura </span>
                            <select class="form-control" name = "nCultura" size = 1>
                                <option selected="" value="" placeholder="">Selecione a cultura... </option>';
        foreach ($culturas as $key => $value){
            $conteudo .="       <option value='".$value['id']."'>".$value['nome']."</option>";
        }
        $conteudo.='        </select>
                        </div><br />
                        <div class="input-group margin-bottom-sm">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i> | Data da colheita entre </span>
                            <input type="text" class=" form-control" id="datepicker14" name="nDataI" maxlength="10" placeholder="Dia/Mês/Ano">
                            <span class="input-group-addon"> e </span>
                            <input id="datepicker1" type="text" class="form-control"  name="nDataF" maxlength="10" placeholder="Dia/Mês/Ano">
                        </div><br />
                        <div>
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                        <br><br>
                    </form>
                </div>
            </div>
            <link rel="stylesheet" href="../template/css/calendario.css">
            <script src="../template/js/jquery.zebra-datepicker.js"></script>
            <script> 
                $(document).ready(function(){
                    $("#iConsProducao").addClass("active");
                    $("#iDados").addClass("activeD");
                });
            </script>';
        require_once '../template/template.php';
    }

    public static function selecionarProducao($producoes){
        $tituloConteudo = "Consultar produção";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = '<div class="row voltar">
                        <a href="../controllers/AppController.php">INÍCIO</a> » <a href="../controllers/AppController.php?a='.base64_encode(29).'">BUSCAR PRODUÇÃO</a> » SELECIONAR PRODUÇÃO
                    </div>
            <div class="panel-body">
                <div class="row">
                    <form method="POST" action="">
                        <p>Selecione uma opção:</p>
                        <table class="table-striped table-hover"  style="max-width: 600px !important;">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Produtor</th>
                                    <th>Data</th>
                                    <th>Cultura</th>
                                </tr>
                            </thead>
                            <tbody>';
        $i = 1;
        foreach ($producoes as $key => $value){
            $conteudo .="       <tr class='trClick' rel='".$value['id']."'>
                                    <td>{$i}</td>
                                    <td>".$value['pr_nome'].", Fazenda ".$value['fazenda']."</td>
                                    <td>".Config::dateToBr($value['data'])."</td>
                                    <td>".$value['c_nome']."</td>
                                </tr>";
            $i++;
        }
        $conteudo .='       </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <script> 
                $(document).ready(function(){
                    $("#iConsProducao").addClass("active");
                    $("#iDados").addClass("activeD");
                    $("tr.trClick").on("click", function(){
                        var id =  $(this).attr("rel"); 
                        var a = action="../controllers/AppController.php?a='.base64_encode(30).'&id=" + id;
                        $("form").attr("action", a);
                        $("form").submit();
                    });
                });
            </script>';
        require_once '../template/template.php';
    }

    public static function consultarProducao($producao, $info){
        $tituloConteudo = "Consultar produção";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = '<div class="row voltar">
                        <a href="../controllers/AppController.php">INÍCIO</a> » <a href="../controllers/AppController.php?a='.base64_encode(29).'">BUSCAR PRODUÇÃO</a> » CONSULTAR PRODUÇÃO
                    </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 tira-padding">
                        <h3 class="subtitulo">Dados da colheita</h3>
                        <p><strong>Produtor: </strong>'.$info['produtor'].', Fazenda '.$info['fazenda'].'</p>
                        <p><strong>Cultura: </strong>'.$info['cultura'].'</p>
                        <p><strong>Data: </strong>'.Config::dateToBr($producao->getData()).'</p>
                        <p><strong>Área plantada: </strong>'.$producao->getAreaPlantada().$producao->getUnidadeArea().'</p>
                        <p><strong>Produção: </strong>'.$producao->getProducao().' '.$producao->getUnidade().'</p>
                        <p><strong>Preço de venda: </strong>R$ '.$producao->getPrecoVenda().'</p>
                        <p><strong>Quantidade vendida: </strong>'.$producao->getQtdVendida().' '.$producao->getUnidade().'</p>
                    </div>
                    <div class="col-md-6 tira-padding">
                        <h3 class="subtitulo">Gastos com adubação</h3>
                        <p><strong>Adubação N-P-K: </strong>R$ '.$producao->getGastosNPK().'</p>
                        <p><strong>Calcário: </strong>
                            <ul>
                                <li><strong>Quantidade: </strong>'.$producao->getQtdCalcario().' kg</li>
                                <li><strong>Preço: </strong>R$ '.$producao->getPrecoCalcario().'</li>
                            </ul>
                        </p>
                        <p><strong>Adubo orgânico: </strong>
                            <ul>
                                <li><strong>Quantidade: </strong>'.$producao->getQtdAduboOrganico().' kg</li>
                                <li><strong>Preço: </strong>R$ '.$producao->getPrecoAduboOrganico().'</li>
                            </ul>
                        </p>
                    </div>
                </div>
                <form id="formulario" action="../controllers/AppController.php?a='.base64_encode(31).'&id='.$producao->getId().'" method="post">
                    <div class="row text-center">
                        <button type="submit" class="btn btn-primary" name="nEditar" >Editar</button>
                        <button type="submit" class="btn btn-danger" name="nExcluir" id="iTypeButton">Excluir</button>
                    </div>
                </form>
                <br><br>
            </div>
            <link href="../../_lib/vex/css/vex-theme-os.css" rel="stylesheet" />
            <link href="../../_lib/vex/css/vex.css" rel="stylesheet" />
            <script src="../../_lib/vex/js/vex.combined.min.js"></script>

            <script>
                $(document).ready(function(){
                    $("#iConsProducao").addClass("active");
                    $("#iDados").addClass("activeD");
                    
                    $("#iTypeButton").prop("type", "button");
                    $("#iTypeButton").on("click", function(){
                        vex.defaultOptions.className = "vex-theme-os";
                        vex.dialog.confirm({
                            message: "Você tem certeza que quer excluir a produção? Os dados não poderão ser recuperados.",
                            callback: function(resultado) {
                                if (resultado) {
                                    $("#formulario").prop("action", "../controllers/AppController.php?a='.base64_encode(31).'&id='.$producao->getId().'&e=1");
                                    $("#formulario").submit();
                                }
                            }
                        });
                    });
                });
            </script>';
        require_once "../template/template.php";
    }

    public static function editarProducao($producao, $culturas, $produtores){
        $tituloConteudo = "Editar produção";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = "<div class='row voltar'>
                        <a href='../controllers/AppController.php'>INÍCIO</a> » <a href='../controllers/AppController.php?a=".base64_encode(29)."'>BUSCAR PRODUÇÃO</a> » EDITAR PRODUÇÃO
                    </div>
            <div class='panel-body'>
                <form method='post' action='../controllers/AppController.php?a=".base64_encode(32)."'>
                    <div class='row'>
                        <div class='col-md-6'>
                            <h3 class='subtitulo'>Dados da colheita</h3>
                            <div class='input-group margin-bottom-sm' style='width:400px;' >
                                <span class='input-group-addon'><i class='fa'></i>Produtor</span>
                                <select class='form-control' name='nProdutor' size=1>";
        foreach ($produtores as $key => $value){
            if($value['id'] == $producao->getIdProdutor()){
                $conteudo .="       <option selected='' value='".$value['id']."'>".$value['nome'].", Fazenda ".$value['fazenda']."</option>";
            }else{
                $conteudo .="       <option value='".$value['id']."'>".$value['nome'].", ".$value['fazenda']."</option>";
            }
        }
        $conteudo.="            </select>
                            </div><br />
                            <div class='input-group margin-bottom-sm' style='width:400px;' >
                                <span class='input-group-addon'><i class='fa'></i>Cultura</span>
                                <select class='form-control' name = 'nCultura' size = 1>";
        foreach ($culturas as $key => $value){
            if($value['id'] == $producao->getIdCultura()){
                $conteudo .="   <option selected='' value='".$value['id']."'>".$value['nome']."</option>";
            }else{
                $conteudo .="   <option value='".$value['id']."'>".$value['nome']."</option>";
            }
        }
        $conteudo.='            </select>
                            </div><br />
                            <div class="input-group margin-bottom-sm" style="width:400px;">
                                <span class="input-group-addon"><i class="fa"></i>Data</span>
                                <input id="datepicker1" class="form-control" required type="date" name="nData" maxlength="10" placeholder="Dia/Mês/Ano" value="'.Config::dateToBr($producao->getData()).'" />
                            </div><br />
                            <div class="input-group margin-bottom-sm" style="width:400px;">
                                <span class="input-group-addon"><i class="fa"></i>Área plantada</span>
                                <input class="cInteiro min=0 form-control" required type="number" name="nAreaPlantada" maxlength="10" placeholder="Dia/Mês/Ano" value="'.$producao->getAreaPlantada().'" />
                            </div>
                            <div class="input-group margin-bottom-sm" style="width:400px;" >
                                <span class="input-group-addon"><i class="fa"></i>Unidade</span>
                                <select class="form-control" name = "nUnidadeArea" size = 1>
                                    <option value="m²" '.("m²" == $producao->getUnidadeArea() ? 'selected=""':' ').'>m²</option>
                                    <option value="ha" '.("ha" == $producao->getUnidadeArea() ? 'selected=""':' ').'>ha</option>
                                </select>
                            </div><br />
                            <div class="input-group margin-bottom-sm" style="width:400px;">
                                <span class="input-group-addon"><i class="fa"></i>Produção</span>
                                <input class="cInteiro min=0 form-control" required type="number" name="nProducao" maxlength="10" value="'.$producao->getProducao().'" />
                            </div>
                            <div class="input-group margin-bottom-sm" style="width:400px;" >
                                <span class="input-group-addon"><i class="fa"></i>Unidade</span>
                                <select class="form-control" name = "nUnidade" size = 1>
                                    <option value="kg" '.("kg" == $producao->getUnidade() ? 'selected=""':' ').'> kg </option>
                                    <option value="dz" '.("dz" == $producao->getUnidade() ? 'selected=""':' ').'> dz </option>
                                    <option value="un" '.("un" == $producao->getUnidade() ? 'selected=""':' ').'> un </option>
                                    <option value="saco" '.("saco" == $producao->getUnidade() ? 'selected=""':' ').'> saco </option>
                                </select>
                            </div><br />
                            <div class="input-group margin-bottom-sm" style="width:400px;">
                                <span class="input-group-addon"><i class="fa"></i>Preço de venda</span>
                                <input class="cPreco form-control" required type="text" name="nPvenda" maxlength="10" value="R$ '.$producao->getPrecoVenda().'" />
                            </div>
                            <div class="input-group margin-bottom-sm" style="width:400px;">
                                <span class="input-group-addon"><i class="fa"></i>Quantidade vendida</span>
                                <input class="cInteiro min=0 form-control" required type="number" name="nQtdVendida" maxlength="10" value="'.$producao->getQtdVendida().'" />
                            </div><br />
                        </div>
                        <div class="col-md-6">
                            <h3 class="subtitulo">Gastos com adubação</h3>
                            <div class="input-group margin-bottom-sm" style="width:400px;">
                                <span class="input-group-addon"><i class="fa"></i>Gastos com adubação N-P-K</span>
                                <input class="cPreco form-control" required type="text" name="nGastosNPK" maxlength="10" value="R$ '.$producao->getGastosNPK().'" />
                            </div><br />

                            <div class="input-group margin-bottom-sm" style="width:400px;">
                                <span class="input-group-addon"><i class="fa"></i>Quantidade de calcário</span>
                                <input class="cInteiro min=0 form-control" required type="number" name="nQtdCalcario" maxlength="10" value="'.$producao->getQtdCalcario().'" />
                            </div>
                            <div class="input-group margin-bottom-sm" style="width:400px;">
                                <span class="input-group-addon"><i class="fa"></i>Preço</span>
                                <input class="cPreco form-control" required type="text" name="nPcalcario" maxlength="10" value="R$ '.$producao->getPrecoCalcario().'" />
                            </div><br />

                            <div class="input-group margin-bottom-sm" style="width:400px;">
                                <span class="input-group-addon"><i class="fa"></i>Quantidade de adubo orgânico</span>
                                <input class="cInteiro min=0 form-control" required type="number" name="nQtdAdubo" maxlength="10" value="'.$producao->getQtdAduboOrganico().'" />
                            </div>
                            <div class="input-group margin-bottom-sm" style="width:400px;">
                                <span class="input-group-addon"><i class="fa"></i>Preço</span>
                                <input class="cPreco form-control" required type="text" name="nPadubo" maxlength="10" value="R$ '.$producao->getPrecoAduboOrganico().'" />
                            </div><br />
                        </div>

                        <input type="hidden" name="nId" value="'.$producao->getId().'"/>
                    </div>
                    <div class="row text-center">
                        <button class="btn btn-success" type="submit">Salvar</button>
                    </div>
                    <br><br>
                </form>
            </div>
            <link rel="stylesheet" href="../template/css/calendario.css">
            <script src="../template/js/jquery.zebra-datepicker.js"></script>
            <script> 
                $(document).ready(function(){
                    $("#iConsProducao").addClass("active");
                    $("#iDados").addClass("activeD");
                });
            </script>';
        require_once "../template/template.php";
    }

    public static function formProdutividade($culturas, $produtores){
        $tituloConteudo = "Evolução da produtividade";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = '<div class="row voltar">
                        <a href="../controllers/AppController.php">INÍCIO</a> » BUSCAR PRODUÇÃO
                    </div>
            <div class="panel-body">
                <form method="POST" action="../controllers/AppController.php?a='.base64_encode(35).'">
                    <div class="row">
                        <p><strong>Selecione os dados abaixo:</strong></p>
                        <div class="input-group margin-bottom-sm">
                            <span class="input-group-addon">Produtor</span>
                            <select required class="form-control" name = "nProdutor" size = 1>
                                <option selected="" value="" placeholder="">Selecione o produtor... </option>';
        foreach ($produtores as $key => $value){
            $conteudo .="       <option value='".$value['id']."'>".$value['nome'].", Fazenda ".$value['fazenda']."</option>";
        }
        $conteudo.='        </select>
                        </div><br />
                        <div class="input-group margin-bottom-sm">
                            <span class="input-group-addon">Cultura </span>
                            <select class="form-control" name = "nCultura" size = 1>
                                <option selected="" value="" placeholder="">Selecione a cultura... </option>';
        foreach ($culturas as $key => $value){
            $conteudo .="       <option value='".$value['id']."'>".$value['nome']."</option>";
        }
        $conteudo.='        </select>
                        </div><br />
                    </div>
                    <div class="row text-center">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </div>
            <script> 
                $(document).ready(function(){
                    $("#iProdutividade").addClass("active");
                    $("#iDados").addClass("activeD");
                });
            </script>';
        require_once '../template/template.php';
    }

    public static function produtividade($producoes){
        $tituloConteudo = "Evolução da produtividade";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = "<div class='row voltar'>
                        <a href='../controllers/AppController.php'>INÍCIO</a> » BUSCAR PRODUÇÃO » EVOLUÇÃO DA PRODUTIVIDADE
                    </div>
            <div class='panel-body'>
                <div class='row'>
                    <form method='POST' action='../controllers/AppController.php?a=".base64_encode(35)."'>
                        <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
                        <script>
                            google.charts.load('current', {'packages':['corechart']});
                            google.charts.setOnLoadCallback(rentabilidade_1);
                            google.charts.setOnLoadCallback(produtividade);
                            google.charts.setOnLoadCallback(rentabilidade_2);
                            function rentabilidade_1() {
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'Data da colheita');
                                data.addColumn('number', 'Vendas');
                                data.addColumn('number', 'Gasto total');
                                data.addRows([";
                                    foreach ($producoes as $key => $value) {
                                        $conteudo .= "['".$value['data']."', ".$value['precoVenda']*$value['qtdVendida'].", ".($value['gastosNPK']+$value['qtdAduboOrganico']*$value['precoAduboOrganico']+$value['precoCalcario']*$value['qtdCalcario'])."],";
                                    }
                                    $conteudo .="]);
                                    var options = {
                                        title: 'Gastos com adubação X Vendas',
                                        hAxis: {
                                            title: 'Data da colheita'
                                        },
                                        vAxis: {
                                            title: 'Valores monetários (em R$)'
                                        }
                                    };
                                    var chart = new google.visualization.ColumnChart(document.getElementById('rentabilidade_1'));
                                chart.draw(data, options);
                            }
                            function produtividade() {
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'Dada da colheita');
                                data.addColumn('number', 'Produtividade');
                                data.addRows([";
                                foreach ($producoes as $key => $value) {
                                    $conteudo.= "['".$value['data']."', ".round($value['producao']/$value['areaPlantada'], 2)."],";
                                }
                                $conteudo .= "]);
                                    var options = {
                                        title: 'Produtividade',
                                        hAxis: {
                                            title: 'Data da colheita'
                                        },
                                        vAxis: {
                                            title: '".$value['unidade']."/".$value['unidadeArea']."'
                                        }
                                    };
                                    var chart = new google.visualization.ColumnChart(document.getElementById('produtividade'));
                                chart.draw(data, options);
                            }
                            function rentabilidade_2() {
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'Data da colheita');
                                data.addColumn('number', 'Adubo organico');
                                data.addColumn('number', 'Adubação N-P-K');
                                data.addColumn('number', 'Calagem');
                                data.addRows([";
                                    foreach ($producoes as $key => $value) {
                                        $conteudo .= "['".$value['data']."', ".$value['qtdAduboOrganico']*$value['precoAduboOrganico'].", ".$value['gastosNPK'].", ".$value['precoCalcario']*$value['qtdCalcario']."],";
                                    }
                                    $conteudo .="]);
                                    var options = {
                                        title: 'Gastos com adubação',
                                        hAxis: {
                                            title: 'Data da colheita'
                                        },
                                        vAxis: {
                                            title: 'Valores monetários (em R$)'
                                        }
                                    };
                                    var chart = new google.visualization.ColumnChart(document.getElementById('rentabilidade_2'));
                                chart.draw(data, options);
                            }
                        </script>
                        <div id='produtividade' style='width: 500px; height: 300px; border: 1px solid #ccc'></div><br>
                        <div id='rentabilidade_1' style='width: 500px; height: 300px; border: 1px solid #ccc'></div><br>
                        <div id='rentabilidade_2' style='width: 500px; height: 300px; border: 1px solid #ccc'></div><br>
                        <br>
                        <br>
                    </form>
                </div>
            </div>
            <script> 
                $(document).ready(function(){
                    $('#iProdutividade').addClass('active');
                    $('#iDados').addClass('activeD');
                });
            </script>";
                            
        require_once '../template/template.php';
    }                   
}
                    
                    