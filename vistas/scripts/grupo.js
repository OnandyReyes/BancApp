var tabla;

//Funcion que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	});

}


//Funcion limpiar
function limpiar(){

	$("#id_grupo").val("");
	$("#nombres").val("");
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
					url: '../ajax/grupo.php?op=listar',
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
		url: "../ajax/grupo.php?op=guardaryeditar",
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
				
				bootbox.alert(data.mensaje);
			}
		}
	});
}

function mostrar(id_grupo){
	$.post("../ajax/grupo.php?op=mostrar",{id_grupo : id_grupo}, function(data,status){
		data = JSON.parse(data);
		mostrarform(true);

		$("#id_grupo").val(data.id_grupo);
		$("#nombres").val(data.nombre);

	})
}

function desactivar(id_grupo){
	bootbox.confirm("Esta seguro de desactivar este Grupo?",function(result){
		if(result){
			$.post("../ajax/grupo.php?op=desactivar",{id_grupo : id_grupo},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function eliminar(id_grupo){
	bootbox.confirm("Esta seguro de eliminar este Grupo?",function(result){
		if(result){
			$.post("../ajax/grupo.php?op=eliminar",{id_grupo : id_grupo},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(id_grupo){
	bootbox.confirm("Esta seguro de activar el Grupo?",function(result){
		if(result){
			$.post("../ajax/grupo.php?op=activar",{id_grupo : id_grupo},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();