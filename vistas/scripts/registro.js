var tabla;


//Funcion que se ejecuta al inicio
function init(){
	

	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})

	$.post("../ajax/cliente.php?op=selectCliente_tipo",function(r){
		$("#id_cliente_tipo").html(r);
		$('#id_cliente_tipo').selectpicker('refresh');
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

    $.post("../ajax/ruta.php?op=selectRuta",function(r){
		$("#id_ruta").html(r);
		$('#id_ruta').selectpicker('refresh');
		var id_ruta = $("#id_ruta").val();
		$("#btnMapa").html('<a target="_blank" class="btn btn-warming col-md-2" href="http://localhost:8080/waterapp/vistas/mapa.php?id='+id_ruta+'" >Mapa</a> ');
	});

	$("#id_ruta").change(function(){
		$("#id_ruta option:selected").each(function(){
	        var id_ruta = $(this).val();
			$("#btnMapa").html('<a target="_blank" class="btn btn-warming col-md-2" href="http://localhost:8080/waterapp/vistas/mapa.php?id='+id_ruta+'" >Mapa</a> ');
	    });
    });

	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(function (position){
			$("#lat").val(position.coords.latitude);	
			$("#lon").val(position.coords.longitude);
		})
		
	}else{
		alert("El navegador no soporta la geocalizacion")
	}
}

//Funcion limpiar
function limpiar(){

	$("#nombres").val("");
	$("#apellidos").val("");
	$("#cedularnc").val("");
	$("#direccion").val("");
	$("#telefono").val("");
	$("#celular").val("");
	$("#correo").val("");
	$('#clave').val("");
	$('#clave_repetir').val("");
	$("#id_provincia").val(1);
	$('#id_provincia').selectpicker('refresh');

}

function guardaryeditar(e){
	e.preventDefault(); //No se activara la accion predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/cliente.php?op=guardaryeditarregistro",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos){
			
			data = JSON.parse(datos);
			
			if(data.estado){
				limpiar();
				bootbox.alert(data.mensaje);
				window.location.replace("http://localhost:8080/waterapp/vistas/login.html");
				//window.location.href = "http://localhost:8080/waterapp/vistas/login.html";
				
			}else{
				if(data.cedularnc == ""){
					$("#cedularnc").val("");
				}

				if(data.correo == ""){
					$("#correo").val("");
				}

				if(data.clave == ""){
					$('#clave').val("");
					$('#clave_repetir').val("");
				}
				
				bootbox.alert(data.mensaje);
			}
		}
	});
}

init();