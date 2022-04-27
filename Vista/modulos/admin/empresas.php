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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

   
   
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
      <li class="nav-item  ">
        <a class="nav-link text-light mr-4 " href="grupoAdmin.php">Grupo admin </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="chat.php">Chat<span id="notificacionChat" class="badge bg-success"></span> </a>
      </li>
      <li class="nav-item  ">
        <a class="nav-link text-light mr-4 " href="cuenta.php?action=&idCuenta=<?php echo base64url_encode($_SESSION["id_admin"]."".$_SESSION["nombreAdmin"]); ?>">Cuenta </a>
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
                <h1 class="text-center" style="margin-top: 50px;">Empresas</h1>
            </div>
        </div>
    </div>

   <div class="container">
   <div class="row">
  <div class="col-lg-5 ">
  <div class="card">
      <div class="card-header bg-dark text-light">
          Registrar Empresa
      </div>
      <div class="card-body">
      <form method="POST" id="empresaRegistroForm">
        <div class="form-group"><label for="">Nombre Empresa</label><input class="form-control" type="text" name="nombreEmpresa" id="nombreEmpresa" data-field="nombreEmpresa"  ><div id="valid-nom " class="text-danger"></div>  <div  class="valid-message text-danger"></div></div>
        <div class="form-group"><label for="">Dirección</label><input class="form-control" type="text" name="direccionEmpresa" id="direccionEmpresa" data-field="direccionEmpresa" > <div class="valid-message text-danger"></div></div>
        <div class="form-group">
            <div class="row">
            <div class="col">
            <label for="my-input">Region</label>
            <select class="form-control" id="regiones" name="region" data-field="regionEmpresa"></select>
            <div class="valid-message text-danger"></div>
            </div>
            <div class="col">
            <label for="my-input">Comuna</label>
           <select class="form-control" id="comunas" name="comuna" data-field="comunaEmpresa"></select>
           <div class="valid-message text-danger"></div>
    
            </div>
            </div>
         
    
        </div>

        <button class="btn btn-primary"
                type="submit" id="empresaRegistro" style="margin-top: 30px;" name="empresaRegistro">Guardar</button></div>

        </form>
      </div>
      
  </div>
  
  <div class="col-lg-7">
  <div  class="table-responsive" style="margin-top: 30px;">
                    <table id="empresas" class="table ">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Region</th>
                                <th>Comuna</th>
                                <th>Detalles</th>

                            </tr>
                        </thead>
                        <tbody>
                        
                        <?php 
                 
                 $registro = new Controlador();
                 $registro ->registrarEmpresaController();
                 $vista = new Controlador();
                 $vista ->listarEmpresasController();
                 

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

    <script src="../../assets/js/jquery.formValid.js"></script>


    <script src="../../assets/js/validarRegistro4.js"></script>

  <script src="../../assets/js/demo2.js"></script>
  <script src="../../assets/js/regionesycomunas.js"></script>

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
