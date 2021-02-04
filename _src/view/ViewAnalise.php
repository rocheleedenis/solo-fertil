<?php

class ViewAnalise{

	public static function home(){
		$titulo = "Memorizar análise - SoloFértil";
		$tituloConteudo = '<strong style="color: saddlebrown;">Bem vindo ao SoloFértil!</strong>
						<p style="font-size: 18px; margin-top: 20px; color: black;">Nas várias funcionalidades deste sistema será necessário utilizar os dados do resultado de sua análise.
						Inserindo os dados na tabela abaixo o programa memorizará temporariamente esses dados (ao sair do sistema eles serão perdidos).</p>
						<p style="font-size: 18px; color: black;"> <i class="fa fa-hand-o-up fa-lg" aria-hidden="true"></i> Você também pode salvá-los permanentemente em <b class="decorar"> Dados <i class="fa fa-angle-double-right" aria-hidden="true"></i> Cadastrar análise</b></p>';
		$conteudo = '<form id="iForm" action="../controllers/AppController.php?a='.base64_encode(12).'" method="post"><br>';
		if(isset($_SESSION['sf']['analise'])){
			$analise = unserialize($_SESSION['sf']['analise']);
			$conteudo.= '
				<table class="table table-bordered table-responsive">
				    <thead class="text-center">
				    	<tr>
				        	<th>pH</th>
				        	<th>P</th>
				        	<th>K</th>
				        	<th>Ca<sup>2+</sup></th>
				        	<th>Mg<sup>2+</sup></th>
				        	<th>Al<sup>3+</sup></th>
				        	<th>H+Al</th>
				        	<th>SB</th>
				        	<th>(t)</th>
				        	<th>(T)</th>
				        	<th>V</th>
				        	<th>m</th>
				        	<th>Arg</th>
				        	<th>MO</th>
				        	<th>P-rem</th>
				      	</tr>
					</thead>
					<tbody class="text-center">
				    	<tr>
				        	<td>H<sub>2</sub>O</td>
				        	<td colspan="2">mg/dm<sup>3</sup></td>
				        	<td colspan="7">cmol<sub>c</sub>/dm<sup>3</sup></td>
				        	<td colspan="3">%</td>
				        	<td>dag/Kg</td>
				        	<td>mg/L</td>
				      	</tr>
				    	<tr id="sub-titulo">
				        	<td><input type="text" class="cNumber" required name="nPH" id="iPH" value="'.$analise->getPh().'"/></td>
				        	<td><input type="text" class="cNumber" required id="iFosforo" name="nFosforo" value="'.$analise->getFosforo().'"/></td>
				        	<td><input type="text" class="cNumber" required id="iPotassio" name="nPotassio" value="'.$analise->getPotassio().'"/></td>
				        	<td><input type="text" class="cNumber" required id="iCalcio" name="nCalcio" value="'.$analise->getCalcio().'"/></td>
				        	<td><input type="text" class="cNumber" required id="iMagnesio" name="nMagnesio" value="'.$analise->getMagnesio().'"/></td>
				        	<td><input type="text" class="cNumber" required id="iAluminio" name="nAluminio" value="'.$analise->getAluminio().'"/></td>
				        	<td><input type="text" class="cNumber" required id="iHAl" name="nHAl" value="'.$analise->getAcidezPotencial().'"/></td>
				        	<td><input type="text" class="cNumber" required id="iSB" name="nSB" value="'.$analise->getSomaBases().'"/></td>
				        	<td><input type="text" id="iCtcEfetiva" name="nCtcEfetiva" disabled value="'.$analise->getCtcEfetiva().'"/></td>
				        	<td><input type="text" id="iCtcPH7" name="nCtcPH7" disabled value="'.$analise->getCtcPH7().'"/></td>
				        	<td><input type="text" id="iV" name="nV" disabled value="'.$analise->getSaturacaoBases().'"/></td>
				        	<td><input type="text" id="iIndiceM" name="nIndiceM" disabled value="'.$analise->getSaturacaoAl().'"/></td>
				        	<td><input type="text" class="cNumber" id="iArgila" name="nArgila" value="'.$analise->getTeorArgila().'"/></td>
				        	<td><input type="text" class="cNumber" required id="iMO" name="nMO" value="'.$analise->getMatOrganica().'"/></td>
				        	<td><input type="text" class="cNumber" id="iPrem" name="nPrem" value="'.$analise->getPrem().'"/></td>
				      	</tr>
					</tbody>
					<i><small>Todos os campos são obrigatórios. Caso sua análise não venha com o valor da argila ou fósforo remanescente preencha estes campos com o valor 0.</small></i>
				</table>
				<button type="button" id="iLimpar" class="btn btn-warning">Limpar dados da tabela</button>';
		}else{
			$conteudo .= file_get_contents('../template/tabela-analise.html');
		}
		$conteudo .= "<div class='row text-center'>
					<button id='iTypeButton' type='submit' class='btn btn-success'>Memorizar análise</button>
				</div>
			</form>
			<script src='../template/js/table.js'></script>
			<link href='../../_lib/vex/css/vex-theme-os.css' rel='stylesheet' />
			<link href='../../_lib/vex/css/vex.css' rel='stylesheet' />
			<script src='../../_lib/vex/js/vex.combined.min.js'></script>

			<script>
				$(document).ready(function(){
					$('#iTypeButton').prop('type', 'button');
					$('#iTypeButton').on('click', function(){
						if( ( ($('#iPrem').val() != '') && ($('#iPrem').val() > 0) ) || ( ($('#iArgila').val() != '') && ($('#iArgila').val() > 0) ) ){
                            if(($('#iPH').val() != '') && ($('#iFosforo').val() != '') && ($('#iCalcio').val() != '') && ($('#iMagnesio').val() != '') && ($('#iAluminio').val() != '') && ($('#iHAl').val() != '') && ($('#iSB').val() != '') && ($('#iMO').val() != '')){
                                $('#iForm').submit();
                            }else{
                            	vex.defaultOptions.className = 'vex-theme-os';
								vex.dialog.alert({
						    		message: 'É preciso preencher pelo menos Arg ou P-rem e todos os demais campos.',
						  		});
                            }
						}else{
							vex.defaultOptions.className = 'vex-theme-os';
							vex.dialog.alert({
					    		message: 'É preciso preencher pelo menos Arg ou P-rem e todos os demais campos.',
					  		});
						}
					});
					$('#iMemo').addClass('active');
				});
			</script>";

		require_once "../template/template.php";
	}

