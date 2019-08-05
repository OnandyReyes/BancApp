<?php
require "../config/conexion.php";
        
Class Usuarios{
    //constructor
	public function _construct(){

    }

    public function crearNuevo($nombres, $apellidos, $celular, $cedula, $id_sector, $estado, $direccion, $usuario, $clave, $id_cuenta_tipo
    , $titulo_ticket, $imei, $comision, $prueba, $id_grupo, $fecha_creacion, $id_creador){
        $msj = "Guardado Correctamente!!!";

        $id_usuario = $this->insertarRetornId($nombres, $apellidos, $celular, $cedula, $id_sector, $estado, $direccion);

        require_once "../modelos/Cuentas.php";
        $cuentas= new Cuentas();

        $sql = $cuentas->insertar($usuario, $clave, $id_cuenta_tipo, $id_usuario, $estado, $titulo_ticket, $imei, $comision, $prueba);

        ejecutarConsulta($sql) or $msj = "Problema al insertar la cuenta!!!";

        require_once "../modelos/Grupos_usuarios.php";
        $grupos_usuarios= new Grupos_usuarios();
        
        $gus = $grupos_usuarios->selectUsuarioId(1);

        $sql = $grupos_usuarios->insertar($id_grupo, $id_usuario, $fecha_creacion, $id_creador, $gus["porciento"], $gus["primera"], $gus["segunda"], $gus["tercera"],
        $gus["pale"], $gus["pale2"], $gus["tripleta"], $gus["tripleta2"], $gus["bloqueoNumero"], $gus["bloqueoPale"], $gus["bloqueoSuperPale"], $gus["bloqueoTripleta"]);

        ejecutarConsulta($sql) or $msj = "Problema al insertar el grupo de usuario!!!";

        return $msj;
    }

    //metodo para insertar
	public function insertarRetornId($nombres, $apellidos, $celular, $cedula, $id_sector, $estado, $direccion){
		
		//Aqui hay que hacer pila de codigo antes de guardar la venta

		$sql="INSERT INTO usuarios (nombres, apellidos, celular, cedula, id_sector, estado, direccion) 
        VALUES ('$nombres','$apellidos','$celular','$cedula','$id_sector','$estado','$direccion')";
		
		$id_usuario = ejecutarConsulta_retornarID($sql);
		
		return $id_usuario;
    }
    
    //metodo para editar
	public function editar($id_usuario, $nombres, $apellidos, $celular, $cedula, $id_sector, $estado, $direccion){
        
        $sql="UPDATE usuarios SET nombres='$nombres',apellidos='$apellidos',celular='$celular',cedula='$cedula',id_sector='$id_sector',estado='$estado',direccion='$direccion' WHERE id_usuario='$id_usuario' ";
		
		return ejecutarConsulta($sql);
    }

    public function listar_vendedores(){
        $sql="SELECT * FROM usuarios u INNER JOIN cuentas cu on cu.id_usuario = u.id_usuario 
        INNER JOIN grupos_usuarios gu on gu.id_usuario = u.id_usuario
        WHERE id_cuenta_tipo = 2";

		return ejecutarConsulta($sql);
    }
}
?>