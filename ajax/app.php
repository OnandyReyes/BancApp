<?php
require_once "../modelos/Funciones.php";
$funciones= new Funciones();

require_once "../modelos/Ticket.php";
$ticket= new Ticket();

// $recibir_jugadas=$_POST['jugadas'];
// $jugadas_nuevas=json_decode($recibir_jugadas,true);
if(!is_null($_POST['jugadas'])){
    $jugadas_nuevas=$funciones->descodificarJson($_POST['jugadas']);
}

if(!is_null($_POST['usuario'])){
    $new_usuario = $funciones->descodificarJsonLimpiar($_POST['usuario']);
}

if(!is_null($_POST['desde'])){
    $new_desde = $funciones->descodificarJson($_POST['desde']);
}

if(!is_null($_POST['hasta'])){
    $new_hasta = $funciones->descodificarJson($_POST['hasta']);
}
// $usuario=isset($_POST['usuario'])? limpiarCadena($_POST['usuario']):"";
// $new_usuario = json_decode($usuario,true);


$dia = date("N");
$hora = date("G");
$minuto = date("i");
$horarioString = $hora.$funciones->aumentarDigitoA2($minuto);
$horarioEntero = (int)$horarioString;

switch ($_GET["op"]) {
    case 'crearFactura':
        
        $ver = "";
        $estado = true;
        $msj = "Esto es un mensaje";
        $nombreBanca = "BANCA PROBANDO";
        $id_ticket = 0;
        $fecha = "";

        require_once "../modelos/Cuentas.php";
        $cuentas = new Cuentas();

        $new_usuario = $_POST['usuario'];
        $respuesta4 = $cuentas->verificarCuentaPorImei($new_usuario);

        $estadoCuenta = $respuesta4["estado"];
        $celular = $respuesta4["celular"];
        $id_usuario = 0;

        

        if($new_usuario == "1" ){
            $estado = false;
            $msj = "No tiene permiso debe registrar el Imei";
        }



        if($estado == true){
            if($estadoCuenta == "1"){
                $nombreBanca = $respuesta4["titulo_ticket"];
    
                require_once "../modelos/Loterias_sub_horarios.php";
                $loterias_sub_horarios = new Loterias_sub_horarios();
                
                if (is_array($jugadas_nuevas) || is_object($jugadas_nuevas))
                {
                    foreach ($jugadas_nuevas as $row)
                    {
                        $loteria = $row["loteria"];
                       
                    
                        $respuesta3 = $loterias_sub_horarios->traerHorarioPorDia($dia, $loteria);
                        $ver = $loterias_sub_horarios->traerHorarioPorDiaString($dia, $loteria);
    
                        $horarioLoteriaAperturaString = $respuesta3["hora_apertura"].$funciones->aumentarDigitoA2($respuesta3["minuto_apertura"]);
                        $horarioLoteriaAperturaEntero = (int)$horarioLoteriaAperturaString;
    
                        $horarioLoteriaCierreString = $respuesta3["hora_cierre"].$funciones->aumentarDigitoA2($respuesta3["minuto_cierre"]);
                        $horarioLoteriaCierreEntero = (int)$horarioLoteriaCierreString;
    
                        $nombreLoteria = $respuesta3["nombre"];

                        //357217075004290
                        // if($new_usuario == "357217075004290"){
                        //     $estado = true;
                        // }else{
                            if($horarioEntero >= $horarioLoteriaAperturaEntero && $horarioEntero <= $horarioLoteriaCierreEntero ){
                                $estado = true;
                                $msj = " esta dentro del rango!";
                            }else{
                                $estado = false;
                                $msj = $nombreLoteria." esta cerrada actualmente!";
                                break;
                            }
                        //}
                        
                        
                        require_once "../modelos/Bloqueos.php";
                        $bloqueos = new Bloqueos();
                        
                        $user_id = $respuesta4["id_usuario"];
                        //if($user_id == 1){
                            $mostrar = $row;
                            $estadoBloqueo = $bloqueos->general($row, $user_id);
                            if($estadoBloqueo == true){
                                $estado = false;
                                $numerosJugadaBloqueada = $row["numeros"];
                                if($row["numeros2"] >= 0){
                                    $numerosJugadaBloqueada .= '-'.$row["numeros2"];
                                }

                                if($row["numeros3"] >= 0){
                                    $numerosJugadaBloqueada .= '-'.$row["numeros3"];
                                }

                                $msj = "".$numerosJugadaBloqueada." de ".$nombreLoteria." esta al limite de monto!";
                                break;
                            }
                        //}

                    }
                }
    
                
                if($estado == true){
                    $respuesta =$ticket->insertar("0000000",$respuesta4["id_usuario"],$jugadas_nuevas);
    
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
                $msj = "Celular no registrado!";
            }
        }

        
        $array = [
		    "estado" => $estado,
		    "mensaje" => $msj,
            "nombre_banca" => $nombreBanca,
            //"query" =>  $horarioLoteriaAperturaEntero,
            "id_ticket" => $id_ticket,
            "fecha" => $fecha,
            "nombre_loteria" => $new_usuario,
            "linea" => $mostrar,
            "celular" => $celular
		];

		echo json_encode($array);
    break;
    case 'reimprimirFactura':
        $estado = true;
        $msj = "Esto es un mensaje";
        $nombreBanca = "BANCA RO";
        $id_ticket = 0;
        $fecha = "";
        $celular = "809-590-0455";

        require_once "../modelos/Cuentas.php";
        $cuentas = new Cuentas();

        $respuesta4 = $cuentas->verificarCuentaPorImei($new_usuario);

        $estadoCuenta = $respuesta4["estado"];
        $id_usuario = $respuesta4["id_usuario"];

        if($estadoCuenta == "1"){
            $nombreBanca = $respuesta4["titulo_ticket"];
            $respuesta2 = $ticket->ultimoIdTicketCreador($id_usuario);
            $id_ticket = $respuesta2["id_ticket"];
            $fecha = $respuesta2["fecha_creacion"];
            //$fecha = date_format(date_create($respuesta2["fecha_creacion"]), 'd/m/Y H:i:m');
            $jugadas = $ticket->DetalleTicketId($id_ticket);
            $jugadas = $jugadas->fetch_object();
        }
    
        $array = [
		    "estado" => $estado,
		    "mensaje" => $msj,
            "nombre_banca" => $nombreBanca,
            //"query" =>  $horarioLoteriaAperturaEntero,
            "id_ticket" => $id_ticket,
            "fecha" => $fecha,
            "jugadas" => $jugadas,
            "celular" => $celular
		];

		echo json_encode($array);
    break;
    case 'anular':

        require_once "../modelos/Cuentas.php";
        $cuentas = new Cuentas();

        $msj = "Ticket anulado correctamente!";
        $respuesta = true;
        $respuesta4 = $cuentas->verificarCuentaPorImei($new_usuario);

        $estadoCuenta = $respuesta4["estado"];
        $id_usuario = $respuesta4["id_usuario"];

        if($estadoCuenta == "1"){
            
            $id_ticket = $funciones->descodificarJsonLimpiar($_POST['id_ticket']);
            $respuesta2 = $ticket->verificarTicketCuenta($id_usuario, $id_ticket);

            if($respuesta2 != null){
                $respuesta = $ticket->anular($id_ticket);

            }else{
                $msj = "Ticket no existe!";
                $respuesta = false;
            }
            // $respuesta = $ticket->anular($id_ticket);
            // if($respuesta == false){
            //     $msj = "Ticket no se pudo anular!";
            // }
        }

        $array = [
            "estado" => $respuesta,
            "mensaje" => $msj,
            "probando" => $respuesta2
        ];

        echo json_encode($array);
    break;
    case 'probando':
        require_once "../modelos/Loterias_sub_horarios.php";
        $loterias_sub_horarios = new Loterias_sub_horarios();
        $loteria = "NACIONAL TARDE";
        $dia = "5";
        $respuesta3 = $loterias_sub_horarios->traerHorarioPorDia($dia, $loteria);
        
        $horarioLoteriaAperturaString = $respuesta3["hora_apertura"].$funciones->aumentarDigitoA2($respuesta3["minuto_apertura"]);
        $horarioLoteriaAperturaEntero = (int)$horarioLoteriaAperturaString;

        $horarioLoteriaCierreString = $respuesta3["hora_cierre"].$funciones->aumentarDigitoA2($respuesta3["minuto_cierre"]);
        $horarioLoteriaCierreEntero = (int)$horarioLoteriaCierreString;
        $nombreLoteria = $respuesta3["nombre"];

        $msj = "probando";
        
        $array = [
            "estado" => "Nuevo Estado",
            "mensaje" => $msj,
            "horario" => $respuesta3,
            "Nombre" => $nombreLoteria,
            "horarioApertura" => $horarioLoteriaAperturaEntero,
            "horarioCierre" => $horarioLoteriaCierreEntero,
            "actual" => $horarioEntero
        ];
        echo json_encode($array);
    break;
    case 'cuadre':
        require_once "../modelos/Cuentas.php";
        $cuentas= new Cuentas();

        require_once "../modelos/Ticket.php";
        $tickets= new Ticket();

        require_once "../modelos/Numeros_ganadores.php";
        $numeros_ganadores= new Numeros_ganadores();

        date_default_timezone_set ('America/Santo_Domingo');

        $fecha = new DateTime();
        $fecha = $fecha->format('Y-m-d H:i:m');

        $estado = true;
        $msj = "Nuevo Mensaje";
        $nombreBanca = "Banca Onandy";
        $celular = "000-000-0000";

        $user = $_POST['usuario'];
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];

        $respuesta4 = $cuentas->verificarCuentaPorImei($user);

        $estadoCuenta = $respuesta4["estado"];
        $id_usuario = 0;

        if($estadoCuenta == "1"){
            $nombreBanca = $respuesta4["titulo_ticket"];
            $id_usuario = $respuesta4["id_usuario"];
            $comisionPorcentaje  = $respuesta4["porciento"];

            $total_venta = 0;
            $total_premios = 0;
            $total_comision = 0;
            $total_ganancia = 0; 

            $probando = 0;

            $respuesta=$cuentas->listaVendedoresFiltro($id_usuario);

            while ($objeto = $respuesta->fetch_object()) {
                $ticketVendedores = $tickets->ticketsIdUsuarioRango($objeto->id_usuario, $desde, $hasta );

                $venta = 0;
                $premio = 0;

                $usuario = $cuentas->seleccionar($objeto->id_usuario);

                while($objeto2 = $ticketVendedores->fetch_object()){
                    $tickets_detalles = $tickets->DetalleTicketId($objeto2->id_ticket);
            
                    while($objeto3 = $tickets_detalles->fetch_object()){
            
                        $tipoJugada = "";

                        if($objeto3->numero >= 0){
                            $tipoJugada = "Quiniela";
                        }

                        if($objeto3->numero2 >= 0){
                            $tipoJugada = "Pale";
                        }

                        if($objeto3->numero3 >= 0){
                            $tipoJugada = "Tripleta";
                        }

                        $variable_tickets_detalle = $tickets->DetalleTicketIdTicket($objeto3->id_ticket_detalle);
                        $variable_numeros_ganadores = $numeros_ganadores->ganadoresLoteriaId($objeto3->id_loteria_sub, $objeto2->fecha_creacion);
                
                        $premio += $numeros_ganadores->verificarGanador($variable_tickets_detalle, $variable_numeros_ganadores, $usuario, $tipoJugada );

                        $venta += $objeto3->monto;

                    }
                } 

                $comision = 0;
        
                $comision = $usuario["comision"] / 100;

                $comision = $venta * $comision;
                
                $ganancia = $venta - ($premio + $comision);

                $total_comision += $comision;
                $total_ganancia += $ganancia;
                $total_venta += $venta ;
                $total_premios += $premio;
            }

        }else{
            $estado = false;
            $msj = "Acceso Denegado";
        }

        $array = [
            "estado" => $estado,
		    "mensaje" => $msj,
            "extra" => $usuario,
            "nombreBanca" => $nombreBanca,
            "celular" => $celular,
            "fechaCreacion" => $fecha,
            "ganancias" => $total_ganancia,
            "ventaBruta" => $total_venta,
            "comision" => $total_comision,
            "ganadores" => $total_premios,
        ];

        echo json_encode($array);
    break;
    case 'acceso':
        require_once "../modelos/Acceso.php";
        $acceso = new Acceso();

        $estado = true;
        $msj = "Nuevo Mensaje";
        
        $respuesta = $acceso->verificar();

        if($respuesta["estado"] != "1"){
            $estado = false;
            $msj = "No Tiene Acceso Disponible";
        }

        $array = [
            "estado" => $estado,
		    "mensaje" => $msj
        ];
        echo json_encode($array);
    break;
    
}
?>