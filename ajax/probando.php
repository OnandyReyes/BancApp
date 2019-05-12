<!-- $respuesta=$cuentas->listaVendedoresFiltro($id_usuario); -->
            
            <!-- while ($objeto = $respuesta->fetch_object()) {
        
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

            } -->