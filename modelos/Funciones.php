<?php
Class Funciones{
    //constructor
	public function _construct(){

    }

    public function aumentarDigitoA2($numero){
        if(strlen($numero) == 1){
            $numero = "0".$numero;
        }
        return $numero;
    }

    public function descodificarJsonLimpiar($objetos){
        
        $objetos=isset($objetos)? limpiarCadena($objetos):"";

        return json_decode($objetos,true);
    }

    public function descodificarJson($objetos){

        return json_decode($objetos,true);
    }
	
}
?>