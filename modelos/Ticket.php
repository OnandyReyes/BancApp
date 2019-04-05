<?php
require "../config/conexion.php";

Class Ticket{
    //constructor
	public function _construct(){

    }
    
    //metodo para insertar
	public function insertar($serial,$id_usuario,$jugadas){
		
		//Aqui hay que hacer pila de codigo antes de guardar la venta
		
		$sw = true;

		$sql="INSERT INTO tickets (serial, fecha_creacion, id_usuario, anular) VALUES ('$serial',NOW(),'$id_usuario','0')";
		
		$id_ticket = ejecutarConsulta_retornarID($sql);
		
		$num_elementos=0;
		$sw=true;
		
		//$numero,$numero2,$numero3,$monto,$id_loteria_sub,$sorteo
		foreach($jugadas as $row)
        {
			$sql_detalle = "INSERT INTO tickets_detalles (id_ticket,numero,numero2,numero3,monto,id_loteria_sub,sorteo) VALUES ('$id_ticket','$row["Numero1"]','$row["Numero2"]','$row["Numero3"]','$row["Monto"]','$row["LoteriaId"]','0')";
			ejecutarConsulta($sql_detalle) or $sw = false;
		}

		return $sw;
	}
}
?>