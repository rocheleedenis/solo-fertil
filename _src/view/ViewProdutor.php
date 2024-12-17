<?php

class ViewProdutor{
       
    public static function formCadastroProdutor(){
		$tituloConteudo = "Cadastrar produtor";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = '<div class="row voltar">
                        <a href="../controllers/AppController.php">INÍCIO</a> » CADASTRAR PRODUTOR
                    </div>
                <div class="panel-body">
                    <form method="post" action="../controllers/AppController.php?a='.base64_encode(22).'">';
        $conteudo .= file_get_contents("../template/formulario-cadastro-produtor.html").'</form></div>
            <script> 
                $(document).ready(function(){
                    $("#iCadProdutor").addClass("active");
                    $("#iDados").addClass("activeD");
                });
            </script>';
		require_once "../template/template.php";
    }

    public static function selecionarProdutor($produtores){
    	$tituloConteudo = "Consultar produtor";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = '<div class="row voltar">
                        <a href="../controllers/AppController.php">INÍCIO</a> » CADASTRAR PRODUTOR
                    </div>
                <div class="panel-body">
                    <div class="row">
                        <p><strong>Selecione um produtor:</strong></p>
                        <form method="POST" action="">
                            <table class="table-striped table-hover"  style="max-width: 600px !important;">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nome</th>
                                        <th>Fazenda</th>
                                    </tr>
                                </thead>
                                <tbody>';
        $i = 1;
        foreach ($produtores as $key => $value){
            $conteudo .="<tr class='trClick' rel='".$value['id']."'>
                    <td>{$i}</td>
                    <td>".$value['nome']."</td>
                    <td>".$value['fazenda']."</td>
                </tr>";
            $i++;
        }
        $conteudo .='</tbody>
                    </table>
                </form>
            </div>
            </div>
            <script>
                $(document).ready(function(){
                    $("tr.trClick").on("click", function(){
                        var id =  $(this).attr("rel"); 
                        var a = action="../controllers/AppController.php?a='.base64_encode(23).'&id=" + id;
                        $("form").attr("action", a);
                        $("form").submit();
                    });
                
                    $("#iConsProdutor").addClass("active");
                    $("#iDados").addClass("activeD");
                });
            </script>';
        require_once '../template/template.php';
    }

    public static function consultarProdutor($produtor){
    	$tituloConteudo = "Consultar produtor";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = '<div class="row voltar">
                        <a href="../controllers/AppController.php">INÍCIO</a> » CONSULTAR PRODUTOR
                    </div>
            <div class="panel-body">
                <form id="formulario" action="../controllers/AppController.php?a='.base64_encode(24).'&id='.$produtor->getId().'" method="post">
                    <div class="row">
                        <div class="col-md-6">    
                            <p><strong>Nome: </strong>'.$produtor->getNome().'</p>
        			        <p><strong>Fazenda: </strong>'.$produtor->getFazenda().'</p>
        			        <p><strong>Logradouro: </strong>'.$produtor->getLogradouro().'</p>
        			        <p><strong>Bairro: </strong>'.$produtor->getBairro().'</p>
                        </div>
                        <div class="col-md-6"> 
        			        <p><strong>Área: </strong>'.$produtor->getArea().'</p>
        			        <p><strong>Cidade: </strong>'.$produtor->getCidade().'</p>
        			        <p><strong>Telefone: </strong><input readonly class="cTelefone invisivel" value="'.$produtor->getTelefone().'"/></p>
        			        <p><strong>Celular: </strong><input readonly class="invisivel cCelular" value="'.$produtor->getCelular().'"/></p>
                        </div>
                    </div>
                    <div class="row text-center">
                        <button type="submit" class="btn btn-primary" name="nEditar">Editar</button>
                        <button type="submit" class="btn btn-danger" name="nExcluir" id="iTypeButton">Excluir</button>
                    </div>
                    <br><br>
                </form>
            </div>

            <link href="../../_lib/vex/css/vex-theme-os.css" rel="stylesheet" />
            <link href="../../_lib/vex/css/vex.css" rel="stylesheet" />
            <script src="../../_lib/vex/js/vex.combined.min.js"></script>

			<script>
			    $(document).ready(function(){
			    	$("#iTypeButton").prop("type", "button");
                    $("#iTypeButton").on("click", function(){
                        vex.defaultOptions.className = "vex-theme-os";
                        vex.dialog.confirm({
                            message: "Você tem certeza que quer excluir o produtor? Os dados sobre a produção e análises também serão perdidos e não poderão ser recuperados.",
                            callback: function(resultado) {
                                if (resultado) {
                                    $("#formulario").prop("action", "../controllers/AppController.php?a='.base64_encode(24).'&id='.$produtor->getId().'&e=1");
                                    $("#formulario").submit();
                                }
                            }
                        });
                    });
                    $("#iConsProdutor").addClass("active");
                    $("#iDados").addClass("activeD");
			    });
		    </script>';

		require_once "../template/template.php";
    }

    public static function editarProdutor($produtor){
    	$tituloConteudo = "Editar produtor";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = '<div class="row voltar">
                        <a href="../controllers/AppController.php">INÍCIO</a> » EDITAR PRODUTOR
                    </div>
            <div class="panel-body">
        		<form action="../controllers/AppController.php?a='.base64_encode(25).'&id='.$produtor->getId().'" method="post">
        	    	<div class="row">
                        <div class="col-md-6">
                            <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon">Nome</span>
                                <input required type="text" class="form-control" value="'.$produtor->getNome().'" name="nNome">
                            </div><br />

                            <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon">Fazenda</span>
                                <input required type="text" class="form-control" value="'.$produtor->getFazenda().'" name="nFazenda">
                            </div><br />

                            <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon">Logradouro</span>
                                <input required type="text" class="form-control" value="'.$produtor->getLogradouro().'" name="nLogradouro">
                            </div><br />

                            <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon">Bairro</span>
                                <input required type="text" class="form-control" value="'.$produtor->getBairro().'" name="nBairro">
                            </div><br />
                        </div>
                        <div class="col-md-6">
                            <div class="input-group margin-bottom-sm" >
                                <span class="input-group-addon">Área</span>
                                <select required class="form-control" name = "nArea" size = 1>';
                                if($produtor->getArea()== 'Urbana'){
                                    $conteudo.='<option selected="" value="Urbana">Urbana</option>
                                                <option value="Rural">Rural</option>';
                                }else{
                                    $conteudo.='<option selected="" value="Rural">Rural</option>
                                                <option value="Urbana">Urbana</option>';
                                }
        $conteudo.='            </select>
                            </div><br />
        			        <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon">Cidade</span>
                                <input required type="text" class="form-control" value="'.$produtor->getCidade().'" name="nCidade">
                            </div><br />

                            <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon">Telefone</span>
                                <input type="text" class="cTelefone form-control" value="'.$produtor->getTelefone().'" name="nTelefone">
                            </div><br />

                            <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon">Celular</span>
                                <input type="text" class="cCelular form-control" value="'.$produtor->getCelular().'" name="nCelular">
                            </div><br />
                        </div>
                    </div>
                    <div class="row text-center">
                        <button class="btn btn-success" type="submit" name="nLogar">Salvar</button>
        			</div>
                    <br>
                    <br>
                </form>
            </div>
            <script>
                $(document).ready(function(){
                $("#iConsProdutor").addClass("active");
                    $("#iDados").addClass("activeD");
                });
            </script>';

		require_once "../template/template.php";
    }
}