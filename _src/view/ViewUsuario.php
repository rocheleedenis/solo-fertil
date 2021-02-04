<?php

class ViewUsuario{

    public static function consultar($usuario){
    	$tituloConteudo = 'Consultar usuário';
		$titulo = $tituloConteudo." - SoloFértil";
    	$conteudo = '<div class="row voltar">
                        <a href="../controllers/AppController.php">INÍCIO</a> » CONSULTAR USUÁRIO
                    </div>
            <div class="panel-body text-center">
	    		<form id="formulario" action="../controllers/AppController.php?a='.base64_encode(37).'" method="post">
	                    <p><strong>Nome: </strong>'.$usuario->getNome().'</p>
				        <p><strong>E-mail: </strong>'.$usuario->getEmail().'</p>
				        <p><strong>Senha: </strong>********</p>
					    <button type="submit" name="nEditar" class="btn btn-primary">Editar</button>
						<button type="submit" class="btn btn-danger" name="nExcluir" id="iTypeButton">Excluir</button>
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
                            message: "Você tem certeza que quer excluir sua conta? Todos os dados cadastrados serão perdidos.",
                            callback: function(resultado) {
                                if (resultado) {
                                    $("#formulario").prop("action", "../controllers/AppController.php?a='.base64_encode(37).'&e=1");
                                    $("#formulario").submit();
                                }
                            }
                        });
                    });
                });
		    </script>';

		require_once "../template/template.php";
    }

    public static function editar($usuario){
    	$tituloConteudo = 'Editar usuário';
		$titulo = $tituloConteudo." - SoloFértil";
    	$conteudo = '<div class="row voltar">
                        <a href="../controllers/AppController.php">INÍCIO</a> » EDITAR USUÁRIO
                    </div>
            <div class="panel-body text-center">
				<div class="row">
		    		<form action="../controllers/AppController.php?a='.base64_encode(38).'&id='.$usuario->getId().'" method="post">
						<div style="margin: auto; max-width: 300px;"> 
							<div class="input-group margin-bottom-sm">
			                    <span class="input-group-addon">Nome: </span>
			                    <input type="text" class="form-control"  name="nNome" required value="'.$usuario->getNome().'">
							</div>

							<div class="input-group margin-bottom-sm">
			                    <span class="input-group-addon">E-mail: </span>
			                    <input required type="email" class="form-control"  name="nEmail" value="'.$usuario->getEmail().'">
							</div>

							<div class="input-group margin-bottom-sm">
			                    <span class="input-group-addon">Senha: </span>
			                    <input required type="password" min=6 max=10 class="form-control" id="iSenha" name="nSenha"  placeholder="de 6 a 10 caracteres">
							</div>
							<br>
							<div class="row">
						    	<button class="btn btn-success" type="submit">Salvar</button>
						    </div>
						    <br>
						    <br>
						</div>
					</form>
				</div>
			</div>';

		require_once "../template/template.php";
    }
}