	public static function interpretacaoResult($r, $pdf=false){
		foreach ($r as $key => $value) {
			switch ($value) {
				case '1':
					$r[$key] = 'Muito baixo';
					break;
				case '2':
					$r[$key] = 'Baixo';
					break;
				case '3':
					$r[$key] = 'Médio<sup>4/<sup>';
					break;
				case '4':
					$r[$key] = 'Bom';
					break;
				case '5':
					$r[$key] = 'Muito bom';
					break;
			}
		}
		$analise = unserialize($_SESSION['sf']['analise']);
        if($pdf){
			require_once 'ViewAnalisePDF.php';
            ViewAnalisePDF::interpretacaoResult($analise, $r);
        }
        else{
            self::interpretacaoResultHTML($analise, $r);
        }
    }

	public static function interpretacaoResultHTML($analise, $r){
		$titulo = "Interpretação de análise de solo - SoloFértil";
		$tituloConteudo = "Interpretação de análise de solo";
	    $conteudo = '<div class="row voltar">
		            	<a href="../controllers/AppController.php">INÍCIO</a> » INTERPRETAÇÃO
		            </div>
	                <div class="panel-body">';
        if(isset($r['produtor'])){
        	$conteudo .= '<div class="row">
        			<h3 class="subtitulo">Identificação da análise</h3>
        			<div class="col-md-6 col-sm-6 col-lg-6 no-margin">
                        <p><strong>Produtor: </strong>'.$r['produtor']['nome'].'</p>
                        <p><strong>Fazenda: </strong>'.$r['produtor']['fazenda'].'</p>
                        <p><strong>Data: </strong>'.$analise->getData().'</p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 no-margin">
                        <p><strong>Local: </strong>'.$analise->getLocal().'</p>
                        <p><strong>Profundidade: </strong>'.$analise->getProfundidade().' cm</p>
                    </div>
                </div>';
        }
	    $conteudo .='<div class="row">
	    			<p>Resultado da interpretação da análise:</p>
	    			<table class="table-striped" style="max-width: 600px;">
	                    <thead>
	                        <tr>
	                            <th>Característica</th>
	                            <th>Valores<sup>1/</sup></th>
	                            <th>Classificação</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <tr>
	                            <td class="col-esq">Tipo de Solo</td>
	                            <td>'.$analise->getTeorArgila().'%</td>
	                            <td>'.$r['tipoSolo'].'</td>
	                        </tr>
	                        <tr>
	                            <td class="col-esq">Acidez (pH)<sup>2/</sup></td>
	                            <td>'.$analise->getPh().'</td>
	                            <td>'.$r['ph'].'</td>
	                        </tr>
	                        <tr>
	                            <td class="col-esq">Fósforo (P)</td>
	                            <td>'.$analise->getFosforo().' mg/dm<sup>3</sup></td>
	                            <td>'.$r['fosforo'].'</td>
	                        </tr>
	                        <tr>
	                            <td class="col-esq">Potássio (K)</td>
	                            <td>'.$analise->getPotassio().' mg/dm<sup>3</sup></td>
	                            <td>'.$r['potassio'].'</td>
	                        </tr>
	                        <tr>
	                            <td class="col-esq">Cálcio trocável (Ca<sup>2+</sup>)</td>
	                            <td>'.$analise->getCalcio().' cmol<sub>c</sub>/dm<sup>3</sup></td>
	                            <td>'.$r['calcio'].'</td>
	                        </tr>
	                        <tr>
	                            <td class="col-esq">Magnésio trocável (Mg<sup>2+</sup>)</td>
	                            <td>'.$analise->getMagnesio().' cmol<sub>c</sub>/dm<sup>3</sup></td>
	                            <td>'.$r['magnesio'].'</td>
	                        </tr>
	                        <tr>
	                            <td class="col-esq">Acidez trocável (Al<sup>3+</sup>)<sup>3/</sup></td>
	                            <td>'.$analise->getAluminio().' cmol<sub>c</sub>/dm<sup>3</sup></td>
	                            <td>'.$r['aluminio'].'</td>
	                        </tr>
	                        <tr>
	                            <td class="col-esq">Acidez potencial (H + Al)<sup>3/</sup></td>
	                            <td>'.$analise->getAcidezPotencial().' cmol<sub>c</sub>/dm<sup>3</sup></td>
	                            <td>'.$r['HAl'].'</td>
	                        </tr>
	                        <tr>
	                            <td class="col-esq">Soma de bases (SB)</td>
	                            <td>'.$analise->getSomaBases().' cmol<sub>c</sub>/dm<sup>3</sup></td>
	                            <td>'.$r['SB'].'</td>
	                        </tr>
	                        <tr>
	                            <td class="col-esq">Saturação por bases (SB)<sup>5/</sup></td>
	                            <td>'.$analise->getSaturacaoBases().' %</td>
	                            <td>'.$r['SB'].'</td>
	                        </tr>
	                        <tr>
	                            <td class="col-esq">CTC efetiva (t)</td>
	                            <td>'.$analise->getCtcEfetiva().' cmol<sub>c</sub>/dm<sup>3</sup></td>
	                            <td>'.$r['ctcEfetiva'].'</td>
	                        </tr>
	                        <tr>
	                            <td class="col-esq">CTC pH 7 (T)</td>
	                            <td>'.$analise->getCtcPH7().' cmol<sub>c</sub>/dm<sup>3</sup></td>
	                            <td>'.$r['ctcPH7'].'</td>
	                        </tr>
	                        <tr>
	                            <td class="col-esq">Saturação por Al<sup>3+</sup> (m)<sup>3/</sup></td>
	                            <td>'.$analise->getSaturacaoAl().' %</td>
	                            <td>'.$r['M'].'</td>
	                        </tr>
	                        <tr>
	                            <td class="col-esq">Matéria orgânica (M.O.)</td>
	                            <td>'.$analise->getMatOrganica().' dag/kg</td>
	                            <td>'.$r['MO'].'</td>
	                        </tr>
	                    </tbody>
		            </table>
		            <div class="observacoes-tabela">
		            	1/ - dag/kg = % (m/m); cmolc/dm<sup>3</sup> = meq/100 cm<sup>3</sup>. 2/ - A qualificação utilizada indica adequado (Bom) ou inadequado (muito baixo e baixo ou alto e muito alto). 3/ - A interpretação desta característica deve ser "alta" e "muito alta" em lugar de "bom" e "muito bom". 4/ - O limite superior desta classe indica o nível crítico. 5/ - <i style="color: red;">Depende da cultura</i>
		            </div>
		            <br>
	            	<div class="row text-center">
	            		<a class="btn btn-success" target="_blank" href="../controllers/AppController.php?a='.base64_encode(7).'&p=1">Gerar PDF</a>
	            	</div>
	            	<br>
	            	<br>
	            	<br>
	            </div>
	        </div>
	        <script src="../template/js/table.js"></script>
	        <script>
				$(document).ready(function(){
					$("#iInterp").addClass("active");
				});
			</script>';
        require_once '../template/template.php';
	}

