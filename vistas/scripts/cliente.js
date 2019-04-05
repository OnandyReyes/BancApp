var tabla;

//Funcion que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})

	$.post("../ajax/cliente.php?op=selectCliente_tipo",function(r){
		$("#id_cliente_tipo").html(r);
		$('#id_cliente_tipo').selectpicker('refresh');
	});

	$.post("../ajax/cliente.php?op=selectClienteCategoria",function(r){
		$("#id_cliente_categoria").html(r);
		$('#id_cliente_categoria').selectpicker('refresh');
	});



	$.post("../ajax/usuario.php?op=selectProvincia",function(r){
		$("#id_provincia").html(r);
		$('#id_provincia').selectpicker('refresh');

		$("#id_provincia option:selected").each(function(){
	        elegido = $(this).val();
	        $.post("../ajax/usuario.php?op=selectMunicipio", {id_provincia: elegido}, function(r){
	        	$("#id_municipio").html(r);
	        	$('#id_municipio').selectpicker('refresh');
	        });
	    });
	});

	$("#id_provincia").change(function(){
		$("#id_provincia option:selected").each(function(){
	        elegido = $(this).val();
	        $.post("../ajax/usuario.php?op=selectMunicipio", {id_provincia: elegido}, function(r){
	        	$("#id_municipio").html(r);
	        	$('#id_municipio').selectpicker('refresh');
	        });
	    });
    });

	$.post("../ajax/grupo.php?op=select",function(r){
		$("#id_grupo").html(r);
		$('#id_grupo').selectpicker('refresh');
	});
		
    $("#id_cliente_tipo").change(function(){
		$("#id_cliente_tipo option:selected").each(function(){
	        elegido = $(this).val();
	        if(elegido == 1){
	        	$("#apellidosdiv").show();
	        	$("#apellidosdiv").val(" ");
	        }else{
	        	$("#apellidosdiv").hide();
	        	$("#apellidosdiv").val(" ");
	        }
	    });
    });

}


//Funcion limpiar
function limpiar(){

	$("#id_usuario").val("");
	$("#nombres").val("");
	$("#apellidos").val("");
	$("#apodo").val("");
	$("#cedularnc").val("");
	$("#direccion").val("");
	$("#telefono").val("");
	$("#celular").val("");
}

//Funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		$("#id_usuario_tipo").val(2);

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
					url: '../ajax/cliente.php?op=listar',
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
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/cliente.php?op=guardaryeditar",
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
				if(data.cedularnc == ""){
					$("#cedularnc").val("");
				}

				bootbox.alert(data.mensaje);
			}
		}
	});
}

function mostrar(id_usuario){
	$.post("../ajax/cliente.php?op=mostrar",{id_usuario : id_usuario}, function(data,status){
		data = JSON.parse(data);
		mostrarform(true);

		$("#id_usuario").val(data.id_usuario);
		$("#nombres").val(data.nombres);
		$("#apellidos").val(data.apellidos);
		$("#apodo").val(data.apodo);
		$("#cedularnc").val(data.cedularnc);
		$("#direccion").val(data.direccion);
		$("#telefono").val(data.telefono);
		$("#celular").val(data.celular);
		$("#id_cliente_tipo").val(data.id_cliente_tipo);
		$('#id_cliente_tipo').selectpicker('refresh');
		$("#id_cliente_categoria").val(data.id_cliente_categoria);
		$('#id_cliente_categoria').selectpicker('refresh');
		$("#id_provincia").val(data.id_provincia);
		$('#id_provincia').selectpicker('refresh');
		$("#id_grupo").val(data.id_grupo);
		$('#id_grupo').selectpicker('refresh');
		$.post("../ajax/usuario.php?op=selectMunicipio", {id_provincia: data.id_provincia}, function(r){
	        	$("#id_municipio").html(r);
	        	$('#id_municipio').selectpicker('refresh');
	        	$("#id_municipio").val(data.id_municipio);
	        	$('#id_municipio').selectpicker('refresh');
	    });

	})
}

function desactivar(id_usuario){
	bootbox.confirm("Esta seguro de desactivar el Cliente?",function(result){
		if(result){
			$.post("../ajax/cliente.php?op=desactivar",{id_usuario : id_usuario},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function eliminar(id_usuario){
	bootbox.confirm("Esta seguro de eliminar el Cliente?",function(result){
		if(result){
			$.post("../ajax/cliente.php?op=eliminar",{id_usuario : id_usuario},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(id_usuario){
	bootbox.confirm("Esta seguro de activar el Cliente?",function(result){
		if(result){
			$.post("../ajax/cliente.php?op=activar",{id_usuario : id_usuario},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();