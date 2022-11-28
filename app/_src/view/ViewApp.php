<?php 

class ViewApp{
	
	public static function inicio(){
		$titulo = 'SoloFértil - Entre ou cadastre-se';
		$conteudo = file_get_contents('../template/home0.html');
		require_once "../template/template0.php";
    }

	public static function home(){
		$titulo = 'SoloFértil - Sistema de Interpretação de Análise de Solo';
		$conteudo = file_get_contents('../template/home.html');
		require_once "../template/template.php";
    }

    public static function loginIncorreto(){
		$titulo = 'Login - SoloFértil';
		$conteudo = '<h4 style="color: red;">E-mail ou senha incorretos.</h4>
		<h3>Ainda não tem uma conta?<a href="../controllers/AppController.php?">
		Cadastre-se!</a></h3>';
		require_once "../template/template0.php";
    }

    //essa interface não funciona no chrome. Problema: centralização dos elementos
	public static function mensagem($mensagem, $titulo, $tipo){
  		$tituloConteudo = $titulo;
  		$titulo .= " - SoloFértil";
  		switch ($tipo) {
    			case 1:
    				$conteudo = '<div class="alert alert-success">
      						<h3>Sucesso! <i class="fa fa-smile-o fa-lg" aria-hidden="true"></i> </h3><h4>'.$mensagem.'</h4>
    					</div>';
    				break;
    			case 2:
    				$conteudo = '<div class="alert alert-info">
      						<h3>Informação! <i class="fa fa-info  fa-lg" aria-hidden="true"></i></h3><h4>'.$mensagem.'</h4>
    					</div>';
    				break;
    			case 3:
    				$conteudo = '<div class="alert alert-warning">
      						<h3>Alerta! <i class="fa fa-meh-o  fa-lg" aria-hidden="true"></i></h3><h4>'.$mensagem.'</h4>
    					</div>';
    				break;
    			case 4:
  				$conteudo = '<div class="alert alert-danger">
    						<h3>Ocorreu um erro! <i class="fa fa-frown-o  fa-lg" aria-hidden="true"></i></h3><h4>'.$mensagem.'</h4>
  					</div>';
  				break;
		  }
      require_once '../template/template.php';
    }

