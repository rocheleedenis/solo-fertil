<?php

class PlantingProductivityController
{
    /**
     * @return void
     */
    public static function index()
    {
        $produtores = Produtor::selectAll($_SESSION['sf']['userId']);

        $culturas = Cultura::selectAll();

        ViewProducao::formProdutividade($culturas, $produtores);
    }

    /**
     * @return void
     */
    public static function show()
    {
        $producoes = Producao::selectProdutividade($_POST);

        empty($producoes)
            ? ViewApp::mensagem("Nenhuma produção encontrada.", "Gráficos da produtividade", 3)
            : ViewProducao::produtividade($producoes);
    }
}
