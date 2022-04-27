var milExistente = false;


$("#medMil").change(function () { 
	var verMil = $("#medMil").val();
	
	var verNombre = $("#medNombre").val();
	if(verNombre != "" && verMil != ""){

	
	$.ajax({
		type: "POST",
		url: "../../../Controlador/validarRep3.php",
		data: {'verMil':verMil,"verNombre":verNombre},

		success: function(respuesta){
			if(respuesta == 0){
				$("#valid-med").html("Un medicamento no se puede repetir su miligramo");

				milExistente = true;
				
			}else{
				$("#valid-med").html("");

				milExistente = false;
			}
		}
	});
}

});
$("#medRegistro").click(function(){
	if(milExistente ==true){
		$("#valid-med").html("Un medicamento no se puede repetir su miligramo");
		return false;
	}

	});
	$("#editarMed").click(function(){
		if(milExistente ==true){
			$("#valid-med2").html("Un medicamento no se puede repetir su miligramo");
			return false;
		}
	
		});