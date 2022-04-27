var formMed2 = $('#medEdit').formValid({
	fields: {
		"editNombreMed": {
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
		"editDes": {
			"required": true,
			"tests": [
				{
					"type": "null", 
					"message": "Ingrese la descripción de este medicamento"
				},
		
			]
		},
		"editMil": {
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

formMed2.keypress(300);

$('#editarMed').click(function() {
	
	formMed2.test();
	
	if (formMed2.errors() == 0) {

		//alert('Ok');
		return true;

	}
	
	return false;
		
});