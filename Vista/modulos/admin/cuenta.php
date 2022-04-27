<?php 
session_start();
if (  !$_SESSION["admin"]   && !$_SESSION["id_admin"]   )  {
    header("location:../../../index.php");
   exit();
}

	?>
<?php
 

 require_once(__DIR__.'/../../../Modelo/medico.php');
 require_once(__DIR__.'/../../../Modelo/administrador.php');
 require_once(__DIR__.'/../../../Modelo/secretario.php');

 require_once(__DIR__.'/../../../Controlador/controlador.php');


 $telefono = $email ="";
 $errores = array("tel"=>"","correo"=>"");
if(isset($_POST["modificarCuenta"])){
 
  if(isset($_POST["telefonoUsuarioC"]) && isset($_POST["emailUsuarioC"])){
    $telefono = $_POST["telefonoUsuarioC"];
    $email = $_POST["emailUsuarioC"];

    if(empty($telefono)){
      $errores["tel"] = "Ingrese el numero de contacto personal de este usuario";
     }else{
      if(!preg_match("/^(\+?56)?(\s?)(0?9)(\s?)[987654]\d{7}$/",$telefono)){
        $errores["tel"] = "El formato del telefono es incorrecto";
   
       }else{
         if(strlen($telefono) < 12){
          $errores["tel"] = "La cantidad de numeros digitados no es valido";

         }else{
          $respuesta3 = Administrador::validarTelefonoUsuario($telefono);
          $respuesta4 = Secretario::validarTelefonoPaciente($telefono);
          if(count($respuesta3) > 1 || count($respuesta4) > 1){
            $errores["tel"] = "El telefono ya ha sido registrado";
      
          }
         }
       }
     }
     if(empty($correo)){
      $errores["correo"] = "Ingrese la direccion de correo del usuario";
     }else{
       if(!filter_var($correo ,FILTER_VALIDATE_EMAIL)){
         $errores["correo"] = "El formato del correo es incorrecto";
   
       }else{
        $respuesta5 = Administrador::validarEmailUsuario($correo);
        $respuesta6 = Secretario::validarEmailPaciente($correo);
        if(count($respuesta5) > 1 || count($respuesta6) > 1){
          $errores["correo"] = "El correo ya ha sido registrado";
    
        }
       }
     }

     
    
  }
  






}


?>

<!doctype html>
<html lang="en">
  <head>
    <title>Cuenta</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

  </head>
  <body >
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
        <a class="nav-link text-light mr-4" href="empresas.php">Empresas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="grupoAdmin.php">Grupo admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="chat.php">Chat<span id="notificacionChat" class="badge bg-success"></span> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light mr-4" >Cuenta<span class="sr-only"></span></a>
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
                <h1 class="text-center" style="margin-top: 50px;">Cuenta</h1>
            </div>
        </div>
    </div>

    <div class="container ">
        <div class="row justify-content-center">
        <div class="col-6">


        <?php
           
 
            $editar = new Controlador();
            $editar->editarCuentaUsuarioController();
        $cuenta = new Controlador();
        $cuenta->cuentaUsuarioController();
   
        ?>
        
    
        </div>

        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


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