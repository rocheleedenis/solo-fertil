<?php

class SoilChemicalAnalysisInterpretationController
{
    /**
     * @return void
     */
    public static function show()
    {
        $pdf = (filter_input(INPUT_GET, 'p') == 1);

		if (!isset($_SESSION['sf']['analise'])) {
			ViewApp::mensagem("Você precisa memorizar alguma análise primeiro!", "Interpretação de análise de solo", 3);
		} else {
            $analise = unserialize($_SESSION['sf']['analise']);
			$r = $analise->interpretacao();
            if (!empty($analise->getId())) {
                $r['produtor'] = $analise->selectOne($analise->getId());
            }
			ViewAnalise::interpretacaoResult($r, $pdf);
		}
	}
}
