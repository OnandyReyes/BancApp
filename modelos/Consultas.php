<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Consultas{

	//constructor
	public function _construct(){

	}

	//metodo para listar los datos
	public function entradaProductosFecha($fecha_inicio,$fecha_fin){
		$sql="SELECT pe.id_producto_existencia,DATE(pe.fecha_creacion) as fecha, u.nombres, u.apellidos FROM producto_existencia pe inner join usuario u on pe.id_usuario = u.id_usuario WHERE DATE(pe.fecha_creacion) >= '$fecha_inicio' AND DATE(pe.fecha_creacion) <= '$fecha_fin' ";

		return ejecutarConsulta($sql);
	}

	public function cuadreDia(){
		$sql = "SELECT SUM(vd.cantidad * vd.precio) as total, c.id_usuario, c.nombres, c.apellidos, c.cedularnc FROM venta v INNER JOIN usuario c on c.id_usuario = v.id_cliente inner join venta_detalle vd on vd.id_venta = v.id_venta WHERE v.id_venta_tipo = 1 and DATE(fecha_creacion)=curdate() GROUP BY c.id_usuario order by c.nombres ";

		return ejecutarConsulta($sql);
	}

	public function reciboClienteDia(){
		$sql = "SELECT ifnull(SUM(r.monto),0.00) as total, u.nombres, u.apellidos, u.cedularnc, u.id_usuario  FROM recibo r inner join usuario u on u.id_usuario = r.id_cliente WHERE DATE(r.fecha_creacion) = curdate() group by r.id_cliente  ";

		return ejecutarConsulta($sql);
	}

	public function reciboClienteDiaId($id_cliente){
		$sql = "SELECT ifnull(SUM(r.monto),0.00) as total  FROM recibo r inner join usuario u on u.id_usuario = r.id_usuario WHERE r.id_cliente = '$id_cliente' and DATE(r.fecha_creacion) = curdate() group by r.id_cliente ";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function ventasFechasEmpleados($fecha_inicio,$fecha_fin){

		$sql="SELECT v.id_venta_documento, v.id_venta,DATE(v.fecha_creacion) as fecha, u.nombres as usuarios_nombres, u.apellidos as usuarios_apellidos, emple.nombres as empleados_nombres, emple.apellidos as empleados_apellidos,sum(vd.cantidad * vd.precio) as total,v.pagada,c.nombres as clientes_nombres,c.apellidos as clientes_apellidos, vt.nombre as venta_tipo, v.id_venta_tipo FROM venta v inner join venta_detalle vd on v.id_venta = vd.id_venta inner join usuario c on v.id_cliente = c.id_usuario inner join usuario u on v.id_usuario = u.id_usuario inner join venta_tipo vt on v.id_venta_tipo = vt.id_venta_tipo inner join pedido pedi on pedi.id_pedido = v.id_pedido inner join usuario emple on emple.id_usuario = pedi.id_usuario  WHERE DATE(v.fecha_creacion) >= '$fecha_inicio' AND DATE(v.fecha_creacion) <= '$fecha_fin' GROUP BY v.id_venta ";

		return ejecutarConsulta($sql);
	}

	public function ventasFechasEmpleado($fecha_inicio,$fecha_fin,$id_empleado){

		$sql="SELECT v.id_venta_documento, v.id_venta,DATE(v.fecha_creacion) as fecha, u.nombres as usuarios_nombres, u.apellidos as usuarios_apellidos, emple.nombres as empleados_nombres, emple.apellidos as empleados_apellidos,sum(vd.cantidad * vd.precio) as total,v.pagada,c.nombres as clientes_nombres,c.apellidos as clientes_apellidos, vt.nombre as venta_tipo, v.id_venta_tipo FROM venta v inner join venta_detalle vd on v.id_venta = vd.id_venta inner join usuario c on v.id_cliente = c.id_usuario inner join usuario u on v.id_usuario = u.id_usuario inner join venta_tipo vt on v.id_venta_tipo = vt.id_venta_tipo inner join pedido pedi on pedi.id_pedido = v.id_pedido inner join usuario emple on emple.id_usuario = pedi.id_usuario  WHERE DATE(v.fecha_creacion) >= '$fecha_inicio' AND DATE(v.fecha_creacion) <= '$fecha_fin' AND emple.id_usuario = '$id_empleado' GROUP BY v.id_venta ";

		return ejecutarConsulta($sql);
	}

	public function ventasFechasRuta($fecha_inicio,$fecha_fin,$id_ruta){

		$sql="SELECT v.id_venta_documento, v.id_venta,DATE(v.fecha_creacion) as fecha, u.nombres as usuarios_nombres, u.apellidos as usuarios_apellidos, emple.nombres as empleados_nombres, emple.apellidos as empleados_apellidos,sum(vd.cantidad * vd.precio) as total,v.pagada,c.nombres as clientes_nombres,c.apellidos as clientes_apellidos, vt.nombre as venta_tipo, v.id_venta_tipo FROM venta v inner join venta_detalle vd on v.id_venta = vd.id_venta inner join usuario c on v.id_cliente = c.id_usuario inner join usuario u on v.id_usuario = u.id_usuario inner join venta_tipo vt on v.id_venta_tipo = vt.id_venta_tipo inner join pedido pedi on pedi.id_pedido = v.id_pedido inner join usuario emple on emple.id_usuario = pedi.id_usuario  WHERE DATE(v.fecha_creacion) >= '$fecha_inicio' AND DATE(v.fecha_creacion) <= '$fecha_fin' AND c.id_ruta= '$id_ruta' GROUP BY v.id_venta ";

		return ejecutarConsulta($sql);
	}

	public function ventasFechasEmpleadoRuta($fecha_inicio,$fecha_fin,$id_empleado,$id_ruta){

		$sql="SELECT v.id_venta_documento, v.id_venta,DATE(v.fecha_creacion) as fecha, u.nombres as usuarios_nombres, u.apellidos as usuarios_apellidos, emple.nombres as empleados_nombres, emple.apellidos as empleados_apellidos,sum(vd.cantidad * vd.precio) as total,v.pagada,c.nombres as clientes_nombres,c.apellidos as clientes_apellidos, vt.nombre as venta_tipo, v.id_venta_tipo FROM venta v inner join venta_detalle vd on v.id_venta = vd.id_venta inner join usuario c on v.id_cliente = c.id_usuario inner join usuario u on v.id_usuario = u.id_usuario inner join venta_tipo vt on v.id_venta_tipo = vt.id_venta_tipo inner join pedido pedi on pedi.id_pedido = v.id_pedido inner join usuario emple on emple.id_usuario = pedi.id_usuario  WHERE DATE(v.fecha_creacion) >= '$fecha_inicio' AND DATE(v.fecha_creacion) <= '$fecha_fin' AND emple.id_usuario = '$id_empleado' AND c.id_ruta= '$id_ruta' GROUP BY v.id_venta ";

		return ejecutarConsulta($sql);
	}

	public function ventasFechaCliente($fecha_inicio,$fecha_fin,$id_cliente){

		$sql="SELECT v.id_venta_documento, v.id_venta,DATE(v.fecha_creacion) as fecha, IFNULL(sum(r.monto),v.total) as abonado, u.nombres as usuarios_nombres, u.apellidos as usuarios_apellidos,v.total,v.pagada,c.nombres as clientes_nombres,c.apellidos as clientes_apellidos, vt.nombre as venta_tipo, v.id_venta_tipo FROM venta v inner join usuario c on v.id_cliente = c.id_usuario inner join usuario u on v.id_usuario = u.id_usuario inner join venta_tipo vt on v.id_venta_tipo = vt.id_venta_tipo left join recibo r on v.id_venta = r.id_venta WHERE DATE(v.fecha_creacion) >= '$fecha_inicio' AND DATE(v.fecha_creacion) <= '$fecha_fin' AND v.id_cliente= '$id_cliente' ";

		return ejecutarConsulta($sql);
	}

	public function ventasDetalle($id_venta){

		$sql="SELECT SUM(p.costo * vd.cantidad) as costo  FROM venta_detalle vd inner JOIN producto p on p.id_producto = vd.id_producto WHERE vd.id_venta = '$id_venta' ";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function ventasClienteHoy($id_cliente){

		$sql="SELECT v.id_venta  FROM venta v WHERE v.id_cliente = '$id_cliente' and DATE(v.fecha_creacion)=curdate() ";

		return ejecutarConsulta($sql);
	}

	public function ventasFecha($fecha_inicio,$fecha_fin){

		$sql="SELECT v.id_venta_documento, v.id_venta,DATE(v.fecha_creacion) as fecha, u.nombres as usuarios_nombres, u.apellidos as usuarios_apellidos, sum(vd.cantidad * vd.precio) as total ,v.pagada,c.nombres as clientes_nombres,c.apellidos as clientes_apellidos, vt.nombre as venta_tipo, v.id_venta_tipo FROM venta v inner join venta_detalle vd on vd.id_venta = v.id_venta inner join producto pro on pro.id_producto = vd.id_producto inner join usuario c on v.id_cliente = c.id_usuario inner join usuario u on v.id_usuario = u.id_usuario inner join venta_tipo vt on v.id_venta_tipo = vt.id_venta_tipo WHERE DATE(v.fecha_creacion) >= '$fecha_inicio' AND DATE(v.fecha_creacion) <= '$fecha_fin' group by v.id_venta ";

		return ejecutarConsulta($sql);
	}

	public function ventasCreditoFechaCliente($fecha_inicio,$fecha_fin,$id_cliente){

		$sql="SELECT v.id_venta_documento, v.id_venta,DATE(v.fecha_creacion) as fecha, sum(r.monto) as abonado, u.nombres as usuarios_nombres, u.apellidos as usuarios_apellidos,v.total,v.pagada,c.nombres as clientes_nombres,c.apellidos as clientes_apellidos, vt.nombre as venta_tipo, v.id_venta_tipo FROM venta v inner join recibo r on v.id_venta = r.id_venta inner join usuario c on v.id_cliente = c.id_usuario inner join usuario u on v.id_usuario = u.id_usuario inner join venta_tipo vt on v.id_venta_tipo = vt.id_venta_tipo WHERE DATE(v.fecha_creacion) >= '$fecha_inicio' AND DATE(v.fecha_creacion) <= '$fecha_fin' AND v.id_cliente= '$id_cliente' and v.pagada = '0' GROUP by v.id_venta  ";

		return ejecutarConsulta($sql);
	}

	public function ventahoy(){
		$sql = "SELECT iFNULL(((SELECT IFNULL(SUM(v.total),0.00) FROM venta v WHERE id_venta_tipo = 1 AND DATE(v.fecha_creacion)=curdate()) + (SELECT IFNULL(SUM(r.monto),0.00) FROM recibo r WHERE DATE(r.fecha_creacion) = curdate())),0.00) as total ";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function venta7dias(){
		$sql = "SELECT CONCAT(MONTH(v.fecha_creacion),'-',DAY(v.fecha_creacion)) as fecha, DATE(v.fecha_creacion) as fecha_creacion , SUM(v.total) as total from venta v WHERE v.id_venta_tipo = 1 GROUP by DATE(v.fecha_creacion) ORDER BY DATE(v.fecha_creacion) DESC limit 0,7 ";
		return ejecutarConsulta($sql);
	}

	public function venta12meses(){
		$sql = "SELECT MONTH(v.fecha_creacion) as fecha, DATE(v.fecha_creacion) as fecha_creacion, SUM(v.total) as total from venta v WHERE v.id_venta_tipo = 1 GROUP by MONTH(v.fecha_creacion) ORDER BY v.fecha_creacion DESC limit 0,12 ";
		return ejecutarConsulta($sql);
	}

	public function recibofecha($fecha_creacion){
		$sql = "SELECT IFNULL(SUM(r.monto),0.00) as monto FROM recibo r WHERE DATE(r.fecha_creacion) = '$fecha_creacion' ";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function recibofechames($fecha_creacion){
		$sql = "SELECT IFNULL(SUM(r.monto),0.00) as monto FROM recibo r WHERE MONTH(r.fecha_creacion) = MONTH('$fecha_creacion') ";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function totalpedidohoy(){
		$sql = "SELECT IFNULL(SUM(total),0) as total from pedido WHERE DATE(fecha_creacion)=curdate()";
		return ejecutarConsulta($sql);
	}

	public function totalventahoy(){
		$sql = "SELECT IFNULL(SUM(total),0) as total from venta WHERE DATE(fecha_creacion)=curdate() and pagada = '1' ";
		return ejecutarConsulta($sql);
	}

	public function totalrecibohoy(){
		$sql = "SELECT IFNULL(SUM(monto),0) as total from recibo WHERE DATE(fecha_creacion)=curdate()";
		return ejecutarConsulta($sql);
	}

	public function pedidoultimos_10dias(){
		$sql = "SELECT CONCAT(MONTH(fecha_creacion),'-',DAY(fecha_creacion)) as fecha, SUM(total) as total from pedido GROUP by DATE(fecha_creacion) ORDER BY fecha_creacion DESC limit 0,10";
		return ejecutarConsulta($sql);
	}

	public function ventaultimos_7dias(){
		$sql = "SELECT CONCAT(MONTH(fecha_creacion),'-',DAY(fecha_creacion)) as fecha, SUM(cantidad_pagada) as total from venta GROUP by DATE(fecha_creacion) ORDER BY fecha_creacion DESC limit 0,7";
		return ejecutarConsulta($sql);
	}

	public function ventaultimos_12meses(){
		$sql = "SELECT MONTH(fecha_creacion) as fecha, SUM(cantidad_pagada) as total from venta GROUP by MONTH(fecha_creacion) ORDER BY fecha_creacion DESC limit 0,12";
		return ejecutarConsulta($sql);
	}

}

?>