<?php

  	require_once "../../_lib/mpdf60/mpdf.php";

class ViewAnalisePDF extends mPDF {

    protected static function interpretacao($analise, $r){
        $conteudo = '<header>
                        <h3 class="panel-tittle">Interpretação de análise de solo</h3>
                    </header>';
        if(isset($r['produtor'])){
            $conteudo .= '<div id="cabecalho">
                    <h3>Identificação da análise</h3>
                    <table id="identificacao-table">
                        <tr>
                            <td><strong>Produtor:</strong> '.$r['produtor']['nome'].'</td>
                            <td><strong>Fazenda:</strong> '.$r['produtor']['fazenda'].'</td>
                        </tr>
                        <tr>
                            <td><strong>Data:</strong> '.$analise->getData().'</td>
                            <td><strong>Local:</strong> '.$analise->getLocal().'</td>
                        </tr>
                        <tr>
                            <td><strong>Profundidade:</strong> '.$analise->getProfundidade().' cm</td>
                        </tr>
                    </table>
                </div>';
        }
        $conteudo .='<br><p>Resultado da interpretação da análise:</p>
                    <table id="table-doc">
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
                    </div>';
        return $conteudo;
    }

    public static function analise($analise, $produtor){
        $conteudo = '<header>
                        <h3 class="panel-tittle">Análise laboratorial de solo</h3>
                    </header>
                <div id="cabecalho">
                    <h3>Identificação da análise</h3>
                    <table id="identificacao-table">
                        <tr>
                            <td><strong>Produtor:</strong> '.$produtor['nome'].'</td>
                            <td><strong>Fazenda:</strong> '.$produtor['fazenda'].'</td>
                        </tr>
                        <tr>
                            <td><strong>Data:</strong> '.$analise->getData().'</td>
                            <td><strong>Local:</strong> '.$analise->getLocal().'</td>
                        </tr>
                        <tr>
                            <td><strong>Profundidade:</strong> '.$analise->getProfundidade().' cm</td>
                        </tr>
                    </table>
                </div>
                    <table id="table-doc">
                        <thead>
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
                </div>
            </div>';
        return $conteudo;
    }
    // ----------------- Chamadores ------------------
    public static function interpretacaoResult($analise, $r){
        $mpdf = new mpdf('','A4',12,'dejavusans');
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents('../template/css/cssPDF.css');
        // The parameter 1 tells that this is css/style only and no body/html/text
        $mpdf->WriteHTML($css,1);

        // titulo da aba
        $mpdf->SetTitle('Interpretação de análise - SoloFértil');

        // titulo do conteudo
        date_default_timezone_set("Brazil/East");
        $data = date('j-m-Y');
        $mpdf->defaultheaderfontstyle='B';
        $mpdf->SetHeader('Interpretação de análise de solo|'.$data.'|{PAGENO}');

        // rodape do conteudo
        $mpdf->SetFooter('Gerado pelo SoloFértil - Sistema de Interpretação de Análise de Solo');

        $mpdf->WriteHTML(self::interpretacao($analise, $r));

        $mpdf->Output('Interpretacao-Analise_'.$data = date('j-m-Y').'.pdf', 'I');
        exit;
    }

    public static function consultarAnalise($analise, $produtor){
        $mpdf = new mpdf('','A4-P',12,'dejavusans');
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents('../template/css/cssPDF.css');
        // The parameter 1 tells that this is css/style only and no body/html/text
        $mpdf->WriteHTML($css,1);

        // titulo da aba
        $mpdf->SetTitle('Análise laboratorial de solo - SoloFértil');

        // titulo do conteudo
        date_default_timezone_set("Brazil/East");
        $data = date('j-m-Y');
        $mpdf->defaultheaderfontstyle='B';
        $mpdf->SetHeader('Análise laboratorial de solo|'.$data.'|{PAGENO}');

        // rodape do conteudo
        $mpdf->SetFooter('Gerado pelo SoloFértil - Sistema de Interpretação de Análise de Solo');

        $mpdf->displayDefaultOrientation = false;

        $mpdf->WriteHTML(self::analise($analise, $produtor));

        $mpdf->Output('Analise-Solo_'.$data = date('j-m-Y').'.pdf', 'I');
        exit;
    }
}