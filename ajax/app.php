<?php
require_once "../modelos/Ticket.php";

$ticket= new Ticket();

$recibir_jugadas=$_POST['jugadas'];
$jugadas_nuevas=json_decode($recibir_jugadas,true);
$usuario=isset($_POST['usuario'])? limpiarCadena($_POST['usuario']):"";
$new_usuario = json_decode($usuario,true);
switch ($_GET["op"]) {
    case 'crearFactura':
        
        $estado = true;
        $msj = "Esto es un mensaje";
        $nombreBanca = "BANCA RO";

        $dia = date("N");
        $hora = date("G");
        $minuto = date("i");
        $horarioString = $hora.$minuto;
        $horarioEntero = (int)$horarioString;

        require_once "../modelos/Cuentas.php";
        $cuentas = new Cuentas();

        $respuesta4 = $cuentas->verificarCuentaPorImei($new_usuario);

        $estadoCuenta = $respuesta4["estado"];

        if($estadoCuenta == "1"){
            $nombreBanca = $respuesta4["titulo_ticket"];

            require_once "../modelos/Loterias_sub_horarios.php";
            $loterias_sub_horarios = new Loterias_sub_horarios();
            
            foreach($jugadas_nuevas as $row){
                $loteria = $row["loteria"];
                
                $respuesta3 = $loterias_sub_horarios->traerHorarioPorDia($dia, $loteria);
                //$hora3 = (int)$respuesta3["hora_apertura"];

                $horarioLoteriaAperturaString = $respuesta3["hora_apertura"].$respuesta3["minuto_apertura"];
                $horarioLoteriaAperturaEntero = (int)$horarioLoteriaAperturaString;

                $horarioLoteriaCierreString = $respuesta3["hora_cierre"].$respuesta3["minuto_cierre"];
                $horarioLoteriaCierreEntero = (int)$horarioLoteriaCierreString;

                $nombreLoteria = $respuesta3["nombre"];
                if($horarioEntero >= $horarioLoteriaAperturaEntero && $horarioEntero <= $horarioLoteriaCierreEntero){
                    $estado = true;
                    $msj = " esta dentro del rango!";
                }else{
                    $estado = false;
                    $msj = $nombreLoteria." esta cerrada actualmente!";
                    break;
                }
                
            }
            
            if($estado == true){
                $respuesta =$ticket->insertar("0000000",$new_usuario,$jugadas_nuevas);

                if($respuesta){
                    $msj = "Venta creada con exito";
                    $respuesta2 = $ticket->ultimoIdTicket();
                    $id_ticket = $respuesta2["id_ticket"];
                    $fecha = date_format(date_create($respuesta2["fecha_creacion"]), 'd/m/Y H:i:m');
                }else{
                    $msj = "No se pudo registrar la jugada!!";
                }
            }
        }else{
            $estado = false;
            $msj = "Cuenta no esta disponible";
        }
        
        
        

        $array = [
		    "estado" => $estado,
		    "mensaje" => $msj,
            "nombre_banca" => $nombreBanca,
            "query" =>  $horarioLoteriaAperturaEntero,
            "id_ticket" => $id_ticket,
            "fecha" => $fecha
            //"respuesta" => $respuesta
		];

		echo json_encode($array);
    break;
    case 'probando':
        
        $array = [
            "estado" => "Nuevo Estado",
            "mensaje" => "Mensaje Nuevo"
        ];
        echo json_encode($array);
    break;
}
?>