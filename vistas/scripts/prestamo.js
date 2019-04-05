var tabla;
var inputSeleccionado=0;

//Funcion que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})

	$.post("../ajax/cliente.php?op=selectCliente",function(r){
		$("#id_cliente").html(r);
		$('#id_cliente').selectpicker('refresh');
	});

	$("#id_prestamo_tipo").change(function(){
		$("#id_prestamo_tipo option:selected").each(function(){
	        elegido = $(this).val();
			// switch (elegido) {
			// 	case "1":
			// 		$("#fecha_inicio").show();
			// 		$("#fecha_fin").show(); 
			// 		$("#mesesGroup").hide();
			// 		break;
			// 	case "2":
			// 		$("#fecha_inicio").show();
			// 		$("#fecha_fin").hide();
			// 		$("#mesesGroup").hide();
					
			// 		break;
			// 	case "3":
			// 		$("#fecha_inicio").hide();
			// 		$("#fecha_fin").hide();
			// 		$("#mesesGroup").show();
					
			// 		break;
			// 	default:
			// 		break;
			// }
			
	        calcular();
	    });
    });

    $( ":input" ).focus(function() {
        inputSeleccionado = 1;
    }).blur(function(){
        inputSeleccionado = 0;
    });
}


//Funcion limpiar
function limpiar(){

	$("#id_prestamo").val("");
	$("#interes").val("");
	$("#prestamo").val("");
	$("#total").html("0.00");
}

//Funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#fecha_inicio").hide();
		$("#fecha_fin").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
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
					url: '../ajax/prestamo.php?op=listar',
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


	if(inputSeleccionado ==1){
		$("#btnGuardar").prop("disabled",true);
		var formData = new FormData($("#formulario")[0]);

		$.ajax({
			url: "../ajax/prestamo.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				data = JSON.parse(datos);
				
				if(data.estado){
					mostrarform(false);
					tabla.ajax.reload();
					limpiar();
					bootbox.alert(data.mensaje);
				}else{

					$("#btnGuardar").prop("disabled",false);
					bootbox.alert(data.mensaje);
				}
			}
		});
	}else{
    	calcular();
    }
	
}

function calcular(){
	if($("#interes").val().length > 0 && $("#monto").val().length > 0){
		var tipo = $("#id_prestamo_tipo").val();
		
		var total = 0;
		var monto = $("#monto").val();
		var interes = $("#interes").val() / 100;
		
		var meses = $("#meses").val();
		var interes = monto * interes;
		var pago = monto / meses;
		pago += parseFloat(interes);
		total = pago * meses;

		$("#total").html(total.toFixed(2));
		$("#pago").html(pago.toFixed(2));

		// switch (tipo) {
		// 	case "1":
				
		// 		interes = monto * interes;
		// 		total = parseFloat(monto) + parseFloat(interes);
		// 		$("#total").html(total);
		// 		$("#pago").html("N/A");
		// 		break;
		// 	case "2":
				
		// 		interes = monto * interes;
		// 		total = parseFloat(monto) + parseFloat(interes);
		// 		$("#total").html("N/A");
		// 		$("#pago").html(interes);
		// 		break;
		// 	case "3":
		// 		var meses = $("#meses").val();
		// 		var interes = monto * interes;
		// 		//total = parseFloat(monto) + parseFloat(interes); 
		// 		var pago = monto / meses;
		// 		pago += parseFloat(interes);
		// 		total = pago * meses;
		// 		// var interes2 = 1 + interes;
		// 		// var elevado = Math.pow(interes2, (-1 * meses));
		// 		// var abajo = 1 - elevado;
		// 		// abajo = abajo.toFixed(2);
		// 		// var pago = arriba / abajo;
		// 		// total = pago * meses;

		// 		$("#total").html(total.toFixed(2));
		// 		$("#pago").html(pago.toFixed(2));
		// 		break;
		// 	default:
		// 		break;
		// }

	}
	
}

function mostrar(id_prestamo){
	$.post("../ajax/prestamo.php?op=mostrar",{id_prestamo : id_prestamo}, function(data,status){
		data = JSON.parse(data);
		mostrarform(true);

		$("#id_prestamo").val(data.id_prestamo);
		// $("#nombres").val(data.nombres);
		// $("#apellidos").val(data.apellidos);
		// $("#cedularnc").val(data.cedularnc);
		// $("#direccion").val(data.direccion);
		// $("#telefono").val(data.telefono);
		// $("#celular").val(data.celular);
		// $("#id_cliente_tipo").val(data.id_cliente_tipo);
		// $('#id_cliente_tipo').selectpicker('refresh');
		// $("#id_cliente_categoria").val(data.id_cliente_categoria);
		// $('#id_cliente_categoria').selectpicker('refresh');
		// $("#id_provincia").val(data.id_provincia);
		// $('#id_provincia').selectpicker('refresh');
		// $.post("../ajax/usuario.php?op=selectMunicipio", {id_provincia: data.id_provincia}, function(r){
	 //        	$("#id_municipio").html(r);
	 //        	$('#id_municipio').selectpicker('refresh');
	 //        	$("#id_municipio").val(data.id_municipio);
	 //        	$('#id_municipio').selectpicker('refresh');
	 //    });

	})
}


function eliminar(id_prestamo){
	bootbox.confirm("Esta seguro de eliminar el Prestamo?",function(result){
		if(result){
			$.post("../ajax/prestamo.php?op=eliminar",{id_prestamo : id_prestamo},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}



init();