	public static function formCadastroAnalise($analise, $produtores){
		$tituloConteudo = "Cadastrar análise";
		$titulo = $tituloConteudo." - SoloFértil";
		$conteudo = '<div class="row voltar">
		            	<a href="../controllers/AppController.php">INÍCIO</a> » CADASTRAR ANÁLISE
		            </div>
		    <div class="panel-body">
		    	<form id="iForm" action="../controllers/AppController.php?a='.base64_encode(16).'" method="post">
			    	<div class="row">
							<table id="tabela" class="table table-bordered table-responsive">
							    <thead class="text-center">
							    	<tr>
							        	<th>pH</th>
							        	<th>P</th>
							        	<th>K</th>
							        	<th>Ca<sup>2+</sup></th>
							        	<th>Mg<sup>2+</sup></th>
							        	<th>Al<sup>3+</sup></th>
							        	<th>H+Al</th>
							        	<th>SB</th>
							        	<th>Arg</th>
							        	<th>MO</th>
							        	<th>P-rem</th>
							      	</tr>
								</thead>
								<tbody class="text-center">
							    	<tr>
							        	<td>H<sub>2</sub>O</td>
							        	<td colspan="2">mg/dm<sup>3</sup></td>
							        	<td colspan="5">cmol<sub>c</sub>/dm<sup>3</sup></td>
							        	<td>%</td>
							        	<td>dag/Kg</td>
							        	<td>mg/L</td>
							      	</tr>
							    	<tr id="sub-titulo">
							        	<td><input type="text" class="cNumber" required name="nPH" value="'.$analise->getPh().'"/></td>
							        	<td><input type="text" class="cNumber" required name="nFosforo" value="'.$analise->getFosforo().'"/></td>
							        	<td><input type="text" class="cNumber" required name="nPotassio" value="'.$analise->getPotassio().'"/></td>
							        	<td><input type="text" class="cNumber" required name="nCalcio" value="'.$analise->getCalcio().'"/></td>
							        	<td><input type="text" class="cNumber" required name="nMagnesio" value="'.$analise->getMagnesio().'"/></td>
							        	<td><input type="text" class="cNumber" required name="nAluminio" value="'.$analise->getAluminio().'"/></td>
							        	<td><input type="text" class="cNumber" required name="nHAl" value="'.$analise->getAcidezPotencial().'"/></td>
							        	<td><input type="text" class="cNumber" required name="nSB" value="'.$analise->getSomaBases().'"/></td>
							        	<td><input type="text" class="cNumber" name="nArgila" id="iArgila" value="'.$analise->getTeorArgila().'"/></td>
							        	<td><input type="text" class="cNumber" name="nMO" value="'.$analise->getMatOrganica().'"/></td>
							        	<td><input type="text" class="cNumber" name="nPrem" value="'.$analise->getPrem().'"/></td>
							      	</tr>
								</tbody>
								<i><small>Todos os campos são obrigatórios. Caso sua análise não venha com o valor da argila ou fósforo remanescente preencha estes campos com o valor 0.</small></i>
							</table>
							';
        if($analise->getFosforo()){
        	$conteudo .= '<button type="button" id="iLimpar" class="btn btn-warning">Limpar dados da tabela</button>';
        }
		$conteudo.='</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 tira-padding">
					<br><br>
                    <div class="input-group margin-bottom-sm" style="width:400px;">
                        <span class="input-group-addon"><i class="fa-green fa fa-map-marker fa-fw"></i> | Local</span>
                        <input class="form-control" name="nLocal" maxlength="30" placeholder="Talhão, gleba..." required />
                    </div><br />

                    <div class="input-group margin-bottom-sm" style="width:400px;">
                        <span class="input-group-addon"><i class="fa-green fa fa-long-arrow-down fa-fw"></i> | Profundidade</span>
                        <input type="number" min=0 class="cInteiro form-control" name="nProfundidade" maxlength="30" placeholder="Em centímetros" required />
                    </div><br />

                    <div class="input-group margin-bottom-sm" style="width:400px;">
                        <span class="input-group-addon"><i class="fa-green fa fa-calendar fa-fw"></i> | Data</span>
                        <input id="datepicker14" class="form-control" name="nData" required type="text" placeholder="01/01/2000"/>
                    </div><br />
                    <p>Selecione o produtor dono da análise...</p>
                    <div class="input-group margin-bottom-sm" style="width:400px;" >
						<span class="input-group-addon"><i class="fa-green fa fa-map-marker fa-fw"></i> | Produtor</span>
                            <select class="form-control" id="iIdProdutor" name="nIdProdutor" size = 1>
                                <option selected="" value="">Selecione um produtor</option>';
        foreach ($produtores as $key => $value){
            $conteudo .='<option value="' . $value['id'] . '">' . $value['nome'] . ', Fazenda '.$value['fazenda'].'</option>';
        }
        $conteudo .='	</select>
	        		</div>
	        		<br>
	        	</div>';

		$conteudo .= file_get_contents('../template/formulario-cadastro-analise.html')."
			<script src='../template/js/table.js'></script>
			<link rel='stylesheet' href='../template/css/calendario.css'>
            <script src='../template/js/jquery.zebra-datepicker.js'></script>
			<script>
				$(document).ready(function(){
					$('#tabela').change(function(){
						if( ( ($('#iPrem').val() != '') && ($('#iPrem').val() > 0) ) || ( ($('#iArgila').val() != '') && ($('#iArgila').val() > 0) ) ){
                            if(($('#iPH').val() != '') && ($('#iFosforo').val() != '') && ($('#iCalcio').val() != '') && ($('#iMagnesio').val() != '') && ($('#iAluminio').val() != '') && ($('#iHAl').val() != '') && ($('#iSB').val() != '') && ($('#iMO').val() != '')){
                                $('#iForm').submit();
                            }else{
                            	vex.defaultOptions.className = 'vex-theme-os';
								vex.dialog.alert({
						    		message: 'É preciso preencher pelo menos Arg ou P-rem e todos os demais campos.',
						  		});
                            }
						}else{
							vex.defaultOptions.className = 'vex-theme-os';
							vex.dialog.alert({
					    		message: 'É preciso preencher pelo menos Arg ou P-rem e todos os demais campos.',
					  		});
						}
					});

					$('#iCadAna').addClass('active');
					$('#iDados').addClass('activeD');
				});
			</script>";

		require_once "../template/template.php";
	}

