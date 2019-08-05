<?php
require "../config/conexion.php";

class Grupos_usuarios{
    //constructor
    public function _construct(){

    }

    //metodo para insertar
    public function insertar($id_grupo, $id_usuario, $fecha_creacion, $id_creador, $porciento, $primera, $segunda, $tercera,
     $pale, $pale2, $tripleta, $tripleta2, $bloqueoNumero, $bloqueoPale, $bloqueoSuperPale, $bloqueoTripleta){
		
		//Aqui hay que hacer pila de codigo antes de guardar la venta

		$sql="INSERT INTO grupos_usuarios (id_grupo, id_usuario, fecha_creacion, id_creador, porciento, primera, segunda, tercera, 
        pale, pale2, tripleta, tripleta2, bloqueoNumero, bloqueoPale, bloqueoSuperPale, bloqueoTripleta) 
        VALUES ('$id_grupo','$id_usuario','$fecha_creacion','$id_creador','$porciento','$primera','$segunda','$tercera',
        '$pale','$pale2','$tripleta','$tripleta2','$bloqueoNumero','$bloqueoPale','$bloqueoSuperPale','$bloqueoTripleta')";
		
		return ejecutarConsulta($sql);
    }
    
    //metodo para editar
    public function editar($id_grupo, $id_usuario, $fecha_creacion, $id_creador, $porciento, $primera, $segunda, $tercera,
     $pale, $pale2, $tripleta, $tripleta2, $bloqueoNumero, $bloqueoPale, $bloqueoSuperPale, $bloqueoTripleta){
		
		//Aqui hay que hacer pila de codigo antes de guardar la venta
        $sql="UPDATE grupos_usuarios SET id_grupo='$id_grupo',porciento='$porciento',primera='$primera',segunda='$segunda',tercera='$tercera',
        pale='$pale',pale2='$pale2',tripleta='$tripleta',tripleta2='$tripleta2',bloqueoNumero='$bloqueoNumero',bloqueoPale='$bloqueoPale',bloqueoSuperPale='$bloqueoSuperPale',
        bloqueoTripleta='$bloqueoTripleta' WHERE id_usuario='$id_usuario' ";
		
		return ejecutarConsulta($sql);
    }
    
    public function selectUsuarioId($id_usuario){
		$sql="SELECT * FROM grupos_usuarios WHERE id_usuario = '$id_usuario' ";

		return ejecutarConsultaSimpleFila($sql);
	}

}

?>