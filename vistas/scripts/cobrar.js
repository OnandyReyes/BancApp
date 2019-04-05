var tabla;
var inputSeleccionado=0;
var deuda = 0;

//Funcion que se ejecuta al inicio
function init(){
	var lugar = location;
	mostrarform(true);
	listar();
	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})

	$.post("../ajax/cliente.php?op=selectCliente",function(r){
		$("#id_cliente").html(r);
		$('#id_cliente').selectpicker('refresh');

		$("#id_cliente option:selected").each(function(){
	        elegido = $(this).val();
	        $.post("../ajax/cliente.php?op=clase", {id_usuario: elegido}, function(r){
	        	$("#clase").val(r);
	        });

	        elegido = $(this).val();
	        $.post("../ajax/prestamo.php?op=selectClientePendiente", {id_cliente: elegido}, function(r){
	        	
	        	limpiar();

	        	$("#id_prestamo").html(r);
				$('#id_prestamo').selectpicker('refresh');
				$("#id_prestamo option:selected").each(function(){
			        elegido = $(this).val();
			        cobrar(elegido);


			    });
	        });
	    });
	});



	$("#id_cliente").change(function(){
		$("#id_cliente option:selected").each(function(){
	        elegido = $(this).val();
	        $.post("../ajax/cliente.php?op=clase", {id_usuario: elegido}, function(r){
	        	$("#clase").val(r);
	        });

	        elegido = $(this).val();
	        $.post("../ajax/prestamo.php?op=selectClientePendiente", {id_cliente: elegido}, function(r){
	        	
	     		limpiar();

	        	$("#id_prestamo").html(r);
				$('#id_prestamo').selectpicker('refresh');
				$("#id_prestamo option:selected").each(function(){
			        elegido = $(this).val();
			        cobrar(elegido);
			    });
	        });
	    });
    });

	$("#id_prestamo").change(function(){
		$("#id_prestamo option:selected").each(function(){
	       	elegido = $(this).val();
			cobrar(elegido);
	    });
    });

    	$("#detalleVenta").html('<h4><b>DETALLES DE VENTA</b></h4>');
 		$("#detalleVenta").show();

 		$("#linea2").show();

	$( ":input" ).focus(function() {
        inputSeleccionado = 1;
    }).blur(function(){
        inputSeleccionado = 0;
    });

}

function evaluarCliente(){
	var tipoFactura = $("#id_venta_tipo").val();
	if(tipoFactura == 2){
		if(deuda == 1){
			$("#btnAgregarPro").hide();
			$("#btnGuardar").hide();
			bootbox.alert("Cliente debe pagar factura pendiente para pedir a credito");
		}else{
			$("#btnAgregarPro").show();
			evaluar();
		}
	}else{
		$("#btnAgregarPro").show();
		evaluar();
	}
	
}

//Funcion limpiar
function limpiar(){
	$("#btnGuardar").hide();
	$("#linea1").html("");
	$("#linea2").html("");

}

//Funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		$("#grupo_cliente").show();
		$("#grupo_tipo_venta").show();
		$("#grupo_monto").show();
		$("#monto").hide();
		$("#btnGuardar").hide();
        $("#btnCancelar").show();
        detalles=0;
        $("#btnAgregarPro").show();

	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();

		$("#venta_pago").hide();
        $("#venta_documento").hide();
	}
}

function cancelarform(){
	limpiar();
	mostrarform(false);
}

function listar(){
	tabla =$('#tbllistado').dataTable({
		"aProcessing":true,
		"aServerSide":true,
		dom:'Bfrtip',
		buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdf'
				],
		"ajax":
				{
					url: '../ajax/pedido.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy":true,
		"iDisplayLength":10,//Paginacion
		"order":[[ 0, "desc"]]// Ordenar (columna,orden)
				
	}).DataTable();
}


