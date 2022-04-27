<?php 
session_start();
if (!$_SESSION["medico"] && !$_SESSION["id_medico"] && !$_SESSION["empresa"]  ) {
   header("location:../../../index.php");
   exit();
}

	?>
<?php
 

 require_once"../../../Modelo/medico.php";
 require_once"../../../Modelo/secretario.php";
 require_once"../../../Modelo/administrador.php";

 require_once"../../../Controlador/controlador.php";

?>
<?php 
  $rut = $nombre = $apellido = $telefono = $correo = $pass ="";
  $errorSec = array("rut" => "","nombre"=>"","apellido"=>"", "telefono"=>"","correo"=>"","pass"=>"");
  
 if(isset($_POST["secretarioRegistro"])){

    if(isset($_POST["rutSecretario"]) && isset($_POST["nombreSecretario"]) && isset($_POST["apellidoSecretario"]) && isset($_POST["telefonoSecretario"])  && isset($_POST["emailSecretario"]) && isset($_POST["passSecretario"])) {
     
      $rut = $_POST["rutSecretario"];
      $nombre = $_POST["nombreSecretario"];
      $apellido = $_POST["apellidoSecretario"];
      $telefono = $_POST["telefonoSecretario"];
      $correo = $_POST["emailSecretario"];
      $pass = $_POST["passSecretario"];

      if(empty($rut)){
        $errorSec["rut"] = "Ingrese el rut de este usuario ";
      }else{
        if(!preg_match("/^[0-9]{7,8}-[0-9Kk]{1}/",$rut)){
          $errorSec["rut"] = "El formato de RUT es incorrecto: Ej: 12345678-4";

        }else{
          $respuesta = Administrador::validarRutUsuario($rut);
          $respuesta2 = Secretario::validarRutPaciente($rut);
           if(count($respuesta) > 0 || count($respuesta2) > 0){
            $errorSec["rut"] = "Este RUT ya ha sido registrado";

           }

        }

      }

      if(empty($nombre)){
        $errorSec["nombre"] = "Ingrese un nombre para este medicamento";
       }else{
         if(!preg_match("/^[a-zA-Z_áéíóúñ\s]*$/",$nombre)){
           $errorSec["nombre"] = "Un nombre no debe contener numeros";
     
         }
       }
       if(empty($apellido)){
        $errorSec["apellido"] = "Ingrese un nombre para este medicamento";
       }else{
         if(!preg_match("/^[a-zA-Z_áéíóúñ\s]*$/",$apellido)){
           $errorSec["apellido"] = "Un nombre no debe contener numeros";
     
         }
       }
       if(empty($telefono)){
        $errorSec["telefono"] = "Ingrese el numero de contacto personal de este usuario";
       }else{
        if(!preg_match("/^(\+?56)?(\s?)(0?9)(\s?)[987654]\d{7}$/",$telefono)){
          $errorSec["telefono"] = "El formato del telefono es incorrecto";
     
         }else{
           if(strlen($telefono) < 12){
            $errorSec["telefono"] = "La cantidad de numeros digitados no es valido";

           }else{
            $respuesta3 = Administrador::validarTelefonoUsuario($telefono);
            $respuesta4 = Secretario::validarTelefonoPaciente($telefono);
            if(count($respuesta3) > 0 || count($respuesta4) > 0){
              $errorSec["telefono"] = "El telefono ya ha sido registrado";
        
            }
           }
         }
       }
       if(empty($correo)){
        $errorSec["correo"] = "Ingrese la direccion de correo del usuario";
       }else{
         if(!filter_var($correo ,FILTER_VALIDATE_EMAIL)){
           $errorSec["correo"] = "El formato del correo es incorrecto";
     
         }else{
          $respuesta5 = Administrador::validarEmailUsuario($correo);
          $respuesta6 = Secretario::validarEmailPaciente($correo);
          if(count($respuesta5) > 0 || count($respuesta6) > 0){
            $errorSec["correo"] = "El correo ya ha sido registrado";
      
          }
         }
       }
       if(empty($pass)){
        $errorSec["pass"] = "Ingrese una contraseña para la cuenta de este usuario";

       }
     
      if(empty($errorSec["rut"]) && empty($errorSec["nombre"]) && empty($errorSec["apellido"]) && empty($errorSec["telefono"]) && empty($errorSec["correo"]) && empty($errorSec["pass"])){
        $rut = "";
        $nombre ="";
         $apellido = "";
         $telefono ="";
          $correo ="";
           $pass ="";
      }
    }
  

  }
  





