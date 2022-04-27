var nombreExistente = false;

$("#nombreEmpresa").change(function () { 
	
	var verNombre = $("#nombreEmpresa").val();
	if(verNombre != ""){

	
	$.ajax({
		type: "POST",
		url: "../../../Controlador/validarRep4.php",
		data: {"verNombre":verNombre},

		success: function(respuesta){
			if(respuesta == 0){
				$("#valid-nom").html("El nombre de la empresa ya existe como registro");

				nombreExistente = true;
				
			}else{
				$("#valid-nom").html("");

				nombreExistente = false;
			}
		}
	});
}

});

$("#empresaRegistro").click(function(){
	if(nombreExistente ==true){
        $("#valid-nom").html("El nombre de la empresa ya existe como registro");
		return false;
	}else{
        $("#valid-nom").html("");

    }

	});