function guardaryeditar(e){
	e.preventDefault(); //No se activara la accion predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);
	var cuota = $("#cuota").val();
	var monto = $("#monto").val();

	if(monto < cuota){
		bootbox.alert("El pago debe ser mayor a la cuota!");
	}else{
		$.ajax({
			url: "../ajax/pago.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){
				data = JSON.parse(datos);
				if(data.estado){

					if(navigator.platform == "Win32"){
						//Aqui reconozco la url
						
						var origen = $(location).attr('origin');
						var tipo_factura = $("#tipo_factura").val();
						
						//var destino = '/github/prestared/reportes/exTicket.php?id=' + data.id;
						var destino = '/github/prestared/reportes/exTicket.php?id=' + data.id;
						if(tipo_factura == 2){
							//destino = '/github/prestared/reportes/exFactura.php?id=' + data.id;
							destino = '/github/prestared/reportes/exFactura.php?id=' + data.id;
						}

						var url = origen + destino;
						
						//Aqui abro nueva pesta;a
						var a = document.createElement("a");
						a.target = "_blank";
						a.href = url;
						a.click();
					}

					$("#monto").val(0);
					bootbox.alert(data.mensaje);
					location.reload();
				}else{
					bootbox.alert(data.mensaje);
				}
				
			}
		});
	}

	
}

function cobrar(id_prestamo){
	$.post("../ajax/prestamo.php?op=mostrar",{id_prestamo : id_prestamo}, function(data,status){
		data = JSON.parse(data);
		mostrarform(true);
 		
 		var fila = "";

		 var monto = 0;
		 var interes = data.interes / 100;
		 var meses = data.cuotas;
		var arriba = data.monto * interes;
			 
		monto = data.monto / meses;
		monto += arriba;

		fila = '<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">';
	 		fila += 	'<h4>';
	 		fila += 		'<b>Monto : </b>' + data.monto;
	 		fila += 	'</h4>';
	 		fila += '</div>';
	 		
			 $('#linea1').append(fila);
			 
		fila = '<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">';
	 		fila += 	'<h4>';
	 		fila += 		'<b>Capital : </b>' + data.capital;
	 		fila += 	'</h4>';
	 		fila += '</div>';
	 		
	 		$('#linea1').append(fila);

	 		fila = '<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">';
	 		fila += 	'<h4>';
			 fila += 		'<input type="hidden" name="id_prestamo" id="id_prestamo" value="'+data.id_prestamo+'" >';
			 fila += 		'<input type="hidden" name="cuota" id="cuota" value="'+monto.toFixed(2)+'" >';
	 		fila += 		'<b>Cuota : </b>' + monto.toFixed(2);
	 		fila += 	'</h4>';
	 		fila += '</div>';
	 		
	 		$('#linea1').append(fila);

	 		// fila = "";
	 		// fila = '<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">';
	 		// fila += 	'<label >Monto *</label>';
	 		// fila += 		'<input type="number" class="form-control " name="monto" id="monto"  placeholder="Monto" step=".01" required >';
	 		// fila += 	'</h4>';
			//  fila += '</div>';
			 
			
			fila = "";
			fila = '<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">';
			fila += 	'<select class="form-control" name="tipo_pago">';
			fila += 		'<option value="0">Pagar Cuota ('+monto.toFixed(2)+')</option>';
			fila += 		'<option value="1">Pagar Minimo ('+arriba +')</option>';
			fila += 	'</select>';
			fila += '</div>';
	 		
			 $('#linea2').append(fila);


 		// if(data.id_prestamo_tipo == 1){
 		// 	var interes = data.interes / 100;
 		// 	interes = data.monto * interes;
 		// 	monto = parseFloat(data.monto) + parseFloat(interes);

	 	// 	fila = '<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">';
	 	// 	fila += 	'<h4>';
	 	// 	fila += 		'<input type="hidden" name="id_prestamo" id="id_prestamo" value="'+data.id_prestamo+'" >';
	 	// 	fila += 		'<b>Monto a Pagar : </b>' + monto;
	 	// 	fila += 	'</h4>';
	 	// 	fila += '</div>';
	 		
	 	// 	$('#linea1').append(fila);
 		// }

		// if(data.id_prestamo_tipo == 2 || data.id_prestamo_tipo == 3){
		// 	 var interes = data.interes / 100;
		// 	if(data.id_prestamo_tipo == 2){
		// 		interes = data.monto * interes;
 		// 		monto = interes;
		// 	}else{
		// 		var meses = data.cuotas;
		// 		var arriba = data.monto * interes;
		// 		//monto = parseFloat(data.monto) + parseFloat(arriba); 
		// 		monto = data.monto / meses;
		// 		monto += arriba;
		// 		// var elevado = Math.pow(interes2, (-1 * data.cuotas));
		// 		// var abajo = 1 - elevado;
		// 		// abajo = abajo.toFixed(2);
		// 		// monto = arriba / abajo;
		// 		// monto = monto.toFixed(2);
		// 	}
 			

 		// 	fila = '<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">';
	 	// 	fila += 	'<h4>';
	 	// 	fila += 		'<b>Capital : </b>' + data.capital;
	 	// 	fila += 	'</h4>';
	 	// 	fila += '</div>';
	 		
	 	// 	$('#linea1').append(fila);

	 	// 	fila = '<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">';
	 	// 	fila += 	'<h4>';
		// 	 fila += 		'<input type="hidden" name="id_prestamo" id="id_prestamo" value="'+data.id_prestamo+'" >';
		// 	 fila += 		'<input type="hidden" name="cuota" id="cuota" value="'+monto+'" >';
	 	// 	fila += 		'<b>Cuota : </b>' + monto;
	 	// 	fila += 	'</h4>';
	 	// 	fila += '</div>';
	 		
	 	// 	$('#linea1').append(fila);

	 	// 	fila = "";
	 	// 	fila = '<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">';
	 	// 	fila += 	'<label >Monto *</label>';
	 	// 	fila += 		'<input type="number" class="form-control " name="monto" id="monto"  placeholder="Monto" step=".01" required >';
	 	// 	fila += 	'</h4>';
	 	// 	fila += '</div>';
	 		
	 	// 	$('#linea2').append(fila);

		//  } 		
		 
 		
 		$("#linea1").show();

 		

 		$("#linea2").show(); 


        //Ocultar y mostrar los botones
        $("#btnGuardar").show();
	});

}

