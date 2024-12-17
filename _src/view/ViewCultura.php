<?php 

class ViewCultura {
	public static function formAdubacao($culturas){
        $tituloConteudo = "Sugestão de adubação";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = '<div class="row voltar">
                <a href="../controllers/AppController.php">INÍCIO</a> » SELECIONAR CULTURA
            </div>
            <div class="panel-body">
            <div class="row">
                <form method="POST" action="">
                    <p>Selecione a cultura que deseja a sugestão:</p>
                    <table style="max-width: 500px !important;" class="table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nome</th>
                                <th>Família</th>
                            </tr>
                        </thead>
                        <tbody>';
        $i = 1;
        foreach ($culturas as $key => $value){
            $conteudo .="<tr class='trClick' rel='".$value['id']."'>
                                <td>{$i}</td>
                                <td>".$value['nome']."</td>
                                <td><em>".$value['familia']."</em></td>
                            </tr>";
            $i++;
        }
        $conteudo .='       </tbody>
                        </table>
                    <form>
                </div>
            </div>
            <br>
            <script>
                $(document).ready(function(){
                    $("#iSugest").addClass("active");

                    $("tr.trClick").on("click", function(){
                       $this = $(this);
                       var id = $this.attr("rel"); 
                       var a = action="../controllers/AppController.php?a='.base64_encode(9).'&id=" + id;
                       $("form").attr("action", a);
                       $("form").submit();
                    });
                });
            </script>';

        require_once '../template/template.php';
    }

    public static function sugerirAdubacao($r, $cultura, $pdf=false, $adubo){
        if($pdf){
            require_once 'ViewCulturaPDF.php';
            ViewCulturaPDF::sugerirAdubacao($r, $cultura, $adubo);  
        }
        else{
            self::sugerirAdubacaoHTML($r, $cultura);
        }
    }

    public static function sugerirAdubacaoHTML($r, $cultura){
        $tituloConteudo = "Sugestão de adubação para <strong>".$cultura->getNome()."</strong>";
        $titulo = "Sugestão de adubação para ".$cultura->getNome()." - SoloFértil";
        $conteudo = '<div class="row voltar">
                        <a href="../controllers/AppController.php">INÍCIO</a> » <a href="../controllers/AppController.php?a='.base64_encode(8).'">SELECIONAR CULTURA</a> » SUGESTÃO DE ADUBAÇÃO
                    </div>
            <div class="panel-body">
                <div class="row">
                    <p><strong>Calagem</strong>: </p>
                    <ul>
                        <li>'.$cultura->getCalagem().'</li>
                        <li>Quantidade de calcário necessária calculada através do método da <strong>neutralização do Al<sup>3+</sup></strong>: '.$r['calagemAl'].' t/ha.</li> 
                        <li>Quantidade de calcário necessária calculada através do método da <strong>saturação por bases</strong>: '.$r['calagemBas'].' t/ha.</li> 
                    </ul>
                    <br>
                    <p><strong>Adubação orgânica</strong>: '.$cultura->getAdubOrganica().'</p>
                    <br/>
                    <p><strong>Adubação mineral</strong>:</p>
                    <ul>
                        <li>Quantidade de N: '.$r['qtdeN'].' kg/ha;</li>
                        <li>Quantidade de P<sub>2</sub>O<sub>5</sub>: '.$r['qtdeP2O5'].' kg/ha;</li>
                        <li>Quantidade de K<sub>2</sub>O: '.$r['qtdeK2O'].' kg/ha.</li>
                        <li>Fórmula simplificada de N-P-K: '.$r['formulacao'].'</li>
                    </ul>
                    <br>
                    <p><strong>Parcelamento da adubação mineral</strong>:</p>';
        if (count($cultura->getParcNPKtable())){
            $conteudo .= '<table class="table-striped">
                <thead>
                    <tr>
                        <th rowspan=2>Nutriente</th>
                        <th>Plantio</th>';
            $cont = 0;
            foreach ($cultura->getParcNPKtable() as $key => $value){
                if($value['ciclo']>$cont) $cont = $value['ciclo'];
            }
            for ($i=1; $i <= $cont; $i++) { 
                $conteudo .= '<th>'.$i.'&ordm;</th>';
            }
            $conteudo .= "</tr>
                    <tr>
                        <th colspan=".++$cont.">- &#37; do total indicado acima -</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>N</td>";
            $nut = "N";
            $a = 0;
            $cont--;
            foreach ($cultura->getParcNPKtable() as $key => $value) {
                if ($value['nutriente']==$nut) {
                    $conteudo .= "<td>".$value['porcentagem']."</td>";
                    $a++;
                }else{
                    if ($a!=$cont){
                        while ($a<$cont) {
                            $conteudo .= "<td>--</td>";
                            $a++;
                        }
                    } $a=0;
                    $nut = $value['nutriente'];
                    $conteudo .= "</tr>
                        <tr>
                            <td>".$value['nutriente']."</td>
                            <td>".$value['porcentagem']."</td>";
                }
            }
        }
        $conteudo .= '</tr>
                </tbody>
            </table>
            <p>'.$cultura->getParcelamentoNPK().'</p>
            <form target="_blank" method="POST" action="../controllers/AppController.php?a='.base64_encode(9).'&p=1">
            </div>';
        $conteudo .= file_get_contents('../template/sugestao-adubacao.html');
        $conteudo .= '
                    <br>
                    <div class="row text-center">
                        <button type="submit" class="btn btn-success">Gerar PDF</button>
                    </div>
                </form>
                <br>
                <br>
                <input type="hidden" id="iNitrogenio" value="'.$r['qtdeN'].'">
                <input type="hidden" id="iP2O5" value="'.$r['qtdeP2O5'].'">
                <input type="hidden" id="iK2O" value="'.$r['qtdeK2O'].'" >
            </div>
            <script>
                $(document).ready(function(){
                    $("#iSugest").addClass("active");
                });
            </script>';

        require_once '../template/template.php';
    }

