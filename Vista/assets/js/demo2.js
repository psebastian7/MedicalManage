var formEmpresa = $('#empresaRegistroForm').formValid({
	fields: {
		"nombreEmpresa": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Ingrese el nombre de una nueva empresa"
				},

			]
		},
		"direccionEmpresa": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Ingrese la dirección de la empresa"
				}

			]
		},
		"regionEmpresa": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Seleccione la region de origen de la empresa"
				}

			]
		},
		"comunaEmpresa": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Seleccione la comuna de origen de la empresa"
				}

			]
		}


	}
});

formEmpresa.keypress(300);

$('#empresaRegistro').click(function() {
	
	formEmpresa.test();
	
	if (formEmpresa.errors() == 0) {

		//alert('Ok');
		return true;

	}
	
	return false;
		
});

///Formulario grupo admin
var form = $('#adminRegistroForm').formValid({
	fields: {
		"rutUser": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el rut(Unico) para este usuario"
				},
				{
                    "regex": "[0-9]{7,8}-[0-9Kk]{1}", 
                    "message": "Formato de RUT incorrecto"
                }

			]
		},
		"nombreUs": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el nombre para este usuario"
				},
				{
                    "regex": "^[a-zA-Z_áéíóúñ\s]*$", 
                    "message": "Un nombre no debe contener numeros"
                }
			]
		},
		"apeUs": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el apellido para este usuario"
				},
				{
                    "regex": "^[a-zA-Z_áéíóúñ\s]*$", 
                    "message": "Un apellido no debe contener numeros"
                }
			]
		},
		"telUs": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el numero de contacto del usuario"
				},
				{
					"type": "phone", 
                    "message": "El telefono es incorrecto"
				},
				{
                    "regex": "/^(\+?56)?(\s?)(0?9)(\s?)[987654]\d{7}$/", 
                    "message": "El telefono es incorrecto"
                }
			]
		},
		"emailUs": {
			"required": true, 
			"tests": [
				{
					"type": "null", 
					"message": "Favor de ingresar un correo"
				},
				{
					"type": "email", 
					"message": "El email introducido es incorrecto"
				}
			]
		},
		"passUs": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite una contraseña para este usuario"
				}
			]
		}

	}
});

form.keypress(300);

$('#adminRegistro').click(function() {
	
	form.test();
	
	if (form.errors() == 0) {

	//	alert('Ok');
	return true;

	}
	
	return false;
		
});

///Formulario medicos
var formMedico = $('#medicoRegistroForm').formValid({
	fields: {
		"rutUser": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el rut(Unico) para este usuario"
				},
				{
                    "regex": "[0-9]{7,8}-[0-9Kk]{1}", 
                    "message": "Formato de RUT incorrecto"
                }

			]
		},
		"nombreUs": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el nombre para este usuario"
				},
				{
                    "regex": "^[a-zA-Z_áéíóúñ\s]*$", 
                    "message": "Un nombre no debe contener numeros"
                }
			]
		},
		"apeUs": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el apellido para este usuario"
				},
				{
                    "regex": "^[a-zA-Z_áéíóúñ\s]*$", 
                    "message": "Un apellido no debe contener numeros"
                }
			]
		},
		"telUs": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el numero de contacto del usuario"
				},
				{
					"type": "phone", 
                    "message": "El telefono es incorrecto"
				},
				{
                    "regex": "/^(\+?56)?(\s?)(0?9)(\s?)[987654]\d{7}$/", 
                    "message": "El telefono es incorrecto"
                }
			]
		},
		"emailUs": {
			"required": true, 
			"tests": [
				{
					"type": "null", 
					"message": "Favor de ingresar un correo"
				},
				{
					"type": "email", 
					"message": "El email introducido es incorrecto"
				}
			]
		},
		"passUs": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite una contraseña para este usuario"
				}
			]
		},
		"especialidad": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Seleccione la especialidad del médico"
				}
			]
		}
	}
});

formMedico.keypress(300);

