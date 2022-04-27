var rutPacExistente = false;
var emailPacExistente = false;

$("#rutPaciente").change(function () { 
	var verRut = $("#rutPaciente").val();

	$.ajax({
		type: "POST",
		url: "../../../Controlador/validarRep1.php",
		data: {'verRut':verRut},

		success: function(respuesta){
			if(respuesta == 0){
				$("#valid-rutPac").html("Rut repetido");

				rutPacExistente = true;

				
			}else{
				$("#valid-rutPac").html("");
				rutPacExistente = false;

			}
		}
	});

});
$("#emailPaciente").change(function () { 
	var verEmail = $("#emailPaciente").val();

	$.ajax({
		type: "POST",
		url: "../../../Controlador/validarRep2.php",
		data: {'verEmail':verEmail},

		success: function(respuesta){
			if(respuesta == 0){
				$("#valid-emailPac").html("Email repetido");

				emailPacExistente = true;

				
			}else{
				$("#valid-emailPac").html("");
				emailPacExistente = false;

			}
		}
	});

});
$("#pacienteRegistro").click(function(){
if(rutPacExistente ==true){
	$("#valid-rutPac").html("Rut repetido");
	return false;
}
if(emailPacExistente ==true){
	$("#valid-emailPac").html("Email repetido");
	return false;
}
});