    public static function formSugestaoCultura($culturas){
        $tituloConteudo = "Sugestão de sucessão de cultura";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = '<div class="row voltar">
                    <a href="../controllers/AppController.php">INÍCIO</a> » SUGESTÃO DE CULTURA
                </div>
            <div class="panel panel-body">
                <div class="row">
                    <form id="formulario" method="POST" action="../controllers/AppController.php?a='.base64_encode(11).'">
                        <p>Selecione a última cultura plantada no local da análise:</p>
                        <p><select style="width: auto;" required class="form-control" name="nCultura" size = 1>
                            <option selected="" value="">Selecione uma cultura</option>';
        foreach ($culturas as $key => $value){
            $conteudo .= '<option value="'.$value['id'].'">'.$value['nome'].'</option>';
        }
        $conteudo .='</select></p><br>';
        $conteudo.= file_get_contents('../template/formulario-sugestao-cultura.html');
        require_once '../template/template.php';
    }

    public static function sugerirCultura($r, $pdf=false, $info){
        if($pdf){
            require_once 'ViewCulturaPDF.php';
            ViewCulturaPDF::sugerirCultura($r, $info);
        }
        else{
            self::sugerirCulturaHTML($r, $info);
        }
    }

    public static function sugerirCulturaHTML($r, $info){
        $tituloConteudo = "Sugestão de sucessão de cultura";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = '<div class="row voltar">
                        <a href="../controllers/AppController.php">INÍCIO</a> » <a href="../controllers/AppController.php?a='.base64_encode(10).'">SUGESTÂO DE CULTURA</a> » RESULTADO
                    </div>
                <div class="panel panel-body">
                    <div class="row">';
        if (count($r)){
            $conteudo .= '<p>Culturas sugeridas posicionadas em ordem ascendente:</p>
                <table class="text-center table-striped" style="max-width: 600px;">
                    <thead>
                        <tr>
                            <th rowspan=2>Posição</th>
                            <th rowspan=2>Nome</th>
                            <th>Qtde de N</th>
                            <th>Qtde de P<sub>2</sub>O<sub>5</sub></th>
                            <th>Qtde de K<sub>2</sub>O</th>
                        </tr>
                        <tr>
                            <th colspan=3>kg/ha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>';
            foreach ($r as $key => $value) {
                $conteudo .= "<td>".++$key."</td>
                        <td>".$value['nome']."</td>
                        <td>".$value['adubacao']['qtdeN']."</td>
                        <td>".$value['adubacao']['qtdeP2O5']."</td>
                        <td>".$value['adubacao']['qtdeK2O']."</td>
                    </tr>
                    <tr>";
            }
            $conteudo .= "</tr>
                    </tbody>
                </table>
                <div class='row text-center'>
                    <a class='btn btn-success' target='_blank' href='../controllers/AppController.php?a=".base64_encode(11)."&p=1'>Gerar PDF</a>
                </div>";
        }else{
            $conteudo .= "<p><strong>Nenhuma cultura para ser sugerida.</strong></p>";
        }
        $conteudo .= '</div></div>';
        require_once '../template/template.php';
    }

