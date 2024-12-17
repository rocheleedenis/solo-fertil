<?php 

    require_once "../../_lib/mpdf60/mpdf.php";

class ViewCulturaPDF extends mPDF{

    public static function sugestaoAdubacao($r, $cultura, $adubo){
        $conteudo = '<header>
                    <h3 class="panel-tittle">Sugestão de adubação para <strong>'.$cultura->getNome().'</strong></h3>
                </header>
                <div id="corpo">
                    <p><strong>Calagem</strong>: </p>
                    <ul>
                        <li>'.$cultura->getCalagem().'</li>
                        <li>Quantidade de calcário necessária calculada através do método da <strong>neutralização do Al<sup>3+</sup></strong>: '.$r['calagemAl'].' t/ha.</li> 
                        <li>Quantidade de calcário necessária calculada através do método da <strong>saturação por bases</strong>: '.$r['calagemBas'].' t/ha.</li> 
                    </ul>
                    <p><strong>Adubação orgânica</strong>: '.$cultura->getAdubOrganica().'</p>
                    <p><strong>Adubação mineral</strong>:</p>
                        
                    <ul>
                        <li><strong>Quantidade de N: </strong>'.$r['qtdeN'].' kg/ha;</li>
                        <li><strong>Quantidade de P<sub>2</sub>O<sub>5</sub>: </strong>'.$r['qtdeP2O5'].' kg/ha;</li>
                        <li><strong>Quantidade de K<sub>2</sub>O: </strong>'.$r['qtdeK2O'].' kg/ha;</li>
                        <li><strong>Fórmula simplificada de N-P-K: </strong>'.$r['formulacao'].'.</li>
                    </ul>
                    <p><strong>Parcelamento da adubação mineral</strong>:</p>';
        if (count($cultura->getParcNPKtable())>0){
            $conteudo .= '
                <table id="table-doc">
                    <thead>
                        <tr>
                            <th>Nutriente</th>
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
                        <td></td>
                        <td colspan=".++$cont."> &#37; do total indicado acima</td>
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
            $conteudo .= "</tr>
                </tbody>
            </table>";
        }        
        $conteudo .= '<p>'.$cultura->getParcelamentoNPK().'</p></div>';       
        if($adubo != null){
            $conteudo .= "<header>
                    <h3>Simulação da compra de fertilizantes</h3>
                </header>
                <p><strong>Tipo de fertilizante: </strong>";

            // echo $adubo['nFertilizante'];die();
            
            if ($adubo['nFertilizante']=='s') {
                $conteudo .= "Simples</p>
                    <p><strong>Quantidade de ";
                $conteudo.= ($adubo['nNitrogenio']=='u')?'ureia: </strong>':'sulfato de amônia: </strong>';
                $conteudo.= $adubo['nNitrokg']."</p>
                    <p><strong>Quantidade de ";
                if ($adubo['nP2O5']=='s') {
                    $conteudo .= "superfosfato simples: </strong>";
                }elseif ($adubo['nP2O5']=='t') {
                    $conteudo .= "superfosfato triplo: </strong>";
                }else{
                    $conteudo .= "fosfato natural: </strong>";
                }
                $conteudo .= $adubo['nP2O5kg']."</p>
                    <p><strong>Quantidade de cloreto de potássio: </strong>".$adubo['nK2Okg']."</p>";
            }else{
                $conteudo.="Misto</p>
                    <p><strong>Formulação: </strong>".$adubo['nFormulacao']."</p>
                    <p><strong>Quantidade da mistura: </strong>".$adubo['nMisturakg']."</p>";
            }
        }
        return $conteudo;
    }

