<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Cliente{

	//constructor
	public function _construct(){

	}

	//metodo para insertar
	public function insertar($nombres, $apellidos, $cedularnc, $direccion, $telefono, $celular, $id_cliente_tipo, $id_municipio, $id_usuario_tipo, $id_cliente_categoria,$ocupacion,$apodo){

		$id_venta_documento = 1;

		$sql="INSERT INTO usuario (nombres,apellidos,cedularnc,direccion,telefono,celular,estado,id_cliente_tipo,id_municipio,id_usuario_tipo, id_cliente_categoria, ocupacion, apodo) VALUES ('$nombres','$apellidos','$cedularnc','$direccion','$telefono','$celular','1','$id_cliente_tipo','$id_municipio','$id_usuario_tipo','$id_cliente_categoria','$ocupacion','$apodo')";

		return ejecutarConsulta($sql);
		
	}

	//metodo para editar
	public function editar($id_usuario,$nombres,$apellidos,$cedularnc,$direccion,$telefono,$celular,$id_cliente_tipo,$id_municipio,$id_usuario_tipo,$id_cliente_categoria,$ocupacion, $apodo){
		$sql="UPDATE usuario SET nombres='$nombres',apellidos='$apellidos',cedularnc='$cedularnc',direccion='$direccion',telefono='$telefono',celular='$celular', id_cliente_tipo='$id_cliente_tipo',id_municipio='$id_municipio',id_usuario_tipo='$id_usuario_tipo',id_cliente_categoria='$id_cliente_categoria',ocupacion='$ocupacion',apodo='$apodo' WHERE id_usuario='$id_usuario' ";

		return ejecutarConsulta($sql);
	}

	//metodo para desactivar
	public function desactivar($id_usuario){
		$sql="UPDATE usuario SET estado='0' WHERE id_usuario='$id_usuario'";

		return ejecutarConsulta($sql);
	}

	//metodo para eliminar
	public function eliminar($id_usuario){
		$sw=true;

		$sql= "DELETE FROM usuario WHERE id_usuario = '$id_usuario' ";

		ejecutarConsulta($sql) or $sw = false;

		return $sw;
	}

	//metodo para activar
	public function activar($id_usuario){
		$sql="UPDATE usuario SET estado='1' WHERE id_usuario='$id_usuario'";

		return ejecutarConsulta($sql);
	}

	//metodo para mostrar los datos de uno especifico
	public function mostrar($id_usuario){
		$sql="SELECT u.id_usuario,u.correo, u.nombres, u.apodo ,u.apellidos, u.cedularnc, u.direccion, u.telefono, u.celular, u.estado, u.id_cliente_tipo, u.id_municipio, m.nombre as municipio,p.id_provincia,p.nombre as provincia, u.id_usuario_tipo, u.id_cliente_categoria, u.ocupacion, cg.id_grupo FROM usuario u INNER JOIN municipio m on u.id_municipio = m.id_municipio INNER JOIN provincia p on m.id_provincia = p.id_provincia INNER JOIN usuario_tipo ut on u.id_usuario_tipo = ut.id_usuario_tipo LEFT JOIN cliente_grupo cg on cg.id_cliente = '$id_usuario' WHERE id_usuario='$id_usuario'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function UltimoID(){
		$sql="SELECT u.id_usuario as ultimo_id  FROM usuario u WHERE u.id_usuario_tipo = 2 ORDER BY u.id_usuario desc";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function clase($id_usuario){
		
		$sql="SELECT id_cliente_categoria as clase FROM `usuario` WHERE id_usuario = '$id_usuario' ";

		return ejecutarConsultaSimpleFila($sql);
	}


	public function cuentaxpagar($id_usuario){
		
		$sql="SELECT IFNULL(((select sum(vd.cantidad * vd.precio) from venta v INNER JOIN venta_detalle vd on vd.id_venta = v.id_venta WHERE v.id_cliente = '$id_usuario' AND v.id_venta_tipo = 2 ) - (select sum(r.monto) from recibo r WHERE r.id_cliente = '$id_usuario' )),0.00) as total_deuda ";

		return ejecutarConsultaSimpleFila($sql);
	}

		

	//metodo para listar los datos
	public function listar(){
		$sql="SELECT u.id_usuario,u.nombres,u.apellidos,ct.nombre as tipo,u.cedularnc,u.estado FROM usuario u INNER JOIN cliente_tipo ct ON u.id_cliente_tipo = ct.id_cliente_tipo WHERE id_usuario_tipo = 2 ";

		return ejecutarConsulta($sql);
	}

	//metodo para listar los datos para select
	public function select(){
		$sql="SELECT * FROM usuario where estado = 1 and id_usuario_tipo = 2 ";

		return ejecutarConsulta($sql);
	}

	public function selectClienteCategoria(){
		$sql="SELECT * FROM cliente_categoria ";

		return ejecutarConsulta($sql);
	}

	public function validarcedularnc($cedularnc){
		$sql= "SELECT id_usuario FROM usuario WHERE cedularnc='$cedularnc' ";

		$respuesta = ejecutarConsulta($sql);

		$row_cnt = $respuesta->num_rows;

		return $row_cnt;
	}

	public function validarcorreo($correo){
		$sql= "SELECT id_usuario FROM usuario WHERE correo='$correo' ";

		$respuesta = ejecutarConsulta($sql);
		
		$row_cnt = $respuesta->num_rows;

		return $row_cnt;
	}

	public function listaChat(){
		$sql="SELECT c.id_usuario, c.nombres, c.apellidos, ch.fecha_creacion FROM usuario c inner join chat ch on ch.id_cliente = c.id_usuario GROUP BY c.id_usuario order by ch.fecha_creacion DESC ";

		return ejecutarConsulta($sql);
	}

}

?>