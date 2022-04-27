//VALIDAR REGISTRO USUARIO
var rutUsExistente = false;
var emailUsExistente = false;

$("#rutUsuario").change(function () { 
	var verRut = $("#rutUsuario").val();

	$.ajax({
		type: "POST",
		url: "../../../Controlador/validarRep1.php",
		data: {'verRut':verRut},

		success: function(respuesta){
			if(respuesta == 0){
				$("#valid-rut").html("Rut repetido");

				rutUsExistente = true;

				
			}else{
				$("#valid-rut").html("");
				rutUsExistente = false;

			}
		}
	});

});
$("#emailUsuario").change(function () { 
	var verEmail = $("#emailUsuario").val();

	$.ajax({
		type: "POST",
		url: "../../../Controlador/validarRep2.php",
		data: {'verEmail':verEmail},

		success: function(respuesta){
			if(respuesta == 0){
				$("#valid-email").html("Email repetido");

				emailUsExistente = true;

				
			}else{
				$("#valid-email").html("");
				emailUsExistente = false;

			}
		}
	});

});



$("#adminRegistro").submit(function(){
if(rutUsExistente ==true){
	$("#valid-rut").html("Rut repetido");
	return false;
}
if(emailUsExistente ==true){
	$("#valid-email").html("Email repetido");
	return false;
}

});



