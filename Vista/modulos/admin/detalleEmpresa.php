<?php 
session_start();
if (  !$_SESSION["admin"]   && !$_SESSION["id_admin"]   )  {
   header("location:../../../index.php");
   exit();
}
	?>
<?php
 
 require_once"../../../Controlador/controlador.php";
 require_once"../../../Modelo/medico.php";
 require_once"../../../Modelo/administrador.php";
 require_once"../../../Modelo/secretario.php";

?>
<?php
$rut = $nombre = $apellido = $telefono = $correo = $pass = $espMedica ="";
$errorEsp = array("rut" => "","nombre"=>"","apellido"=>"", "telefono"=>"","correo"=>"","pass"=>"","especialidad"=>"");

if(isset($_POST["medicoRegistro"])){

  if(isset($_POST["rutMedico"]) && isset($_POST["nombreMedico"]) && isset($_POST["apellidoMedico"]) && isset($_POST["telefonoMedico"])  && isset($_POST["emailMedico"]) && isset($_POST["passMedico"]) && isset($_POST["especialidad"])) {
   
    $rut = $_POST["rutMedico"];
    $nombre = $_POST["nombreMedico"];
    $apellido = $_POST["apellidoMedico"];
    $telefono = $_POST["telefonoMedico"];
    $correo = $_POST["emailMedico"];
    $pass = $_POST["passMedico"];
    $espMedica = $_POST["especialidad"];

    if(empty($rut)){
      $errorEsp["rut"] = "Ingrese el rut de este usuario ";
    }else{
      if(!preg_match("/^[0-9]{7,8}-[0-9Kk]{1}/",$rut)){
        $errorEsp["rut"] = "El formato de RUT es incorrecto: Ej: 12345678-4";

      }else{
        $respuesta = Administrador::validarRutUsuario($rut);
        $respuesta2 = Secretario::validarRutPaciente($rut);
         if(count($respuesta) > 0 || count($respuesta2) > 0){
          $errorEsp["rut"] = "Este RUT ya ha sido registrado";

         }

      }

    }

    if(empty($nombre)){
      $errorEsp["nombre"] = "Ingrese un nombre para este medicamento";
     }else{
       if(!preg_match("/^[a-zA-Z_áéíóúñ\s]*$/",$nombre)){
         $errorEsp["nombre"] = "Un nombre no debe contener numeros";
   
       }
     }
     if(empty($apellido)){
      $errorEsp["apellido"] = "Ingrese un nombre para este medicamento";
     }else{
       if(!preg_match("/^[a-zA-Z_áéíóúñ\s]*$/",$apellido)){
         $errorEsp["apellido"] = "Un nombre no debe contener numeros";
   
       }
     }
     if(empty($telefono)){
      $errorEsp["telefono"] = "Ingrese el numero de contacto personal de este usuario";
     }else{
      if(!preg_match("/^(\+?56)?(\s?)(0?9)(\s?)[987654]\d{7}$/",$telefono)){
        $errorEsp["telefono"] = "El formato del telefono es incorrecto";
   
       }else{
         if(strlen($telefono) < 12){
          $errorEsp["telefono"] = "La cantidad de numeros digitados no es valido";

         }else{
          $respuesta3 = Administrador::validarTelefonoUsuario($telefono);
          $respuesta4 = Secretario::validarTelefonoPaciente($telefono);
          if(count($respuesta3) > 0 || count($respuesta4) > 0){
            $errorEsp["telefono"] = "El telefono ya ha sido registrado";
      
          }
         }
       }
     }
     if(empty($correo)){
      $errorEsp["correo"] = "Ingrese la direccion de correo del usuario";
     }else{
       if(!filter_var($correo ,FILTER_VALIDATE_EMAIL)){
         $errorEsp["correo"] = "El formato del correo es incorrecto";
   
       }else{
        $respuesta5 = Administrador::validarEmailUsuario($correo);
        $respuesta6 = Secretario::validarEmailPaciente($correo);
        if(count($respuesta5) > 0 || count($respuesta6) > 0){
          $errorEsp["correo"] = "El correo ya ha sido registrado";
    
        }
       }
     }
     if(empty($pass)){
      $errorEsp["pass"] = "Ingrese una contraseña para la cuenta de este usuario";

     }
     if(empty($espMedica)){
      $errorEsp["especialidad"] = "Seleccione una especialidad médica";

     }
   
    if(empty($errorEsp["rut"]) && empty($errorEsp["nombre"]) && empty($errorEsp["apellido"]) && empty($errorEsp["telefono"]) && empty($errorEsp["correo"]) && empty($errorEsp["pass"]) && empty($errorEsp["especialidad"])){
      $rut = "";
      $nombre ="";
       $apellido = "";
       $telefono ="";
        $correo ="";
         $pass ="";
         $espMedica ="";

    }
  }


}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Empresas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="../../assets/js/jquery.formValid.js"></script>
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
        <a class="nav-link text-light mr-4" >Empresas<span class="sr-only"></span></a>
      </li>
    </ul>
    <span class="navbar-text">
      <a class="btn btn-danger text-light" href="../logout.php">Cerrar Sesión</a>
    </span>
  </div>
