<?php
    require_once"Controlador/controlador.php";
    require_once"Modelo/medico.php";



?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="Vista/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
    <link rel="stylesheet" href="Vista/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="Vista/assets/css/Login-Form-Clean.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

</head>

<body id="page-top">
<nav class="navbar navbar-expand-lg bg-secondary navbar-light" >
<a class="navbar-brand text-uppercase text-light m-2 p-2" href="#">Medical Manage</a>

  </div>
</nav>


  
    <div class="login-clean">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form method="post" style="margin-top: 0px;height: 500px;margin-bottom: 50px;padding-top: -100px;" id="loginForm">
                        <h2 class="sr-only">Login Form</h2>
                        <div class="illustration"><i class="fas fa-laptop-medical fa-xs shadow-lg " style="font-size:100px;color: rgb(29,31,75);"></i></div>
                        <?php 
  
                      
  $ingreso = new Controlador();
$ingreso ->loginController();


?>
                        <div class="form-group"><input class="form-control" type="email" name="correoIngreso"  placeholder="Correo" data-field="correoLogin"> <div class="valid-message"></div></div>
                        <div class="form-group"><input class="form-control" type="password" name="passIngreso"  placeholder="Contraseña" data-field="passLogin"><div class="valid-message"></div></div>
                        <div class="form-group"><button class="btn btn-primary btn-block" id="entrarLog" name="entrarLog"  type="submit" style="background-color: rgb(0,0,255);">ENTRAR</button></div><a href="#" class="forgot">Forgot your email or password?</a>
                        </form>
                </div>
            </div>
        </div>
    </div>



   
 
       <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
       <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   <script src="Vista/assets/js/jquery.formValid.js"></script>

<script src="Vista/assets/js/demo1.js"></script>
</body>

</html>