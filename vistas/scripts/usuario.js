var tabla;

//Funcion que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})

	$.post("../ajax/usuario.php?op=selectUsuario_tipo",function(r){
		$("#id_usuario_tipo").html(r);
		$('#id_usuario_tipo').selectpicker('refresh');
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

}


//Funcion limpiar
function limpiar(){

	$("#id_usuario").val("");
	$("#nombres").val("");
	$("#apellidos").val("");
	$("#cedularnc").val("");
	$("#direccion").val("");
	$("#telefono").val("");
	$("#celular").val("");
	$("#correo").val("");
	$('#clave').val("");
	$("#clave").prop('required',true);
}

//Funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
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
					url: '../ajax/usuario.php?op=listar',
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
		url: "../ajax/usuario.php?op=guardaryeditar",
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

				if(data.correo == ""){
					$("#correo").val("");
				}

				if(data.clave == ""){
					$('#clave').val("");
				}
				
				bootbox.alert(data.mensaje);
			}
		}
	});
	limpiar();
}

function mostrar(id_usuario){
	$.post("../ajax/usuario.php?op=mostrar",{id_usuario : id_usuario}, function(data,status){
		data = JSON.parse(data);
		mostrarform(true);
		
		

		$("#id_usuario").val(data.id_usuario);
		$("#nombres").val(data.nombres);
		$("#apellidos").val(data.apellidos);
		$("#cedularnc").val(data.cedularnc);
		$("#direccion").val(data.direccion);
		$("#telefono").val(data.telefono);
		$("#celular").val(data.celular);
		$("#correo").val(data.correo);
		$("#claveactual").val(data.clave);
		$("#id_provincia").val(data.id_provincia);
		$('#id_provincia').selectpicker('refresh');
		$.post("../ajax/usuario.php?op=selectMunicipio", {id_provincia: data.id_provincia}, function(r){
	        	$("#id_municipio").html(r);
	        	$('#id_municipio').selectpicker('refresh');
	        	$("#id_municipio").val(data.id_municipio);
	        	$('#id_municipio').selectpicker('refresh');
	    });
	
		$("#id_usuario_tipo").val(data.id_usuario_tipo);
		$('#id_usuario_tipo').selectpicker('refresh');

		$("#clave").prop('required',false);
	});
}

function desactivar(id_usuario){
	bootbox.confirm("Esta seguro de desactivar el Usuario?",function(result){
		if(result){
			$.post("../ajax/usuario.php?op=desactivar",{id_usuario : id_usuario},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(id_usuario){
	bootbox.confirm("Esta seguro de activar el Usuario?",function(result){
		if(result){
			$.post("../ajax/usuario.php?op=activar",{id_usuario : id_usuario},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();