    public static function informacoesCultura($cultura){
        $conteudo = '<header>
                    <h3 class="panel-tittle">Informações do plantio de '.$cultura->getNome().'</strong></h3>
                </header>
                <div id="corpo">
                    <p><strong>Família: </strong><i>'.$cultura->getFamilia().'</i>
                    <p><strong>Produção esperada por hectare: </strong>'.$cultura->getProducaoEsperada().'</p>
                    <p><strong>Espaçamento: </strong>'.$cultura->getEspacamento().'</p>
                    <p><strong>Calagem: </strong>'.$cultura->getCalagem().'</p> 
                    <p><strong>Adubação orgânica: </strong>'.$cultura->getAdubOrganica().'</p>
                    <p><strong>Adubação mineral:</strong></p>
                    <table id="table-doc">
                        <thead>
                            <tr>';
        if ($cultura->getAdubMineralTable()[0]['p2o5soloArgiloso']!=null) {
            $conteudo .= '<th rowspan="3">Disponibilidade de P ou de K</th>
                            <th colspan="3">Textura do Solo</th>
                            <th colspan="2"></th>
                        <tr>
                            <th>Argilosa</th>
                            <th>Média</th>
                            <th>Arenosa</th>
                            <th colspan="2">Dose total<br></th>
                        </tr>
                        <tr>
                            <th colspan="3">- Dose de P<sub>2</sub>O<sub>5</sub> -</th>
                            <th>K<sub>2</sub>O</th>
                            <th>N</th>
                        </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td colspan="5">kg/ha</td>
                    </tr>';
            
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
            $conteudo .= '<th rowspan="2">Disponibilidade de P ou de K</th>
                        <th colspan="3">Dose total<br></th>
                    </tr>
                    <tr>
                        <th>P<sub>2</sub>O<sub>5</sub></th>
                        <th>K<sub>2</sub>O</th>
                        <th>N</th>
                    <tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td colspan="3">kg/ha</td>
                    </tr>';
        
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
                    </table>';
        if (count($cultura->getParcNPKtable())){
            $conteudo .= '<br><p><strong>Parcelamento da adubação mineral:</strong></p>
            <table id="table-doc">
                <thead>
                    <tr>
                        <th>Nutriente</th>
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
                        <th></th>
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
        $conteudo .= "</tr>
                </tbody>
            </table>";
        $conteudo .= '<p>'.$cultura->getParcelamentoNPK().'</p>
            </div>';
        return $conteudo;
    }

    public static function sugestaoCultura($r, $info){
        $conteudo = '<header>
                    <h3 class="panel-tittle">Sugestão de sucessão de cultura</strong></h3>
                </header>
                <div id="corpo">';
        if (count($r)){
            $conteudo .= '<p>Culturas sugeridas posicionadas em ordem ascendente:</p>
                <table id="table-doc">
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
                </table>";
        }else{
            $conteudo .= "<p><strong>Nenhuma cultura para ser sugerida.</strong></p>";
        }
        $conteudo .= '</div>';
        return $conteudo;
    }
    // ----------------- Chamadores ------------------

    public static function sugerirAdubacao($r, $cultura, $adubo){
        $mpdf = new mpdf('','A4',12,'dejavusans');
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents('../template/css/cssPDF.css');
        // The parameter 1 tells that this is css/style only and no body/html/text
        $mpdf->WriteHTML($css,1);
        
        // titulo da aba
        $mpdf->SetTitle('Sugestão de adubação - SoloFértil');

        // titulo do conteudo
        date_default_timezone_set("Brazil/East");
        $data = date('j-m-Y');
        $mpdf->defaultheaderfontstyle='B';
        $mpdf->SetHeader('Sugestão de adubação|'.$data.'|{PAGENO}');

        // rodape do conteudo
        $mpdf->SetFooter('Gerado pelo SoloFértil - Sistema de Interpretação de Análise de Solo');

        $mpdf->WriteHTML(self::sugestaoAdubacao($r, $cultura, $adubo));

        $mpdf->Output('Sugestao-Adubacao-'.$cultura->getNome().'_'.$data = date('j-m-Y').'.pdf', 'I');
        exit;
    }

    public static function sugerirCultura($r, $info){
        $mpdf = new mpdf('','A4',12,'dejavusans');
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents('../template/css/cssPDF.css');
        // The parameter 1 tells that this is css/style only and no body/html/text
        $mpdf->WriteHTML($css,1);
        
        // titulo da aba
        $mpdf->SetTitle('Sugestão de sucessão de cultura - SoloFértil');

        // titulo do conteudo
        date_default_timezone_set("Brazil/East");
        $data = date('j-m-Y');
        $mpdf->defaultheaderfontstyle='B';
        $mpdf->SetHeader('Sugestão de sucessão de cultura|'.$data.'|{PAGENO}');

        // rodape do conteudo
        $mpdf->SetFooter('Gerado pelo SoloFértil - Sistema de Interpretação de Análise de Solo');

        $mpdf->WriteHTML(self::sugestaoCultura($r, $cultura, $adubo));

        $mpdf->Output('Sugestao-Sucessao-Cultura_'.$data = date('j-m-Y').'.pdf', 'I');
        exit;
    }

    public static function infoCultura($cultura){
        $mpdf = new mpdf('','A4',12,'dejavusans');
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents('../template/css/cssPDF.css');
        // The parameter 1 tells that this is css/style only and no body/html/text
        $mpdf->WriteHTML($css,1);

                // titulo da aba
        $mpdf->SetTitle('Sugestão de adubação - SoloFértil');

        // titulo do conteudo
        date_default_timezone_set("Brazil/East");
        $data = date('j-m-Y');
        $mpdf->defaultheaderfontstyle='B';
        $mpdf->SetHeader('Informações de cultura||{PAGENO}');

        // rodape do conteudo
        $mpdf->SetFooter('Gerado pelo SoloFértil - Sistema de Interpretação de Análise de Solo');

        $mpdf->WriteHTML(self::informacoesCultura($cultura));

        $mpdf->Output($name, 'I');
        exit;
    }
}