    public static function formSelecionarInfo($culturas){
        $tituloConteudo = "Informações de culturas";
        $titulo = $tituloConteudo." - SoloFértil";
        $conteudo = '<div class="row voltar">
                <a href="../controllers/AppController.php">INÍCIO</a> » SELECIONAR CULTURA</a>
            </div>
            <div class="panel-body">
                <div class="row">    
                    <p>Selecione uma cultura:</p>
                    <form method="POST" action="">
                        <table class="table-striped table-hover"  style="max-width: 600px;">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Nome</th>
                                    <th>Família</th>
                                </tr>
                            </thead>
                            <tbody>';
        $i = 1;
        foreach ($culturas as $key => $value){
            $conteudo .="<tr class='trClick' rel='".$value['id']."'>
                    <td>{$i}</td>
                    <td>".$value['nome']."</td>
                    <td><em>".$value['familia']."</em></td>
                </tr>";
            $i++;
        }
        $conteudo .='</tbody>
                        </table>
                    </form>
                    <br>
                </div>
            </div>
            <script>
                $(document).ready(function(){
                    $("tr.trClick").on("click", function(){
                        var id =  $(this).attr("rel"); 
                        var a = action="../controllers/AppController.php?a='.base64_encode(14).'&id=" + id;
                        $("form").attr("action", a);
                        $("form").submit();
                    });

                    $("#iInfo").addClass("active");
                });
            </script>';
        require_once '../template/template.php';
    }

    public static function infoCultura($cultura, $pdf=false){
        if($pdf){
            require_once 'ViewCulturaPDF.php';            
            ViewCulturaPDF::infoCultura($cultura);
        }
        else{
            self::infoCulturaHTML($cultura);
        }
    }  