?>

<!doctype html>
<html lang="en">
  <head>
    <title>Secretarios</title>
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
        <a class="nav-link text-light mr-4" >Secretarios<span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="">Horario</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="chat.php">Chat <span id="notificacionChat" class="badge bg-success"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="pacientes.php">Pacientes</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-light mr-4 " href="medicamentos.php">Medicamentos </a>
      </li>
      <li class="nav-item  ">
        <a class="nav-link text-light mr-4 " href="cuenta.php?action=&idCuenta=<?php echo base64url_encode($_SESSION["id_medico"]."".$_SESSION["nombreMedico"]);?>">Cuenta </a>
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
                <h1 class="text-center" style="margin-top: 50px;">Secretarios</h1>
            </div>
        </div>
    </div>
     <div class="container">
        <div class="row">
            <div class="col-lg-5">
            
  <?php 
  
  ?>
        <div class="card">
          <div class="card-header bg-dark text-light">
            Registrar secretario(a)
          </div>
          <div class="card-body">
          <form method="POST" id="secretarioRegistroForm">

          <div class="form-group"><label for="rutLabel">RUT</label><input class="form-control" type="text" name="rutSecretario" id="rutUsuario" data-field="rutUser"  value="<?php echo $rut; ?>"><div id="valid-rut" class="text-danger"></div>  <div  class="valid-message text-danger"><?php echo $errorSec["rut"]; ?></div></div>
          <div class="form-group"><label for="nombreLabel">Nombre</label><input class="form-control" type="text" name="nombreSecretario" id="nombreUsuario" data-field="nombreUs" value="<?php echo $nombre; ?>"> <div class="valid-message text-danger"><?php echo $errorSec["nombre"]; ?></div></div>
          <div class="form-group"><label for="apellidoLabel">Apellido</label><input class="form-control" type="text" name="apellidoSecretario" id="apellidoUsuario" data-field="apeUs" value="<?php echo $apellido; ?>">  <div class="valid-message text-danger"><?php echo $errorSec["apellido"]; ?></div></div>
          <div class="form-group"><label for="telefonoLabel">Telefono</label><input class="form-control" type="tel" name="telefonoSecretario" id="telefonoUsuario" data-field="telUs" value="<?php echo $telefono; ?>"> <div id="valid-tel" class="text-danger"></div> <div class="valid-message text-danger"><?php echo $errorSec["telefono"]; ?></div></div>
          <div class="form-group"><label for="emailLabel">Correo</label><span></span><input class="form-control" type="email" name="emailSecretario" id="emailUsuario" data-field="emailUs" value="<?php echo $correo; ?>" ><div id="valid-email" class="text-danger"></div> <div  class="valid-message"><?php echo $errorSec["correo"]; ?></div></div>
          <div class="form-group" ><label for="passLabel">Contraseña</label><input class="form-control" type="password" name="passSecretario" id="passUsuario" data-field="passUs" value="<?php echo $pass; ?>"> <div  class="valid-message text-danger"><?php echo $errorSec["pass"]; ?></div></div>
          <button class="btn btn-primary"
                  type="submit" id="secretarioRegistro" name="secretarioRegistro">Guardar</button></div>

          </form>

          </div>
         
        </div>

               
        <div class="col-lg-7">
            <div class="num_rows">
		
        <div class="form-group "> 	<!--		Show Numbers Of Rows 		-->
             <select class  ="form-control " name="state" id="maxRows">
                 
                 
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
      
                <div  class="table-responsive" style="margin-top: 30px;">
                    <table id="usuarios" class="table ">
                        <thead class="thead-dark">
                            <tr>
                                <th>RUT</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Acción</th>

                            </tr>
                        </thead>
                        <tbody>
                        
                        <?php 
                     $registro = new Controlador();
                     $registro ->registrarUsuarioConctroller();
                        $borrado = new Controlador();
                        $borrado->borrarSecretarioController();
                        
                        
$vista = new Controlador();
$vista->listarSecretariosController();
 

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
            
                    <?php



?>

 

 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
     <script src="../../assets/js/validarRegistro.js"></script>
     <script src="../../assets/js/validarRegistro5.js"></script>

    <script src="../../assets/js/jquery.formValid.js"></script>

    <script src="../../assets/js/script3.js"></script>
    <script src="../../assets/js/demo2.js"></script>

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
