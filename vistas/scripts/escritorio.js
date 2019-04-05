function init(){
	
	diariosEscritorio();

	quincenalEscritorio();
}

function diariosEscritorio(){
	tabla =$('#tbllistado').dataTable({
		"aProcessing":true,
		"aServerSide":true,
		dom:'Bfrtip',
		buttons: [
					
				],
		"ajax":
				{
					url: '../ajax/prestamo.php?op=diariosEscritorio',
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

function quincenalEscritorio(){
	tabla =$('#quincenalEscritorio').dataTable({
		"aProcessing":true,
		"aServerSide":true,
		dom:'Bfrtip',
		buttons: [
					
				],
		"ajax":
				{
					url: '../ajax/prestamo.php?op=quincenalEscritorio',
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