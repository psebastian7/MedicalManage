var telefonoExistente = false;

$("#telefonoUsuario").change(function () { 
	
	var verTelefono = $("#telefonoUsuario").val();
	if(verTelefono != ""){

	
	$.ajax({
		type: "POST",
		url: "../../../Controlador/validarRep5.php",
		data: {"verTelefono":verTelefono},

		success: function(respuesta){
			if(respuesta == 0){
				$("#valid-tel").html("El telefono de este usuario ya existe como registro");

				telefonoExistente = true;
				
			}else{
				$("#valid-tel").html("El telefono de este usuario ya existe como registro");

				telefonoExistente = false;
			}
		}
	});
}

});

$("#adminRegistro").click(function(){
	if(telefonoExistente ==true){
        $("#valid-tel").html("El telefono de este usuario ya existe como registro");
		return false;
	}else{
        $("#valid-tel").html("");

    }

    });
    
	$("#secretarioRegistro").click(function(){
		if(telefonoExistente ==true){
			$("#valid-tel").html("El telefono de este usuario ya existe como registro");
			return false;
		}else{
			$("#valid-tel").html("");
	
		}
	
		});
		$("#medicoRegistro").click(function(){
			if(telefonoExistente ==true){
				$("#valid-tel").html("El telefono de este usuario ya existe como registro");
				return false;
			}else{
				$("#valid-tel").html("");
		
			}
		
			});