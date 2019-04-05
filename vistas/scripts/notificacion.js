function init(){
	$.ajaxSetup({"cache":false});
	setInterval("buscarNotificacion()",10000);
}

function buscarNotificacion(){
	$.post("../ajax/chat.php?op=buscarNotificacion",function(r){
		data = JSON.parse(r);
		
		if(data.disponible){
			Push.create("WaterApp",{
				body: "Usted tiene un nuevo mensaje!",
				icon: "",
				timeout: 5000,
				onClick: function () {
					window.location="http://localhost:8080/waterapp/vistas/chat.php";
					this.close();
				}
			});
		}
	});
	
}


init();