<?php 

require_once"../../../Modelo/medico.php";
require_once"../../../Modelo/secretario.php";

require_once"../../../Controlador/controlador.php";

session_start();
if (!$_SESSION["medico"] && !$_SESSION["id_medico"] && !$_SESSION["empresa"]) {
   header("location:../../../index.php");
   exit();
}




	?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Inicio</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
    <link rel="stylesheet" href="../../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="../../assets/css/Features-Boxed.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
</head>

<body id="page-top">
   
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <a class="navbar-brand text-uppercase text-light m-2 p-2 " href="#">Medical Manage </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      
    
    </ul>
    <span class="navbar-text">
      <a class="btn btn-danger text-light" href="../logout.php">Cerrar Sesión</a>
    </span>
  </div>
</nav>
    <div class="features-boxed">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Bienvenido(a): <?php echo $_SESSION["nombreMedico"]." ".$_SESSION["apellidoMedico"];?> &nbsp;</h2>
                <p class="text-center"></p>
            </div>
            <div class="row justify-content-center features">
            <a href="secretarios.php"> <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-users shadow-lg icon"></i>
                        <h3 class="name">Secretarios</h3>
 <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p>
                    </div>
                    </a>   </div>
                <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="far fa-calendar-plus shadow-lg icon"></i>
                        <h3 class="name">Mi horario</h3>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p><a href="#" class="learn-more">Learn more »</a></div>
                </div>
                <a href="chat.php">  <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-wechat shadow-lg icon"></i>
                        <h3 class="name">Chat<span id="notificacion"></span></h3>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p><a href="#" class="learn-more">Learn more »</a></div>
                </div></a>
                <a href="pacientes.php"> <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fas fa-file-medical-alt shadow-lg icon"></i>
                        <h3 class="name">Pacientes</h3>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p><a href="#" class="learn-more">Learn more »</a></div>
                </div></a>
                <a href="medicamentos.php"><div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fas fa-briefcase-medical	 shadow-lg icon"></i>
                        <h3 class="name">Medicamentos</h3>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p><a href="#" class="learn-more">Learn more »</a></div>
                </div></a>
                <a href="examenes.php"><div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="icon ion-android-share-alt shadow-lg icon"></i>
                        <h3 class="name">Examenes medicos</h3>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p><a href="#" class="learn-more">Learn more »</a></div>
                </div></a>
                <a href="cuenta.php?action=&idCuenta=<?php echo base64url_encode($_SESSION["id_medico"]."".$_SESSION["nombreMedico"]);?>"><div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fas fa-user-cog icon"></i>
                        <h3 class="name">Cuenta</h3>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p><a href="#" class="learn-more">Learn more »</a></div>
                </div></a>
            </div>
        </div>
    </div>
  
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="../../assets/js/bs-animation.js"></script>
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
    $('#notificacion').html(data);
    
      
   }
  })

 }

});
</script>
</body>

</html>