function cancelar(id_pedido){
	bootbox.confirm("Esta seguro de cancelar el Pedido?",function(result){
		if(result){
			$.post("../ajax/pedido.php?op=cancelar",{id_pedido : id_pedido},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function eliminar(id_pedido){
	bootbox.confirm("Esta seguro de eliminar el Pedido?",function(result){
		if(result){
			$.post("../ajax/pedido.php?op=eliminar",{id_pedido : id_pedido},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Declaracion de variables necesarios
var impuesto=18;
var cont=0;
var detalles=0;
//$("#guardar").hide();
$("#btnGuardar").hide();
$("#impuesto").val(impuesto);

function agregarDetalle(id_producto,producto,existencia,precio){
	cantidad = 1;

	if(id_producto!=""){
		var subtotalprecio = cantidad*precio;
		var fila = '<tr class="filas" id="fila'+cont+'">' + 
		'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button> </td>'+
		'<td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td>'+
		'<td><input type="number" value="'+cantidad+'" min="1" name="cantidad[]" id="cantidad[]" required ></td>'+
		'<td><input type="number" name="precio[]" id="precio[]" value="'+precio+'" step=".01" required></td>'+
		'<td><span name="subtotalprecio" id="subtotalprecio'+cont+'" value="'+subtotalprecio+'">'+subtotalprecio+'</span></td>'+
		'<td><button type="button" class="btn btn-info" onclick="modificarSubtotales()"><i class="fa fa-refresh"></i></button> </td>'+
		'</tr>';
		cont++;
		detalles++;
		$('#detalles').append(fila);
		modificarSubtotales();
	}else{
		alert("Error al ingresar el Detalle, Revisar los datos del producto.");
	}

	$('#myModal').modal('hide');
}

function modificarSubtotales(){
	var cant = document.getElementsByName("cantidad[]");
	var prec = document.getElementsByName("precio[]");
	var subprec = document.getElementsByName("subtotalprecio");

	for(var i = 0; i < cant.length; i++){
		var inpcant = cant[i];
		var inpPrec = prec[i];
		var inpsubprec = subprec[i];

		inpsubprec.value = inpcant.value * inpPrec.value;
		document.getElementsByName("subtotalprecio")[i].innerHTML = inpsubprec.value;
	}

	calcularTotales();
}

function calcularTotales(){
	var subprecio = document.getElementsByName("subtotalprecio");
	
	var totalprecio = 0.0;

	for (var i = 0; i < subprecio.length; i++) {
		totalprecio += document.getElementsByName("subtotalprecio")[i].value;
	}

	$("#totalprecio").html("$ "+totalprecio);

	evaluar();
}

function evaluar(){
	if(detalles > 0){
		$("#btnGuardar").show();
	}else{
		$("#btnGuardar").hide();
		cont=0;
	}
}

function eliminarDetalle(indice){
	$("#fila"+indice).remove();
	calcularTotales();
	detalles= detalles-1;
	evaluar();
}

init();