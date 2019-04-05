<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Usuario{

	//constructor
	public function _construct(){

	}

	//metodo para insertar
	public function insertar($nombres,$apellidos,$cedularnc,$direccion,$telefono,$celular,$correo,$clave,$id_municipio,$id_usuario_tipo){
		$sql="INSERT INTO usuario (nombres,apellidos,cedularnc,direccion,telefono,celular,correo,clave,estado,id_municipio,id_usuario_tipo) VALUES ('$nombres','$apellidos','$cedularnc','$direccion','$telefono','$celular','$correo','$clave','1','$id_municipio','$id_usuario_tipo')";

		return ejecutarConsulta($sql);
	}

	//metodo para editar
	public function editar($id_usuario,$nombres,$apellidos,$cedularnc,$direccion,$telefono,$celular,$correo,$clave,$id_municipio,$id_usuario_tipo){
		$sql="UPDATE usuario SET nombres='$nombres',apellidos='$apellidos',cedularnc='$cedularnc',direccion='$direccion',telefono='$telefono',celular='$celular',correo='$correo',clave='$clave',id_municipio='$id_municipio',id_usuario_tipo='$id_usuario_tipo' WHERE id_usuario='$id_usuario'";

		return ejecutarConsulta($sql);
	}

	//metodo para desactivar
	public function desactivar($id_usuario){
		$sql="UPDATE usuario SET estado='0' WHERE id_usuario='$id_usuario'";

		return ejecutarConsulta($sql);
	}

	//metodo para activar
	public function activar($id_usuario){
		$sql="UPDATE usuario SET estado='1' WHERE id_usuario='$id_usuario'";

		return ejecutarConsulta($sql);
	}

	//metodo para mostrar los datos de uno especifico
	public function mostrar($id_usuario){
		$sql="SELECT u.id_usuario, u.nombres, u.apellidos, u.cedularnc, u.direccion, u.telefono, u.celular, u.correo, u.clave, u.estado, u.id_cliente_tipo, u.id_municipio, m.nombre as municipio,p.id_provincia,p.nombre as provincia, u.id_usuario_tipo  FROM usuario u INNER JOIN municipio m on u.id_municipio = m.id_municipio INNER JOIN provincia p on m.id_provincia = p.id_provincia INNER JOIN usuario_tipo ut on u.id_usuario_tipo = ut.id_usuario_tipo WHERE id_usuario='$id_usuario'";

		return ejecutarConsultaSimpleFila($sql);
	}

	//metodo para mostrar los datos de uno especifico
	public function verificaractivo($id_usuario){
		$sql="SELECT u.estado FROM usuario u  WHERE id_usuario='$id_usuario'";

		return ejecutarConsultaSimpleFila($sql);
	}

	//metodo para listar los datos
	public function listar(){
		$sql="SELECT * FROM usuario WHERE id_usuario_tipo != 2";

		return ejecutarConsulta($sql);
	}

	//metodo para listar los datos para select
	public function select(){
		$sql="SELECT * FROM usuario where estado = 1 ";

		return ejecutarConsulta($sql);
	}

	//metodo para listar los datos para select
	public function selectDistribuidor(){
		$sql="SELECT * FROM usuario where id_usuario_tipo = 3 and estado = 1 ";

		return ejecutarConsulta($sql);
	}

	public function listapermisos($id_usuario_tipo){
		$sql="SELECT * FROM usuario_tipo_permiso WHERE id_usuario_tipo='$id_usuario_tipo'";
		return ejecutarConsulta($sql);
	}

	public function verificar($correo,$clave){
		$sql= "SELECT id_usuario,nombres,apellidos,correo,id_usuario_tipo FROM usuario WHERE correo='$correo' and clave='$clave' AND estado='1' ";

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

}

?>