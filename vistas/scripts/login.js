$("#formAcceso").on('submit',function(e){
	e.preventDefault();
	correoa=$("#correoa").val();
	clavea=$("#clavea").val();

	$.post("../ajax/cuentas.php?op=verificar",
		{"correoa":correoa,"clavea":clavea},
		function(data){
			if(data != "null"){
				$(location).attr("href","escritorio.php");
			}else{
				bootbox.alert("Correo y/o Clave son incorrectos.");
			}
		});

})