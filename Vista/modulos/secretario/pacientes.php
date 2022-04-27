<?php
 
 require_once"../../../Controlador/controlador.php";
 require_once"../../../Modelo/medico.php";
 require_once"../../../Modelo/secretario.php";
 require_once"../../../Modelo/administrador.php";

?>
	<?php 
session_start();
if (!$_SESSION["secretario"] && !$_SESSION["id_secretario"] && !$_SESSION["medico"] && !$_SESSION["empresa"]) {
  header("location:../../../index.php");
   exit();
}
	?>

<?php 
$rutPaciente = $nombrePaciente = $apellidoPaciente = $fechaNac =$genero = $telefono =  $correo = $direccion = "";
$errorPac = array("rut"=>"","nombre" => "","apellido"=>"","fechaNac"=>"","genero"=>"","telefono"=>"","correo"=>"","direccion"=>"");
if(isset($_POST["pacienteRegistro"])){
  if(isset($_POST["rutPaciente"]) && isset($_POST["nombrePaciente"]) && isset($_POST["apellidoPaciente"]) && isset($_POST["fechaNacPaciente"]) && isset($_POST["genero"]) && isset($_POST["telefonoPaciente"])  && isset($_POST["emailPaciente"]) && isset($_POST["direccionPaciente"])) {

  $rutPaciente = $_POST["rutPaciente"];
  $nombrePaciente = $_POST["nombrePaciente"];
  $apellidoPaciente = $_POST["apellidoPaciente"];
  $fechaNac = $_POST["fechaNacPaciente"];
  $genero = $_POST["genero"];
  $telefono = $_POST["telefonoPaciente"];
  $correo = $_POST["emailPaciente"];
  $direccion = $_POST["direccionPaciente"];


  if(empty($rutPaciente)){
    $errorPac["rut"] = "Ingrese el rut del paciente";

  }else{

    if(!preg_match("/^[0-9]{7,8}-[0-9Kk]{1}/",$rutPaciente)){
      $errorPac["rut"] = "El formato de RUT es incorrecto: Ej: 12345678-4";

    }else{
      $respuesta = Administrador::validarRutUsuario($rutPaciente);
      $respuesta2 = Secretario::validarRutPacienteMedico($_SESSION["medico"],$rutPaciente);
      if(count($respuesta) > 0 || count($respuesta2) > 0){
        $errorPac["rut"] = "El RUT ya ha sido registrado";
  
      }
    }
  

  }
  if(empty($nombrePaciente)){
   $errorPac["nombre"] = "Ingrese el nombre del paciente";
  }else{
    if(!preg_match("/^[a-zA-Z_áéíóúñ\s]*$/",$nombrePaciente)){
      $errorPac["nombre"] = "Un nombre no debe contener numeros";

    }
  }
  if(empty($apellidoPaciente)){
    $errorPac["apellido"] = "Ingrese el apellido del paciente";
   }else{
     if(!preg_match("/^[a-zA-Z_áéíóúñ\s]*$/",$apellidoPaciente)){
       $errorPac["apellido"] = "Un apellido no debe contener numeros";
 
     }
   }
   if(empty($fechaNac)){
    $errorPac["fechaNac"] = "Ingrese la fecha de nacimiento del paciente";
   }else{
     
      $hoy = date("Y-m-d");

       if($fechaNac > $hoy){
        $errorPac["fechaNac"] = "La fecha debe ser inferior a la de hoy";

       }
     
   }
   if(empty($genero)){
    $errorPac["genero"] = "Seleccione el genero del paciente";
   }

   if(empty($telefono)){
    $errorPac["telefono"] = "Ingrese el numero de contacto personal de este usuario";
   }else{
    if(!preg_match("/^(\+?56)?(\s?)(0?9)(\s?)[987654]\d{7}$/",$telefono)){
      $errorPac["telefono"] = "El formato del telefono es incorrecto";
 
     }else{
       if(strlen($telefono) < 12){
        $errorPac["telefono"] = "La cantidad de numeros digitados no es valido";

       }else{
        $respuesta3 = Administrador::validarTelefonoUsuario($telefono);
        $respuesta4 = Secretario::validarTelefonoPacienteMedico($_SESSION["medico"],$telefono);
        if(count($respuesta3) > 0 || count($respuesta4) > 0){
          $errorPac["telefono"] = "El telefono ya ha sido registrado";
    
        }
       }
     }
   }
   if(empty($correo)){
    $errorPac["correo"] = "Ingrese la direccion de correo del usuario";
   }else{
     if(!filter_var($correo ,FILTER_VALIDATE_EMAIL)){
       $errorPac["correo"] = "El formato del correo es incorrecto";
 
     }else{
      $respuesta5 = Administrador::validarEmailUsuario($correo);
      $respuesta6 = Secretario::validarEmailPacienteMedico($_SESSION["medico"],$correo);
      if(count($respuesta5) > 0 || count($respuesta6) > 0){
        $errorPac["correo"] = "El correo ya ha sido registrado";
  
      }
     }
   }
   if(empty($direccion)){
    $errorPac["direccion"] = "Ingrese la dirección del domicilio del paciente";
   }

   if(empty($errorPac["rut"]) && empty($errorPac["nombre"]) && empty($errorPac["apellido"]) && empty($errorPac["genero"]) && empty($errorPac["telefono"]) && empty($errorPac["correo"]) && empty($errorPac["direccion"])){
    $rutPaciente = "";
    $nombrePaciente ="";
     $apellidoPaciente = "";
     $fechaNac = "";
     $genero = "";

     $telefono ="";
      $correo ="";
       $direccion ="";

  }
  }
}


