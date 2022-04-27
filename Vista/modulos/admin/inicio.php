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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
</head>

<body id="page-top">
   
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <a class="navbar-brand text-uppercase text-light m-2 p-2 " href="#">Medical Manage</a>
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
                <h2 class="text-center">Bienvenido: <?php echo $_SESSION["nombreAdmin"]." ".$_SESSION["apellidoAdmin"] ?> &nbsp;</h2>
                <p class="text-center"></p>
            </div>
            <div class="row justify-content-center features">
            <a href="empresas.php"> <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fas fa-hospital shadow-lg icon"></i>
                        <h3 class="name">Empresas</h3>
 <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p>
                    </div>
                    </a>   </div>
                    <a href="grupoadmin.php">  <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fas fa-server shadow-lg icon"></i>
                        <h3 class="name">Grupo administativo</h3>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p><a href="#" class="learn-more">Learn more »</a></div>
                </div></a>
                <a href="chat.php">  <div class="col-sm-6 col-md-5 col-lg-4 item">
                    <div class="box"><i class="fa fa-wechat shadow-lg icon"></i>
                        <h3 class="name">Chat <span id="notificacion"></span> </h3>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p><a href="#" class="learn-more">Learn more »</a></div>
                </div></a>
                <a href="cuenta.php?action=&idCuenta=<?php echo base64url_encode($_SESSION["id_admin"]."".$_SESSION["nombreAdmin"]);?>"><div class="col-sm-6 col-md-5 col-lg-4 item">
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
    if(data > 0){
        toastr.info("Tienes nuevos mensajes: "+data+" "+" <a href='chat.php'>ir</a>","Chat");
    }
      
   }
  })

 }

});
</script>
  



</body>

</html>