	public static function selecionarAnalise($analises){
		$tituloConteudo = "Consultar dados da análise";
		$titulo = $tituloConteudo." - SoloFértil";
		$conteudo = '<div class="row voltar">
		            	<a href="../controllers/AppController.php">INÍCIO</a> » SELECIONAR ANÁLISE
		            </div>
		    <div class="panel-body">
	            <div class="row">
		            <p><strong>Selecione uma análise:</strong></p>
		            <form method="POST" action="">
		                <table class="table-striped table-hover" style="max-width: 600px !important;">
		                    <thead>
		                        <tr>
		                            <th>Nº</th>
		                            <th>Data</th>
		                            <th>Local</th>
		                            <th>Produtor</th>
		                        </tr>
		                    </thead>
		                    <tbody>';
        $i=1;
        foreach ($analises as $key => $value){
            $conteudo .="<tr class='trClick' rel='".$value['id']."'>
                    <td>{$i}</td>
                    <td>".Config::dateToBr($value['data'])."</td>
                    <td>".$value['local']."</td>
                    <td>".$value['nome'].", Fazenda ".$value['fazenda']."</td>
                </tr>";
            $i++;
        }
        $conteudo .="</tbody>
	            	    </table>
	        	    </form>
	            </div>
	        </div>
	        <script src='../template/js/table.js'></script>
            <script>
                $(document).ready(function(){
	                $('tr.trClick').on('click', function(){
	                	var id = $(this).attr('rel');
	                    var a = action='../controllers/AppController.php?a=".base64_encode(17)."&id=' + id;
	                    $('form').attr('action', a);
	                    $('form').submit();
	                });
					$('#iConsAna').addClass('active');
					$('#iDados').addClass('activeD');
				});
            </script>";
		require_once "../template/template.php";
	}

