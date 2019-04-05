var tabla;

//Funcion que se ejecuta al inicio
function init(){
	var id_usuario = $("#id_usuario2").val();
	

	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})

	var id_usuario_tipo = $("#id_usuario_tipo").val();
	if(id_usuario_tipo == 2){
		
		$.post("../ajax/cliente.php?op=selectCliente_tipo",function(r){
			$("#id_cliente_tipo").html(r);
			$('#id_cliente_tipo').selectpicker('refresh');

			$.post("../ajax/usuario.php?op=selectProvincia",function(r){
				$("#id_provincia").html(r);
				$('#id_provincia').selectpicker('refresh');

				$("#id_provincia option:selected").each(function(){
			        elegido = $(this).val();
			        $.post("../ajax/usuario.php?op=selectMunicipio", {id_provincia: elegido}, function(r){
			        	$("#id_municipio").html(r);
			        	$('#id_municipio').selectpicker('refresh');

			        	$.post("../ajax/ruta.php?op=selectRuta",function(r){
							$("#id_ruta").html(r);
							$('#id_ruta').selectpicker('refresh');
							var id_ruta = $("#id_ruta").val();
							$("#btnMapa").html('<a target="_blank" class="btn btn-warming col-md-1" href="http://localhost:8080/waterapp/vistas/mapa.php?id='+id_ruta+'" >Mapa</a> ');
							mostrar(id_usuario);
						});
			        });
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

		$("#id_ruta").change(function(){
			$("#id_ruta option:selected").each(function(){
		        var id_ruta = $(this).val();
				$("#btnMapa").html('<a target="_blank" class="btn btn-warming" col-md-1" href="http://localhost:8080/waterapp/vistas/mapa.php?id='+id_ruta+'" >Mapa</a> ');
		    });
	    });
	}else{

		$.post("../ajax/usuario.php?op=selectUsuario_tipo",function(r){
			$("#id_usuario_tipo").html(r);
			$('#id_usuario_tipo').selectpicker('refresh');

			$.post("../ajax/usuario.php?op=selectProvincia",function(r){
				$("#id_provincia").html(r);
				$('#id_provincia').selectpicker('refresh');

				$("#id_provincia option:selected").each(function(){
			        elegido = $(this).val();
			        $.post("../ajax/usuario.php?op=selectMunicipio", {id_provincia: elegido}, function(r){
			        	$("#id_municipio").html(r);
			        	$('#id_municipio').selectpicker('refresh');

			        	mostrar(id_usuario);
			        });
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
	
}

function mostrar(id_usuario){
	$("#formularioregistros").show();
	$("#btnGuardar").prop("disabled",false);
	var id_usuario_tipo = $("#id_usuario_tipo").val();
	if(id_usuario_tipo == 2){
		$.post("../ajax/cliente.php?op=mostrar",{id_usuario : id_usuario}, function(data,status){
			data = JSON.parse(data);
			
			$("#id_usuario").val(data.id_usuario);
			$("#nombres").val(data.nombres);
			$("#apellidos").val(data.apellidos);
			$("#cedularnc").val(data.cedularnc);
			$("#direccion").val(data.direccion);
			$("#telefono").val(data.telefono);
			$("#celular").val(data.celular);
			$("#correo").val(data.correo);
			$("#lat").val(data.lat);
			$("#lon").val(data.lon);
			$("#claveactual").val(data.clave);
			$("#id_cliente_tipo").val(data.id_cliente_tipo);
			$('#id_cliente_tipo').selectpicker('refresh');
			$("#id_provincia").val(data.id_provincia);
			$('#id_provincia').selectpicker('refresh');
			$.post("../ajax/usuario.php?op=selectMunicipio", {id_provincia: data.id_provincia}, function(r){
		        	$("#id_municipio").html(r);
		        	$('#id_municipio').selectpicker('refresh');
		        	$("#id_municipio").val(data.id_municipio);
		        	$('#id_municipio').selectpicker('refresh');
		    });
			$("#id_ruta").val(data.id_ruta);
			$('#id_ruta').selectpicker('refresh');
			$("#btnMapa").html('<a target="_blank" class="btn btn-warming" col-md-1" href="http://localhost:8080/waterapp/vistas/mapa.php?id='+data.id_ruta+'" >Mapa</a> ');
		})
	}else{
		$.post("../ajax/usuario.php?op=mostrar",{id_usuario : id_usuario}, function(data,status){
			data = JSON.parse(data);

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

		})
	}
	
}

function guardaryeditar(e){
	e.preventDefault(); //No se activara la accion predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	var id_usuario_tipo = $("#id_usuario_tipo").val();
	if(id_usuario_tipo == 2){
		$.ajax({
			url: "../ajax/cliente.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				data = JSON.parse(datos);
				
				if(data.estado){
					var id_usuario = $("#id_usuario2").val();
					mostrar(id_usuario);
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
	}else{
		$.ajax({
			url: "../ajax/usuario.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){
				data = JSON.parse(datos);
				
				if(data.estado){
					var id_usuario = $("#id_usuario2").val();
					mostrar(id_usuario);
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
	}
	
}

init();