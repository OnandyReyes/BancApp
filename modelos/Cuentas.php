<?php
require "../config/conexion.php";

Class Cuentas{
    //constructor
	public function _construct(){

	}
	
	//metodo para insertar
	public function insertar($usuario, $clave, $id_cuenta_tipo, $id_usuario, $estado, $titulo_ticket, $imei, $comision, $prueba){
		
		//Aqui hay que hacer pila de codigo antes de guardar la venta

		$sql="INSERT INTO cuentas (usuario, clave, id_cuenta_tipo, id_usuario, estado, titulo_ticket, imei, comision, prueba) 
        VALUES ('$usuario','$clave','$id_cuenta_tipo','$id_usuario','$estado','$titulo_ticket','$imei','$comision','$prueba')";
		
		return ejecutarConsulta($sql);
	}
	
	//metodo para editar
	public function editar($usuario, $clave, $id_cuenta_tipo, $id_usuario, $estado, $titulo_ticket, $imei, $comision, $prueba){
		
		//Aqui hay que hacer pila de codigo antes de guardar la venta
		$sql="UPDATE cuentas SET usuario='$usuario',clave='$clave',id_cuenta_tipo='$id_cuenta_tipo',estado='$estado',titulo_ticket='$titulo_ticket',imei='$imei,comision='$comision',prueba='$prueba'' WHERE id_usuario='$id_usuario' ";
		

		return ejecutarConsulta($sql);
    }

	//metodo para insertar
	public function verificarCuentaPorImei($imei){

		$sql="SELECT * FROM cuentas cu INNER JOIN usuarios us on us.id_usuario = cu.id_usuario INNER JOIN grupos_usuarios gu on gu.id_usuario = us.id_usuario WHERE cu.imei = '$imei' ";
		
        return ejecutarConsultaSimpleFila($sql);
	}

	public function verificar($usuario,$clave){
		$sql= "SELECT * FROM cuentas cu INNER JOIN usuarios us on us.id_usuario = cu.id_usuario WHERE cu.usuario='$usuario' and cu.clave='$clave' AND cu.estado='1' ";

		return ejecutarConsulta($sql);
	}

	public function seleccionar($id_usuario){
		$sql= "SELECT * FROM cuentas cu INNER JOIN usuarios us on us.id_usuario = cu.id_usuario INNER JOIN grupos_usuarios gu on gu.id_usuario = us.id_usuario WHERE cu.id_usuario='$id_usuario' ";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listaVendedores(){
		$sql= "SELECT * FROM cuentas cu 
		INNER JOIN usuarios us on us.id_usuario = cu.id_usuario 
		INNER JOIN grupos_usuarios gu on gu.id_usuario = us.id_usuario 
		INNER JOIN cuentas_tipos ct on ct.id_cuenta_tipo = cu.id_cuenta_tipo WHERE cu.id_cuenta_tipo = 2 AND cu.estado = 1 ORDER by us.nombres";

		return ejecutarConsulta($sql);
	}

	public function listaVendedoresFiltro($id_usuario){
		$sql= "SELECT * FROM cuentas cu 
		INNER JOIN usuarios us on us.id_usuario = cu.id_usuario 
		INNER JOIN grupos_usuarios gu on gu.id_usuario = us.id_usuario 
		INNER JOIN cuentas_tipos ct on ct.id_cuenta_tipo = cu.id_cuenta_tipo 
		WHERE cu.id_cuenta_tipo = 2 AND cu.estado = 1 AND us.id_usuario = '$id_usuario' ORDER by us.nombres";

		return ejecutarConsulta($sql);
	}
}
?>