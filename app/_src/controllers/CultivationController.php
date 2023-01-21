<?php

class CultivationController
{
    /**
     * @return void
     */
    public static function index()
    {
    	$culturas = Cultura::selectAll();

    	ViewCultura::formSelecionarInfo($culturas);
    }

    /**
     * @return void
     */
	public static function show()
    {
        $pdf = filter_input(INPUT_GET, 'p');

        if (!$pdf) {
        	$cultura = new Cultura();
        	$cultura->selectOne(filter_input(INPUT_GET, 'id'));
            $_SESSION['sf']['cultura'] = serialize($cultura);
        } else {
        	$cultura = unserialize($_SESSION['sf']['cultura']);
        }

        ViewCultura::infoCultura($cultura, $pdf);
    }
}
