var tabla;

//Funcion que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

}

//Funcion mostrar formulario
function mostrarform(flag){
	
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").hide();
	}
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
					url: '../ajax/permiso.php?op=listar',
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

init();