    public static function infoCulturaHTML($cultura){
        $nome = $cultura->getNome();
        $nome = strtolower(preg_replace("/\s/", "-",($cultura->getNome())));

        $tituloConteudo = "Informações sobre <strong>".$cultura->getNome()."</strong>";
        $titulo = "Informações sobre ".$cultura->getNome()." - SoloFértil";

        $conteudo = '<div class="row voltar">
                <a href="../controllers/AppController.php">INÍCIO</a> » <a href="../controllers/AppController.php?a='.base64_encode(13).'">SELECIONAR CULTURA</a> » INFORMAÇÔES DA CULTURA
            </div>
            <div class="panel panel-body text-justify">
                <div class="row">
                    <div class="row chata">
                        <div class="col-md-4 col-sm-4">
                            <img style="max-width:200px; margin: auto;" alt="Imagem da cultura" class="img-cultura img-responsive" src="../template/img/'.$nome.'.jpg">
                            <br>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <p><strong>Família: </strong><em>'.$cultura->getFamilia().'</em></p>
                            <p><strong>Produção esperada por hectare: </strong>'.$cultura->getProducaoEsperada().'</p>
                            <p><strong>Espaçamento: </strong>'.$cultura->getEspacamento().'</p>
                            <p><strong>Calagem: </strong>'.$cultura->getCalagem().'</p> 
                            <p><strong>Adubação orgânica: </strong>'.$cultura->getAdubOrganica().'</p>
                        </div>
                    </div>
                    <p><strong>Adubação mineral:</strong></p>
                        <table class="table-striped table-responsive"  style="max-width: 600px;">
                            <thead>
                                <tr>';
        if ($cultura->getAdubMineralTable()[0]['p2o5soloArgiloso']!=null) {
            $conteudo .= '      <th rowspan="4">Disponibilidade de P ou de K</th>
                                    <th colspan="3">Textura do Solo</th>
                                    <th colspan="2"></th>
                                <tr>
                                    <th>Argilosa</th>
                                    <th>Média</th>
                                    <th>Arenosa</th>
                                    <th colspan="2">Dose total<br></th>
                                </tr>
                                <tr>
                                    <th colspan="3">Dose de P<sub>2</sub>O<sub>5</sub></th>
                                    <th>K<sub>2</sub>O</th>
                                    <th>N</th>
                                </tr>
                                <tr>
                                    <th colspan="5">kg/ha</th>
                                </tr>
                            </thead>
                            <tbody>';
        
            foreach ($cultura->getAdubMineralTable() as $key => $value) {
                switch ($value['disponibNutriente']) {
                    case '2':
                        $aux = 'Baixa';
                        break;
                    case '3':
                        $aux = 'Média';
                        break;
                    case '4':
                        $aux = 'Boa';
                        break;
                    case '5':
                        $aux = 'Muito boa';
                        break;
                }
                $conteudo .= '<tr>
                        <td>'.$aux.'</td>
                        <td>'.$value['p2o5soloArgiloso'].'</td>
                        <td>'.$value['p2o5soloMedio'].'</td>
                        <td>'.$value['p2o5soloArenoso'].'</td>
                        <td>'.$value['k2o'].'</td>
                        <td>'.$value['nitrogenio'].'</td>
                    </tr>';
            }
        } else{
            $conteudo .= ' 
                        <th rowspan=3>Disponibilidade de P ou de K</th>
                        <th colspan=3>Dose total</th>
                    </tr>
                    <tr>
                        <th>P<sub>2</sub>O<sub>5</sub></th>
                        <th>K<sub>2</sub>O</th>
                        <th>N</th>
                    <tr>
                    <tr>
                        <th></th>
                        <th colspan="3">kg/ha</th>
                    </tr>
                </thead>
                <tbody>';
        
            foreach ($cultura->getAdubMineralTable() as $key => $value) {
                switch ($value['disponibNutriente']) {
                    case '2':
                        $aux = 'Baixa';
                        break;
                    case '3':
                        $aux = 'Média';
                        break;
                    case '4':
                        $aux = 'Boa';
                        break;
                    case '5':
                        $aux = 'Muito boa';
                        break;
                }
                $conteudo .= '<tr>
                        <td>'.$aux.'</td>
                        <td>'.$value['p2o5soloMedio'].'</td>
                        <td>'.$value['k2o'].'</td>
                        <td>'.$value['nitrogenio'].'</td>
                    </tr>';
            }
        }
        $conteudo .= '</tbody>
                    </table>
                    <br><p><strong>Parcelamento da adubação N-P-K:</strong>';
        if (count($cultura->getParcNPKtable())){
            $conteudo .= '
            <table  style="max-width: 600px;" class="table-striped">
                <thead>
                    <tr>
                        <th rowspan=2>Nutriente</th>
                        <th>Plantio</th>';
            $cont = 0;
            foreach ($cultura->getParcNPKtable() as $key => $value){
                if($value['ciclo']>$cont) $cont = $value['ciclo'];
            }
            for ($i=1; $i <= $cont; $i++) { 
                $conteudo .= '<th>'.$i.'&ordm;</th>';
            }
            $conteudo .= "</tr>
                    <tr>
                        <th colspan=".++$cont."> &#37; do total indicado acima</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>N</td>";
            $nut = "N";
            $a = 0;
            $cont--;
            foreach ($cultura->getParcNPKtable() as $key => $value) {
                if ($value['nutriente']==$nut) {
                    $conteudo .= "<td>".$value['porcentagem']."</td>";
                    $a++;
                }else{
                    if ($a!=$cont){
                        while ($a<$cont) {
                            $conteudo .= "<td>--</td>";
                            $a++;
                        }
                    } $a=0;
                    $nut = $value['nutriente'];
                    $conteudo .= "</tr>
                        <tr>
                            <td>".$value['nutriente']."</td>
                            <td>".$value['porcentagem']."</td>";
                }
            }
        }
        $conteudo .= "</tr>
                </tbody>
            </table>";
        $conteudo .= '<p>'.$cultura->getParcelamentoNPK().'</p>
                    <a class="btn btn-success" target="_blank" href="../controllers/AppController.php?a='.base64_encode(14).'&p=1">Gerar PDF</a>
                </div>
            </div>
            <script>
                $(document).ready(function(){
                    $("#iInfo").addClass("active");
                });
            </script>';
        
        require_once '../template/template.php';
    }
}