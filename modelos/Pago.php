<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Pago{

	//constructor
	public function _construct(){

	}

	//metodo para insertar
	public function insertar( $monto, $capital, $id_prestamo, $id_usuario){

		$sql="INSERT INTO pago ( monto, capital, id_prestamo, id_usuario, fecha_creacion) 
        VALUES ('$monto','$capital','$id_prestamo','$id_usuario',NOW())";

		return ejecutarConsulta($sql);
		
		//return $sql;
	}

	public function listar(){
		$sql="SELECT * FROM pago ";

		return ejecutarConsulta($sql);
	}

	//metodo para mostrar los datos de uno especifico
	public function mostrar($id_pago){
		$sql="SELECT * FROM pago WHERE id_pago='$id_pago'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function cuotas($id_prestamo){
		$sql="SELECT * FROM pago WHERE id_prestamo='$id_prestamo'";

		return ejecutarConsulta($sql);
	}

	public function ultimoId(){

		$sql="SELECT id_pago FROM pago ORDER BY id_pago desc LIMIT 1";
		
		return ejecutarConsultaSimpleFila($sql);
	}

	public function ultimoPago(){

		$sql="SELECT * FROM pago ORDER BY id_pago desc LIMIT 1";
		
		return ejecutarConsultaSimpleFila($sql);
	}

	public function ultimoPagoFactura($id_pago){
		$sql="SELECT * FROM pago WHERE id_pago='$id_pago'";

		return ejecutarConsultaSimpleFila($sql);
	}

}

?>