?>
<!doctype html>
<html lang="en">
  <head>
    <title>Pacientes</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
 
  </head>
  <body class="page-top">
  <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <a class="navbar-brand text-uppercase text-light m-2 p-2 " href="#">Medical Manage</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto ml-5 ">
    <li class="nav-item">
        <a class="nav-link text-light mr-4" href="inicio.php">Inicio</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link text-light mr-4" >Pacientes<span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="">Citas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="chat.php">Chat<span id="notificacionChat" class="badge bg-success"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="cuenta.php?action=&idCuenta=<?php echo base64url_encode($_SESSION["id_secretario"]."".$_SESSION["nombreSecretario"]); ?>">Cuenta</a>
      </li>
    </ul>
    <span class="navbar-text">
      <a class="btn btn-danger text-light" href="../logout.php">Cerrar Sesión</a>
    </span>
  </div>
</nav>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center" style="margin-top: 50px;">Pacientes</h1>
            </div>
        </div>
    </div>
     <div class="container">
        <div class="row">
            <div class="col-lg-5">
             
             <div class="card">
               <div class="card-header bg-dark text-light">
                 Registrar paciente
               </div>
               <div class="card-body">
               <form method="POST" id="pacienteRegistroForm">
                    <div class="form-group"><label>RUT</label><input class="form-control" type="text" name="rutPaciente" id="rutPaciente" value="<?php echo $rutPaciente; ?>" data-field="rutPaciente"></div> <div id="valid-rutPac" class="text-danger"></div><div class="valid-message text-danger"><?php echo $errorPac["rut"]; ?></div>
                    <div class="form-group"><label>Nombre</label><input class="form-control" type="text" name="nombrePaciente" id=""value="<?php echo $nombrePaciente; ?>"  data-field="nombrePaciente"></div><div class="valid-message text-danger"<?php echo $errorPac["nombre"]; ?>></div>
                    <div class="form-group"><label>Apellido</label><input class="form-control" type="text" name="apellidoPaciente" id="" value="<?php echo $apellidoPaciente; ?>"  data-field="apellidoPaciente"></div><div class="valid-message text-danger"><?php echo $errorPac["apellido"]; ?></div>        
                    <div class="form-group"><label>fecha de nacimiento</label><input class="form-control" type="date" name="fechaNacPaciente" id=""value="<?php echo $fechaNac; ?>"  data-field="fechaNac"></div><div class="valid-message text-danger"><?php echo $errorPac["fechaNac"]; ?></div>
                    <div class="form-group">
                      <label for="my-select">Género</label>
                      <select id="my-select" class="form-control" name="genero" data-field="genero" required>
                        <option selected disabled>Selecciona un género</option>
                        <option value="1">Masculino</option>
                        <option value="2" >Feminino</option>

                      </select>
                      <div class="valid-message"></div>
                    </div>
                    <div class="form-group"><label>Telefono</label><input class="form-control" type="tel" name="telefonoPaciente" id="" value="<?php echo $telefono; ?>"  data-field="telPaciente"></div><div class="valid-message"><?php echo $errorPac["telefono"]; ?></div>
                    <div class="form-group"><label>Correo</label><input class="form-control" type="email" name="emailPaciente" id="emailPaciente" value="<?php echo $correo; ?>"  data-field="correoPaciente"></div><div id="valid-emailPac" class="text-danger"></div><?php echo $errorPac["correo"]; ?><div class="valid-message"></div>
                    <div class="form-group"><label>Direccion</label><input class="form-control" type="text" name="direccionPaciente" id="" value="<?php echo $direccion; ?>"  data-field="direccionPaciente"></div<div class="valid-message"><?php echo $errorPac["direccion"]; ?></div>
                    <button class="btn btn-primary"
                            type="submit" id="pacienteRegistro"  name="pacienteRegistro">Guardar</button></div>
                </form>
               </div>
              
             </div>

                
                <div class="col-lg-7">
            <div class="num_rows">
		
        <div class="form-group "> 	<!--		Show Numbers Of Rows 		-->
             <select class  ="form-control" name="state" id="maxRows">
                 
                 
                 <option value="10">10</option>
                 <option value="15">15</option>
                 <option value="20">20</option>
                 <option value="50">50</option>
                 <option value="70">70</option>
                 <option value="100">100</option>
    <option value="5000">Show ALL Rows</option>
                </select>
             
          </div>
