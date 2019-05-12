<?php
Class Configuracion{
    //constructor
	public function _construct(){

    }
    
    public function seleccionar(){

		$sql="SELECT * FROM configuracion ORDER BY id_configuracion desc LIMIT 1";
		
		return ejecutarConsultaSimpleFila($sql);
	}

	
}
?>