	public static function consultarAnalise($analise, $produtor, $pdf=false){
        if($pdf){
			require_once 'ViewAnalisePDF.php';
            ViewAnalisePDF::consultarAnalise($analise, $produtor);
        }
        else{
            self::consultarAnaliseHTML($analise, $produtor);
        }
	}

	public static function consultarAnaliseHTML($analise, $produtor){
    	$tituloConteudo = "Consultar dados da análises";
		$titulo = $tituloConteudo." - SoloFértil";
		$conteudo = '<div class="row voltar">
		            	<a href="../controllers/AppController.php">INÍCIO</a> » <a href="../controllers/AppController.php?a='.base64_encode(17).'">SELECIONAR ANÁLISE</a> » CONSULTAR ANÁLISE
		            </div>
		    <div class="panel-body">
	            <div class="row">
					<div class="row chata">
						<h3 class="subtitulo">Identificação</h3>
				        <div class="col-md-6 tira-padding">
					        <p><strong>Local: </strong>'.$analise->getLocal().'</p>
					        <p><strong>Profundidade: </strong>'.$analise->getProfundidade().' cm</p>
					    </div>
					    <div class="col-md-6 tira-padding">
				        	<p><strong>Data da análise: </strong>'.$analise->getData().'</p>
				        	<p><strong>Produtor: </strong>'.$produtor['nome'].', Fazenda '.$produtor['fazenda'].'</p>
				        </div>
				    </div>
					<table class="table table-bordered table-responsive">
					    <thead class="text-center">
					    	<tr>
					        	<th>pH</th>
					        	<th>P</th>
					        	<th>K</th>
					        	<th>Ca<sup>2+</sup></th>
					        	<th>Mg<sup>2+</sup></th>
					        	<th>Al<sup>3+</sup></th>
					        	<th>H+Al</th>
					        	<th>SB</th>
					        	<th>(t)</th>
					        	<th>T</th>
					        	<th>V</th>
					        	<th>m</th>
					        	<th>Arg</th>
					        	<th>MO</th>
					        	<th>P-rem</th>
					      	</tr>
						</thead>
						<tbody class="text-center">
					    	<tr>
					        	<td>H<sub>2</sub>O</td>
					        	<td colspan="2">mg/dm<sup>3</sup></td>
					        	<td colspan="7">cmol<sub>c</sub>/dm<sup>3</sup></td>
					        	<td colspan="3">%</td>
					        	<td>dag/Kg</td>
					        	<td>mg/L</td>
					      	</tr>
					    	<tr>
					        	<td>'.$analise->getPh().'</td>
					        	<td>'.$analise->getFosforo().'</td>
					        	<td>'.$analise->getPotassio().'</td>
					        	<td>'.$analise->getCalcio().'</td>
					        	<td>'.$analise->getMagnesio().'</td>
					        	<td>'.$analise->getAluminio().'</td>
					        	<td>'.$analise->getAcidezPotencial().'</td>
					        	<td>'.$analise->getSomaBases().'</td>
					        	<td>'.$analise->getCtcEfetiva().'</td>
					        	<td>'.$analise->getCtcPH7().'</td>
					        	<td>'.$analise->getSaturacaoBases().'</td>
					        	<td>'.$analise->getSaturacaoAl().'</td>
					        	<td>'.$analise->getTeorArgila().'</td>
					        	<td>'.$analise->getMatOrganica().'</td>
					        	<td>'.$analise->getPrem().'</td>
					      	</tr>
						</tbody>
					</table>
			        <br>
			        <form id="iForm" action="../controllers/AppController.php?a='.base64_encode(18).'&id='.$analise->getId().'" method="post">
				        <div class="row text-center">
					        <a name="nGerarPDF" class="btn btn-success" target="_blank" href="../controllers/AppController.php?a='.base64_encode(18).'&id='.$analise->getId().'&p=1">Gerar PDF</a>
					        <button type="submit" class="btn btn-primary" name="nEditar">Editar</button>
					        <button type="submit" id="iTypeButton" class="btn btn-danger" name="nExcluir" >Excluir</button>
					    </div>
					</form>
			    </div>
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
					    	message: "Você tem certeza que quer excluir esta análise? Os dados não poderão ser recuperados.",
					    	callback: function(resultado) {
						      	if (resultado) {
						      		$("#iForm").prop("action", "../controllers/AppController.php?a='.base64_encode(18).'&id='.$analise->getId().'&e=1");
						        	$("#iForm").submit();
					      		}
					    	}
					  	});
					});
			    	$("#iConsAna").addClass("active");
					$("#iDados").addClass("activeD");
			    });
		    </script>
		    <script src="../template/js/table.js"></script>';
		require_once "../template/template.php";
	}

	public static function editarAnalise($analise, $produtores){
    	$tituloConteudo = "Editar dados da análise";
		$titulo = $tituloConteudo." - SoloFértil";
		$conteudo = '<div class="row voltar">
		            	<a href="../controllers/AppController.php">INÍCIO</a> » <a href="../controllers/AppController.php?a='.base64_encode(17).'">SELECIONAR ANÁLISE</a> » EDITAR ANÁLISE
		            </div>
		        <div class="panel-body">
					<form action="../controllers/AppController.php?a='.base64_encode(20).'" method="post">
						<input type="hidden" name="nId" value="'.$analise->getId().'"/>
					<div class="row">
						<div class="row chata">
							<h3 class="subtitulo"> Identificação</h3>
							<div class="col-md-6">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon">Local</span>
									<input required type="text" class="form-control" value="'.$analise->getLocal().'" name="nLocal">
								</div><br>
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon">Profundidade</span>
									<input required type="number" min=0 class="cInteiro form-control" value="'.$analise->getProfundidade().'" name="nProfundidade">
								</div><br>
							</div>
							<div class="col-md-6 ">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon">Data</span>
									<input required type="text" id="datepicker14" class="form-control" value="'.$analise->getData().'" name="nData">
								</div><br>
								<div class="input-group margin-bottom-sm" >
									<span class="input-group-addon">Produtor</span>
									<select required class="form-control" name = "nIdProdutor" size = 1>
					                    	<option selected="" value=""> -- </option>';
		        foreach ($produtores as $key => $value){
		            if($analise->getIdProdutor() == $value['id']){
		            	$conteudo .='<option selected="" value="' . $value['id'] . '">' . $value['nome'] . '</option>';
		            }else{
		            	$conteudo .='<option value="' . $value['id'] . '">' . $value['nome'] . '</option>';

		            }
		        }
		$conteudo .='				</select>
		        				</div><br>
		        			</div>
		        		</div>
						<table class="table table-bordered table-responsive">
						    <thead class="text-center">
						    	<tr>
						        	<th>pH</th>
						        	<th>P</th>
						        	<th>K</th>
						        	<th>Ca<sup>2+</sup></th>
						        	<th>Mg<sup>2+</sup></th>
						        	<th>Al<sup>3+</sup></th>
						        	<th>H+Al</th>
						        	<th>SB</th>
						        	<th>Arg</th>
						        	<th>MO</th>
						        	<th>P-rem</th>
						      	</tr>
							</thead>
							<tbody class="text-center">
						    	<tr>
						        	<td>H<sub>2</sub>O</td>
						        	<td colspan="2">mg/dm<sup>3</sup></td>
						        	<td colspan="5">cmol<sub>c</sub>/dm<sup>3</sup></td>
						        	<td>%</td>
						        	<td>dag/Kg</td>
						        	<td>mg/L</td>
						      	</tr>
						    	<tr id="sub-titulo">
						        	<td><input type="text" id="iPH" required name="nPH" value="'.$analise->getPh().'"/></td>
						        	<td><input class="cNumber" type="text" id="iFosforo" required name="nFosforo" value="'.$analise->getFosforo().'"/></td>
						        	<td><input class="cNumber" type="text" id="iPotassio" required name="nPotassio" value="'.$analise->getPotassio().'"/></td>
						        	<td><input class="cNumber" type="text" id="iCalcio" required name="nCalcio" value="'.$analise->getCalcio().'"/></td>
						        	<td><input class="cNumber" type="text" id="iMagnesio" required name="nMagnesio" value="'.$analise->getMagnesio().'"/></td>
						        	<td><input class="cNumber" type="text" id="iAluminio" required name="nAluminio" value="'.$analise->getAluminio().'"/></td>
						        	<td><input class="cNumber" type="text" id="iHAl" required name="nHAl" value="'.$analise->getAcidezPotencial().'"/></td>
						        	<td><input class="cNumber" type="text" id="iSB" required name="nSB" value="'.$analise->getSomaBases().'"/></td>
						        	<td><input class="cNumber" type="text" id="iMO" name="nArgila" value="'.$analise->getTeorArgila().'"/></td>
						        	<td><input class="cNumber" type="text" id="iArgila" required name="nMO" value="'.$analise->getMatOrganica().'"/></td>
						        	<td><input class="cNumber" type="text" id="iPrem" name="nPrem" value="'.$analise->getPrem().'"/></td>
						      	</tr>
							</tbody>
							<i><small>Todos os campos são obrigatórios. Caso sua análise não venha com o valor da argila ou fósforo remanescente preencha estes campos com o valor 0.</small></i>
						</table>
		        		<div class="row text-center">
		        			<button class="btn btn-primary" type="submit" id="iSalvar">Salvar</button>
		        			<br><br>
		        		</div>
		        	</div>
					</form>
				</div>
				<link rel="stylesheet" href="../template/css/calendario.css">
				<script src="../template/js/jquery.zebra-datepicker.js"></script>
				<script src="../template/js/table.js"></script>
				<script>
					$(document).ready(function(){
						$("#iConsAna").addClass("active");
						$("#iDados").addClass("activeD");
					});
				</script>';
		require_once "../template/template.php";
	}
}