$('#medicoRegistro').click(function() {
	
	formMedico.test();
	
	if (formMedico.errors() == 0) {

	//	alert('Ok');
	return true;

	}
	
	return false;
		
});

/// Formulario secretario
var formSecretario = $('#secretarioRegistroForm').formValid({
	fields: {
		"rutUser": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el rut(Unico) para este usuario"
				},
				{
                    "regex": "[0-9]{7,8}-[0-9Kk]{1}", 
                    "message": "Formato de RUT incorrecto"
                }

			]
		},
		"nombreUs": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el nombre para este usuario"
				},
				{
                    "regex": "^[a-zA-Z_áéíóúñ\s]*$", 
                    "message": "Un nombre no debe contener numeros"
                }
			]
		},
		"apeUs": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el apellido para este usuario"
				},
				{
                    "regex": "^[a-zA-Z_áéíóúñ\s]*$", 
                    "message": "Un apellido no debe contener numeros"
                }
			]
		},
		"telUs": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el numero de contacto del usuario"
				},
				{
					"type": "phone", 
                    "message": "El telefono es incorrecto"
				},
				{
                    "regex": "/^(\+?56)?(\s?)(0?9)(\s?)[987654]\d{7}$/", 
                    "message": "El telefono es incorrecto"
                }
			]
		},
		"emailUs": {
			"required": true, 
			"tests": [
				{
					"type": "null", 
					"message": "Favor de ingresar un correo"
				},
				{
					"type": "email", 
					"message": "El email introducido es incorrecto"
				}
			]
		},
		"passUs": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite una contraseña para este usuario"
				}
			]
		}
	}
});

formSecretario.keypress(300);

$('#secretarioRegistro').click(function() {
	
	formSecretario.test();
	
	if (formSecretario.errors() == 0) {

	//	alert('Ok');
	return true;

	}
	
	return false;
		
});

/// Formulario paciente
var formPaciente = $('#pacienteRegistroForm').formValid({
	fields: {
		"rutPaciente": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el rut(Unico) del paciente"
				},
				{
                    "regex": "[0-9]{7,8}-[0-9Kk]{1}", 
                    "message": "Formato de RUT incorrecto"
                }

			]
		},
		"nombrePaciente": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el nombre del paciente"
				},
				{
                    "regex": "^[a-zA-Z_áéíóúñ\s]*$", 
                    "message": "Un nombre no debe contener numeros"
                }
			]
		},
		"apellidoPaciente": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el apellido del paciente"
				},
				{
                    "regex": "^[a-zA-Z_áéíóúñ\s]*$", 
                    "message": "Un apellido no debe contener numeros"
                }
			]
		},
		"generoPaciente": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Indique el genero del paciente"
				},
			
			]
		},

		"telPaciente": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Digite el numero de contacto del paciente"
				},
				{
					"type": "phone", 
                    "message": "El telefono es incorrecto"
				},
				{
                    "regex": "/^(\+?56)?(\s?)(0?9)(\s?)[987654]\d{7}$/", 
                    "message": "El telefono es incorrecto"
                }
			]
		},
		"correoPaciente": {
			"required": true, 
			"tests": [
				{
					"type": "null", 
					"message": "Favor de ingresar un correo"
				},
				{
					"type": "email", 
					"message": "El correo introducido es incorrecto"
				}
			]
		},
		"direccionPaciente": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Ingrese la dirección del domicilio del paciente"
				}
			]
		},
	}
});

formPaciente.keypress(300);

$('#pacienteRegistro').click(function() {
	
	formPaciente.test();
	
	if (formPaciente.errors() == 0) {

	//	alert('Ok');
	return true;

	}
	
	return false;
		
});

//Chat
var formChat = $('#chat').formValid({
	fields: {
		"mensajeChat": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": ""
				}

			]
		}

	}
});

formChat.keypress(300);

$('.btnEnviar').click(function() {
	
	formChat.test();
	
	if (formChat.errors() == 0) {

	//	alert('Ok');
	return true;

	}
	
	return false;
		
});

