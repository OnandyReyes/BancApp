

function init(){
	
	jugadasHoyEscritorio();
	
	
	
}

function jugadasHoyEscritorio(){
	$(".abrirModal").click(function(){
		var id = this.id;
		  $.post("../ajax/ticket.php?op=ticketDetalleTable&id="+id,function(r){
			$("#tblticketDetalle").html(r);
		  });
			
		  $('#myModalTicketDetalle').modal('show');
		});

	var table = $('#jugadasHoy').DataTable();
	// tabla =$('#jugadasHoy').dataTable({
	// 	dom:'Bfrtip',
	// 	buttons: [
					
	// 			],
	// 	"bDestroy":true
				
	// }).DataTable();
}


init();