</nav>

    <div class="container">

        <div class="row">
        <h2 class="text-left" >  <a href="empresas.php">  <i class="fa fa-arrow-left  mt-3"   aria-hidden="true">Volver atras</i></a></h2>

           
            <div class="col-lg-7">
            
                <h1 class="text-center" style="margin-top: 50px;">Empresas</h1>
            </div>
        </div>
    </div>

   <div class="container">
   <div class="row">
   
  <div class="col-lg-12 ">
  <div class="card">
      <div class="card-header bg-dark text-light">
          Información Empresa
      </div>
      <div class="card-body">

     <?php
    $detalle = new Controlador();
    $detalle->detalleEmpresaController();
     ?>

      </div>
      
  </div>
  

  </div>
  
</div>

<div class="row">
 
<div class="col-lg-5">
<div class="card mt-4">
           <div class="card-header bg-dark text-light">
               Registrar especialista
           </div>
           <div class="card-body">
               <form method="POST" id="medicoRegistroForm">
               <div class="form-group"><label for="rutLabel">RUT</label><input class="form-control" type="text" name="rutMedico" id="rutUsuario" data-field="rutUser" value="<?php echo $rut; ?>" ><div id="valid-rut" class="text-danger"></div>  <div  class="valid-message text-danger"><?php echo $errorEsp["rut"]; ?></div></div>
                    <div class="form-group"><label for="nombreLabel">Nombre</label><input class="form-control" type="text" name="nombreMedico" id="nombreMedico" data-field="nombreUs" value="<?php echo $nombre; ?>"> <div class="valid-message text-danger"><?php echo $errorEsp["nombre"]; ?></div></div>
                    <div class="form-group"><label for="apellidoLabel">Apellido</label><input class="form-control" type="text" name="apellidoMedico" id="apellidoMedico" data-field="apeUs" value="<?php echo $apellido; ?>">  <div class="valid-message text-danger"><?php echo $errorEsp["apellido"]; ?></div></div>
                    <div class="form-group"><label for="telefonoLabel">Telefono</label><input class="form-control" type="tel" name="telefonoMedico" id="telefonoUsuario" data-field="telUs" value="<?php echo $telefono; ?>"><div id="valid-tel" class="text-danger"></div>  <div class="valid-message text-danger"><?php echo $errorEsp["telefono"]; ?></div></div>
                    <div class="form-group"><label for="emailLabel">Correo</label><span></span><input class="form-control" type="email" name="emailMedico" id="emailUsuario" data-field="emailUs"  value="<?php echo $correo; ?>"><div id="valid-email" class="text-danger"></div> <div  class="valid-message text-danger"><?php echo $errorEsp["correo"]; ?></div></div>
                    <div class="form-group" ><label for="passLabel">Contraseña</label><input class="form-control" type="password" name="passMedico" id="passMedico" data-field="passUs" value="<?php echo $pass; ?>"> <div  class="valid-message text-danger"><?php echo $errorEsp["pass"]; ?></div></div>
                    <div class="form-group">
                        <label for="my-input">Especialidad</label>
                    <select id="especialidad" name="especialidad[]" class="form-control" data-field="especialidad" >
                    <option selected disabled >  Seleccione la especialidad del medico</option>
                    <?php
                    $especialidad = new Controlador();
                    $especialidad ->listarEspecialidadController();
                    ?>
                    </select>
                    <div  class="valid-message text-danger"><?php echo $errorEsp["especialidad"]; ?></div>
                    </div>
                    
                 
                <button class="btn btn-primary mt-2"
                        type="submit" id="medicoRegistro"  name="medicoRegistro">Guardar</button></div>

                </form>
           </div>        
       </div>
<div class="col-lg-7">
  <div  class="table-responsive" style="margin-top: 30px;">
  <h2>Equipo medico</h2>

                    <table id="empresas" class="table ">
                        <thead class="thead-dark">
                            <tr>
                                <th>RUT</th>
                                <th>Correo</th>
                                <th>Especialidad</th>
                                <th>Acción</th>

                            </tr>
                        </thead>
                        <tbody>
                        
                        <?php 
                 $registro = new Controlador();
                 $registro ->registrarUsuarioConctroller();
                 $vista = new Controlador();
                 $vista->listarMedicosEmpresaController();

                
                 

?>
                        </tbody>
                    </table>

         </div>
         </div>
</div>




</div>
   </div>


     

 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
     <script src="../../assets/js/validarRegistro.js"></script>
     <script src="../../assets/js/validarRegistro5.js"></script>

    <script src="../../assets/js/jquery.formValid.js"></script>



  <script src="../../assets/js/demo2.js"></script>
  <script src="../../assets/js/regionesycomunas.js"></script>


  </body>
</html>