    public static function ajudaUsuario(){
        $titulo = "Ajuda - SoloFértil"; 
      	$tituloConteudo = "Ajuda";
      	$conteudo = '<div class="row voltar">
      		            <a href="../controllers/AppController.php">INÍCIO</a> » AJUDA
      		        </div>
      	    <div class="panel-body">
      	    	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="max-width:900px; margin: auto;">
			        
			        <div class="panel panel-info">
			          	<div class="panel-heading" role="tab" id="headingOne">
			            	<h4 class="panel-title">
			              		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			                		Informações técnicas
			                	</a>
			            	</h4>
			          	</div>
          				<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            				<div class="panel-body">
              					<h4 class="text-success text-center">Sobre o Sistema</h4>
              					<p><strong>SoloFértil</strong> é uma ferramenta que possibilita recomendações mais seguras de adubação, calagem e sucessão de culturas, através da intepretação de análises de solo. Essa ferramenta ainda contribui para o acompanhamento da evolução da fertilidade do solo e produção.</p>
              					<h4 class="text-success text-center">Como utilizar</h4>
                  				<p>Antes de mais nada é preciso ser cadastrado no sistema e estar logado.</p>
                  				<p>Com uma Análise de Solo em mãos é possível utilizar todas as funções presentes nesse sistema.</p>
                  				<p>Para realizar uma interpretação de análise de solo, sugestão de adubação ou sucessão de culturas, é preciso que haja alguma análise memorizada ou cadastrada no sistema. Caso não seja atendida uma dessas condições, o sistema retornará uma mensagem de alerta ao clicar em em alguma dessas opções na barra de menu. Para <a href="../controllers/AppController.php" target="_blank"> MEMORIZAR </a> ou <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(15).'">CADASTRAR</a> uma análise, antes é preciso saber qual o padrão de análise que se tem em mãos. 
                  				<p><i class="fa fa-info text-primary" aria-hidden="true"></i> Duas coisas principais poderão variar na sua análise em relação aos modelos de análise do sistema.</p>

                  				<p>A primeira delas é o cálculo de calagem. O que determina a quantidade de calcário a ser aplicado no solo é o Teor de Argila ou o Fósforo Remanescente (P-rem).Porém, uma análise na maioria das vezes vem somente com uma dessas opções. Portanto, na hora de preencher o sistema com os dados da análise, você pode preencher um dos campos, Arg ou P-rem, de acordo com a sua análise.</p> 
                  				<p>Finalmente, caso você queira <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(17).'">recuperar uma análise</a> do banco, basta ir em DADOS->CONSULTAR ANÁLISE->SELECIONAR UMA ANÁLISE. A análise selecionada ficará memorizada e todas as funcionalidades do sistema se basearão nela, até que outra análise seja consultada ou memorizada.</p>
            					<h4 class="text-success text-center">Dicas</h4>
            					<p>Em várias funcionalidades do sistema, é possível obter relatórios em formato PDF clicando no botão Gerar PDF.</p>
            					<p>É possivel navegar pelo sistema com facilidade e saber em qual parte do sistema você está utilizando o MENU de NAvegação</p>
            				</div>
          				</div>
        			</div>

      				<div class="panel panel-info">
          				<div class="panel-heading" role="tab" id="headingTwo">
            				<h4 class="panel-title">
	              				<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
	                				Interpretação de análise de solo
	              				</a>
            				</h4>
          				</div>

          			<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
			            <div class="panel-body">
			              	<p>A <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(7).'">Interpretação de análise de solo</a>, fornece uma classificação para os níveis de acidez e nutrientes informados na análise em questão.
			              	</p>
			            </div>
			        </div>
			    </div>

      				<div class="panel panel-info">
						<div class="panel-heading" role="tab" id="headingThree">
							<h4 class="panel-title">
							  	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							    	Sugestão de adubação
							  	</a>
							</h4>
						</div>
          				<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            				<div class="panel-body">
              					<p>É possível obter <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(8).'">sugestão de adubação</a> para cada cultura presente no sistema, com informações detalhadas sobre calagem, adubação orgânica, mineral e parcelamento da adubação mineral. Ainda, é possível simular a compra de fertilizante misto ou simples de acordo com a necessidade de N, P e K.</p>
              					<p>Na escolha de fertilizante simples, para cada tipo de fertilizante escolhido o sistema retornará a quantidade de adubo final necessária em quilos por hectare.</p>
              					<p class="text-danger"><i class="fa fa-exclamation" aria-hidden="true"></i> <strong>Importante:</strong></p>
              					<p>Ao escolher adubo misto, é ideal optar pela fórmula de fertilizante composto que mais se aproxima proporcionalmente da relação encotrada em <strong>Fórmula Simplificada de N-P-K</strong> apresentada. Escolher uma fórmula que é pouco proporcional, pode causar excesso de adubação por algum elemento.
            				</div>
          				</div>
        			</div>

			        <div class="panel panel-info">
			          	<div class="panel-heading" role="tab" id="headingFour">
			            	<h4 class="panel-title">
			              		<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
			                		Sucessão de culturas
			              		</a>
			            	</h4>
			          	</div>
          				<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
            				<div class="panel-body">
              					<p><strong>A prática de sucessão de culturas</strong>, quando feita de maneira correta, respeitando-se as características da planta e do solo através do conhecimento técnico e análise de solo, possibilita a economia de gastos com adubação através do aproveitamento de nutientes presentes no solo após a colheita da última cultura. Portanto, realizar análise de solo e sua posterior interpretação após a colheita é imprescindível para o uso do <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(10).'">módulo de Sugestão de Sucessão de Culturas do SoloFértil</a>. Também será preciso informar a última cultura plantada, uma vez que o plantio de culturas de mesma família em sequência não é recomendado.</p>
              					<p>Após escolher a última cultura plantada na área para a qual se deseja a sugestão de cultura a ser plantada, você deverá escolher uma cultura por importância de nutriente, selecionando qual o nutriente que terá mais peso na hora da escolha do adubo. </p>
              					<p><i class="fa fa-comments-o text-primary" aria-hidden="true"></i> Uma aplicação prática disso se dá quando, por exemplo, um determinado adubo estiver com um custo mais elevado naquele momento. Pode-se então obter o conhecimento sobre qual é a base de nutriente dele, e assim, marcar esse nutriente como o primeiro adubo, ou seja, o mais importante, o que você quer gastar menos. Por exemplo, se a ureia estiver com um preço elevado, marque primeiro o N (Nitrogênio). Assim, as primeiras plantas sugeridas na lista serão as que menos precisam de N para se desenvolver. Com essa prática é possível economizar adubo através do aproveitamento do adubo residual.</p>
            				</div>
          				</div>
        			</div>

			        <div class="panel panel-info">
			          	<div class="panel-heading" role="tab" id="headingSix">
			            	<h4 class="panel-title">
			              		<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
			                	Informações sobre culturas
			              		</a>
			            	</h4>
			          	</div>
						<div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
							<div class="panel-body">
						  		<p>O sistema possui uma lista com Informações úteis sobre cada cultura. Para acessá-las, basta ir em <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(13).'">Informações</a> e escolher a cultura desejada.</p>
						  		</p>
							</div>
						</div>
					</div>

			        <div class="panel panel-info">
			          	<div class="panel-heading" role="tab" id="headingFive">
			            	<h4 class="panel-title">
			              		<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
			                	Dados & Conta de Usuário
			              		</a>
			            	</h4>
			          	</div>
          				<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
            				<div class="panel-body">
              					<p class="text-center">Armazene informações referentes à <strong>análises</strong>, <strong>produtores</strong> e <strong>produção</strong> e gerencie sua conta de <strong>usuário</strong></p><br />
                				<h4 class="text-success text-center">Cadastro e consulta de análise</h4>
                				<p>Você pode <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(15).'">armazenar dados de uma análise</a>, vinculando-a a um produtor e salvando dados importantes como data, local e a profundidade da análise. Ao fazer isso, você tem as opções de selecionar um produtor que já está cadastrado anteriormente, ou cadastrar um produtor novo para a análise em questão. Você também pode usar a análise memorizada no momento (caso tenha alguma) ou digitar uma análise nova.</p>
                  				<p class="text-muted"><i class="fa fa-info" aria-hidden="true"></i> É fácil limpar a tabela de análise quando há análises memorizadas através do botão <button type="button"  class="btn btn-warning">Limpar dados da tabela</button>localizado logo abaixo da tabela.</p>
                  				<p>Ao <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(17).'">consultar análise </a>, você será redirecionado para uma lista de análises cadastradas anteriormente, onde ao escolher uma análise serão exibidas as suas informações e haverá a opção de editar e excluir análise.</p>
                				<h4 class="text-success text-center">Cadastro e consulta de produtor</h4>
                				<p>Você também pode <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(21).'">cadastrar o produtor </a>separadamente. Isso é muito útil para caso você precise registrar um produtor sem ter uma análise para ele naquele momento. Você só precisa entrar com as informações dele e pronto!</p>
                  				<p>A <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(23).'">consulta de produtor </a>funciona de forma semelhante à consulta de análise mencionada acima.</p>

                				<h4 class="text-success text-center">Cadastro e consulta de produção</h4>
                				<p>Um recurso interessante aqui é o acompanhamento da produtividade. <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(27).'">Cadastre os dados de produção</a> após a colheita de determinada cultura para um produtor, inserindo o preço de venda por unidade (kilo, dezena, saco...) e informando os gastos com fertilizantes.</p>
                				<p>Você pode editar esses dados em <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(29).'">consultar produção</a>, escolhendo o produtor, cultura e informando o intervalo de tempo entre as colheitas</p>

                				<h4 class="text-success text-center">Acompanhamento da produtividade</h4>
                				<p>Acompanhe a evolução da sua produção com a ajuda de gráficos e analise seus gastos com fertilizante em relação ao seu faturamento. Veja também qual tipo de adubo você gastou mais.Você só precisa selecionar o produtor e a cultura em <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(34).'">produtividade</a>.</p>
                				<p class="text-danger"><i class="fa fa-exclamation" aria-hidden="true"></i> Mas não se esqueça de cadastrar os dados da produção corretamente!</p>

                				<h4 class="text-success text-center">Conta de usuário</h4>
                				<p>Gerencie os <a target="_blank" href="../controllers/AppController.php?a='.base64_encode(36).'">dados da sua conta</a> em Ver dados da conta. Você também pode sair do sistema pelo botão Sair, encerrando sua sessão.</p>
           	 				</div>
          				</div>
        			</div>

          			<div class="panel panel-info">
          				<div class="panel-heading" role="tab" id="headingSeven">
            				<h4 class="panel-title">
              					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                					Referências
              					</a>
            				</h4>
          				</div>
          				<div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
            				<div class="panel-body">
              					<p class="text-center">As fórmulas utilizadas para cálculo de adubação e calagem, bem como as informações sobre necessidades de nutrientes apresentadas por cada cultura, o padrão de classificação/interpretação de análise de solo, sugestão de cultivo por área e outras informações sobre cultura e solo, foram retiradas do livro <strong>Recomendações para o uso de corretivos e fertilizantes em Minas Gerais: 5ª Aproximação, da Comissão de Fertilidade do Solo de Minas Gerais</strong>.</p>
              					</p>
            				</div>
          				</div>
        			</div>

      			</div>  
        	</div>
        </div>
        <style type="text/css">
        	p{
        		text-align: justify;
        	}
        </style>
        <script>
		    $(document).ready(function(){
		    	$("#iAjuda").addClass("active");
		    });
	    </script>';
      require_once '../template/template.php';
    }
}