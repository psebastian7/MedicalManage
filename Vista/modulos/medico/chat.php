<?php

 require_once"../../../Controlador/controlador.php";
 require_once"../../../Modelo/medico.php";
 
?>
	<?php 
session_start();
if (!$_SESSION["medico"] && !$_SESSION["id_medico"]) {
   header("location:../../../index.php");
   exit();
}
	?>
<!DOCTYPE html>
<html>

<head>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
 ></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Chat</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    
 


    
  

</head>

<body id="page-top">
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
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="secretarios.php">Secretarios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="">Horario</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link text-light mr-4" href="">Chat <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="pacientes.php">Pacientes</a>
      </li>
      <li class="nav-item">
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
    <div  class="table-responsive" style="margin-top: 30px;">
         <h2>Administradores</h2>
                    <table id="usuarios" class="table ">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Acción</th>

                            </tr>
                        </thead>
                        <tbody id="admins">
                        
      
                        </tbody>
                    </table>
</div>
     </div>
    </div>
    <div class="row">

         <div class="col">

         <div  class="table-responsive" >
         <h2>Equipo medico</h2>
                    <table id="usuarios" class="table ">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Acción</th>

                            </tr>
                        </thead>
                        <tbody id="equipo">
                        
      
                        </tbody>
                    </table>
</div>
         </div>

        </div>
    </div>

   

    <script src="../../assets/js/jquery.formValid.js"></script>

<script src="../../assets/js/demo2.js"></script>
<script src="../../assets/js/script.js"></script>
<script src="../../assets/js/chatMedico.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    
   

</body>

</html>