</div>
<div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Buscar.." class="form-control">
</div>
                <div class="table-responsive" style="margin-top: 30px;">
                    <table class="table" id="pacientes">
                        <thead class="thead-dark">
                            <tr>
                                <th>RUT</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Accion</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php 

                        $registro = new Controlador();
                        $registro ->registrarPacienteController();
                        $editar = new Controlador();
                        $editar ->actualizarPacienteController();
                        $borrado = new Controlador();
                        $borrado->borrarPacienteController();
                        $vista = new Controlador();
                        $vista->listarPacientesController();

                      

?>

                        </tbody>
                    </table>
                    <div class='pagination-container'>
				<nav>
				  <ul class="pagination">
				   <!--	Here the JS Function Will Add the Rows -->
				  </ul>
				</nav>
			</div>
      <div class="rows_count">Showing 11 to 20 of 91 entries</div>

</div> <!-- 		End of Container -->
            </div>
          
                </div>
            </div>
      
    <?php


?>
    
  
  

	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    
    <script src="../../assets/js/script2.js"></script>
    <script src="../../assets/js/jquery.formValid.js"></script>

    <script src="../../assets/js/demo2.js"></script>
    <script src="../../assets/js/validarRegistro2.js"></script>
    <script src="../../assets/js/validarRegistro5.js"></script>
    <script>
  $(document).ready(function(){

    notificacionUsuario();


    setInterval(function () {
        notificacionUsuario();

  }, 5000);


    function notificacionUsuario()
 {
  $.ajax({
    url:"../../../chat/notificaciones.php",
   method:"POST",
   success:function(data){
    $('#notificacionChat').html(data);
    
      
   }
  })

 }

});
</script>

  </body>
</html>
