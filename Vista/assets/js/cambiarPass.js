
var coincidencia = false;


$("#passUsuarioN2").change(function () { 
	var pass1 = $("#passUsuarioN2").val();
	
	var pass2 = $("#passUsuarioN").val();

	   if(pass1 == pass2){
        $("#concidencia").html("En hora buena, ambas contraseñas coinciden");
        coincidencia = true;

       }else{
        $("#concidencia").html("Ambas contraseñas no coinciden!");
        coincidencia = false;

       }
	  

	
    

});
$("#cambiarPass").click(function(){
	if(coincidencia ==false){
        $("#concidencia").html("Ambas contraseñas no coinciden!");
		return false;
	}

	});