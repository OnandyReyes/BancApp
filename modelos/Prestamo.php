<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Prestamo{

	//constructor
	public function _construct(){

	}

	//metodo para insertar
	public function insertar($id_prestamo_tipo, $monto, $capital, $interes, $cuotas, $fecha_inicio, $fecha_fin, $id_usuario, $id_cliente, $pago){

		$sql="INSERT INTO prestamo (id_prestamo_tipo, monto, capital, interes, cuotas, fecha_inicio, fecha_fin, id_usuario, id_cliente, fecha_creacion, pago) VALUES ('$id_prestamo_tipo','$monto','$capital','$interes','$cuotas','$fecha_inicio','$fecha_fin','$id_usuario','$id_cliente',NOW(),'$pago')";

		return ejecutarConsulta($sql);
		
		//return $sql;
	}

	//metodo para listar los datos
	public function listar(){
		$sql="SELECT p.id_prestamo, p.id_prestamo_tipo, p.monto, p.capital, p.interes, p.cuotas, DATE(p.fecha_inicio) as fecha_fin, DATE(p.fecha_creacion) as fecha, p.pago, c.nombres as cliente_nombres, c.apellidos as cliente_apellidos, pt.nombre as prestamo_tipo, c.apodo, c.ocupacion FROM prestamo p inner join usuario c on c.id_usuario = p.id_cliente inner join prestamo_tipo pt on pt.id_prestamo_tipo = p.id_prestamo_tipo";

		return ejecutarConsulta($sql);
	}

	public function actualizarCapital($id_prestamo, $capital){
		$sql = "UPDATE prestamo SET capital = '$capital' WHERE id_prestamo = '$id_prestamo'";

		return ejecutarConsulta($sql);
	}

	public function listarCliente($id_cliente){
		$sql = "SELECT * FROM prestamo WHERE id_cliente = '$id_cliente'";

		return ejecutarConsulta($sql);
	}

	public function listarClientePendiente($id_cliente){
		$sql = "SELECT * FROM prestamo WHERE id_cliente = '$id_cliente' and pago = 0";

		return ejecutarConsulta($sql);
	}

	public function quincenalEscritorio(){
		$sql="SELECT p.id_prestamo, p.id_prestamo_tipo, p.monto, p.capital, p.interes, DATE(p.fecha_inicio) as fecha_fin, DATE(p.fecha_creacion) as fecha, p.pago, c.nombres as cliente_nombres, c.apellidos as cliente_apellidos, pt.nombre as prestamo_tipo, pa.id_pago FROM prestamo p inner join usuario c on c.id_usuario = p.id_cliente inner join prestamo_tipo pt on pt.id_prestamo_tipo = p.id_prestamo_tipo left join pago pa on pa.id_prestamo = p.id_prestamo WHERE DAY(CURDATE()) = DAY(p.fecha_creacion) AND p.pago = 0 AND p.id_prestamo_tipo = 2 group by p.id_prestamo order by c.nombres asc, c.apellidos asc";

		return ejecutarConsulta($sql);
	}

	public function verificarPago($id_prestamo){
		$sql= "SELECT id_usuario FROM pago WHERE id_prestamo='$id_prestamo' and DAY(CURDATE()) = DAY(fecha_creacion) ";

		$respuesta = ejecutarConsulta($sql);

		$row_cnt = $respuesta->num_rows;

		return $row_cnt;
	}
	

	//metodo para mostrar los datos de uno especifico
	public function mostrar($id_prestamo){
		$sql="SELECT * FROM prestamo WHERE id_prestamo='$id_prestamo'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function selectClientePendiente($id_cliente){
		$sql="SELECT * FROM prestamo p where p.pago = 0 and p.id_cliente = '$id_cliente'";

		return ejecutarConsulta($sql);
	}
	

	//metodo para eliminar
	public function eliminar($id_prestamo){
		$sw=true;

		$sql= "DELETE FROM prestamo WHERE id_prestamo = '$id_prestamo' ";

		ejecutarConsulta($sql) or $sw = false;

		return $sw;
	}

}

?>