
////Medicamentos

var formMed = $('#medForm').formValid({
	fields: {
		"medNombre": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el nombre para este medicamento"
				},
				{
                    "regex": "^[a-zA-Z_áéíóúñ\s]*$", 
                    "message": "Un nombre no debe contener numeros"
                }
			]
		},
		"medDes": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Ingrese la descripción de este medicamento"
				},
		
			]
		},
		"medMil": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite la cantidad de miligramos de este medicamento"
				},
				{
					"type": "number", 
                    "message": "Digitar numeros en lugar de caracteres"
				},

			]
		}
		

	}
});

formMed.keypress(300);

$('#medRegistro').click(function() {
	
	formMed.test();
	
	if (formMed.errors() == 0) {

		//alert('Ok');
		return true;

	}
	
	return false;
		
});

////Consulta form

var formConsulta = $('#consultaForm').formValid({
	fields: {
		"motivoConsulta": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Ingrese el motivo de consulta"
				}
			]
		},
		"diagnostico": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Ingrese el diagnostico del paciente"
				},
		
			]
		}
		

	}
});

formConsulta.keypress(300);

$('#consultaRegistro').click(function() {
	
	formConsulta.test();
	
	if (formConsulta.errors() == 0) {

		//alert('Ok');
		return true;

	}
	
	return false;
		
});


////Signos

var formSignos = $('#signosForm').formValid({
	fields: {
		"preArterial": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite la presion actual del paciente"
				},
				{
					"type": "number", 
                    "message": "Digitar numeros en lugar de caracteres"
				},

			]
		},
		"pulso": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el pulso actual del paciente"
				},
				{
					"type": "number", 
                    "message": "Digitar numeros en lugar de caracteres"
				},

			]
		},
		"peso": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el peso actual del paciente"
				},
				{
					"type": "number", 
                    "message": "Digitar numeros en lugar de caracteres"
				},

			]
		},
		"altura": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite la altura actual del paciente"
				},
				{
					"type": "number", 
                    "message": "Digitar numeros en lugar de caracteres"
				},

			]
		}
		

	}
});

formSignos.keypress(300);

$('#signosRegistro').click(function() {
	
	formSignos.test();
	
	if (formSignos.errors() == 0) {

		//alert('Ok');
		return true;

	}
	
	return false;
		
});




////Inicio de sesión

var formLogin = $('#loginForm').formValid({
	fields: {
		"correoLogin": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Ingrese el correo de su cuenta"
				},
				{
					"type": "email", 
					"message": "El formato del correo es incorrecto"
				}
			]
		},
		"passLogin": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Ingrese la contraseña de su cuenta"
				}

			]
		}

	}
});

formLogin.keypress(300);

$('#entrarLog').click(function() {
	
	formLogin.test();
	
	if (formLogin.errors() == 0) {

		//alert('Ok');
		return true;

	}
	
	return false;
		
});


