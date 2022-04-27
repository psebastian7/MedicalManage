<?php 
session_start();
if (!$_SESSION["medico"] && !$_SESSION["id_medico"]) {
   header("location:../../../index.php");
   exit();
}
	?>
<?php
 
 require_once"../../../Controlador/controlador.php";

 require_once"../../../Modelo/medico.php";
?>
<?php 
$nombre = $miligramos = $descripcion = "";
$errorMed = array("nombre" => "","miligramos"=>"","descripcion"=>"");
if(isset($_POST["medRegistro"])){
  if(isset($_POST["medNombre"]) && isset($_POST["medMil"]) && isset($_POST["medDes"])){

  $nombre = $_POST["medNombre"];
  $miligramos = $_POST["medMil"];
  $descripcion = $_POST["medDes"];

  if(empty($nombre)){
   $errorMed["nombre"] = "Ingrese un nombre para este medicamento";
  }else{
    if(!preg_match("/^[a-zA-Z_áéíóúñ\s]*$/",$nombre)){
      $errorMed["nombre"] = "Un nombre no debe contener numeros";

    }
  }

  if(empty($miligramos)){
    $errorMed["miligramos"] = "Ingrese la cantidad de miligramos ";

   }else{
     if(!preg_match("/^[1-9][0-9]*$/",$miligramos)){
      $errorMed["miligramos"] = "Ingrese la cantidad en numeros";
     }else{
       $respuesta = Medico::validarMedicamentoRepetido($nombre,$miligramos);
       if(count($respuesta) > 0){
        $errorMed["miligramos"] = "Un medicamento que ya esta registrado, no puede tener los mismos miligramos";

       }
     }
   }

   if(empty($descripcion)){
    $errorMed["descripcion"] = "Ingrese una descripcion para este medicamento";
   }
   if(empty($errorMed["nombre"])  && empty($errorMed["miligramos"]) && empty($errorMed["descripcion"])){
    $nombre = "";
    $miligramos = "";
    $descripcion = "";


  }
  }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Medicamentos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../..//assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
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
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="secretarios.php">Secretarios</a>
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
      <li class="nav-item active">
        <a class="nav-link text-light mr-4 " href="#">Medicamentos <span class="sr-only"></span></a>
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
                <h1 class="text-center" style="margin-top: 50px;">Medicamentos</h1>
            </div>
        </div>
    </div>
     <div class="container">
        <div class="row">
            <div class="col-lg-5">
              <div class="card">
                <div class="card-header bg-dark text-light">
                  Registrar medicamento
                </div>
                <div class="card-body">
                <form method="POST" id="medForm" onsubmit="">
                    <div class="form-group"><label>Nombre</label><input class="form-control" type="text" name="medNombre" id="medNombre"  data-field="medNombre" value="<?php echo $nombre;?>"><div class="valid-message text-danger"><?php echo $errorMed["nombre"]; ?> </div></div>
                    <div class="form-group"><label>Miligramos</label><input class="form-control" type="number" name="medMil" id="medMil" data-field="medMil" value="<?php echo $miligramos; ?>"><div id="valid-med" class="text-danger"></div><div class="valid-message text-danger"><?php echo $errorMed["miligramos"]; ?></div></div>
                    <div class="form-group"><label>Descripción</label><input class="form-control" type="text" name="medDes" id="medDes" data-field="medDes" value="<?php echo $descripcion;?>"><div class="valid-message text-danger"><?php echo $errorMed["descripcion"]; ?></div></div>
                    <button class="btn btn-primary"
                            type="submit" id="medRegistro" style="margin-top: 30px;" name="medRegistro">Guardar</button></div>
                </form>
                </div>
             
              </div>
              <div class="col-lg-7">


<div class="num_rows">

<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
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
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
</div>

    <div class="table-responsive" style="margin-top: 30px;">
        <table class="table" id="medList">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Miligramos</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="listaMed">

            <?php 

$registro = new Controlador();
$registro ->registrarMedicamentoController();

            $borrar = new Controlador();
           $borrar->borrarMedicamentoController();
           $editar = new Controlador();
           $editar->actualizarMedicamentosController();

           $vista = new Controlador();
           $vista->listarMedicamentosController();
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
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../../assets/js/jquery.formValid.js"></script>

    <script src="../../assets/js/demo1.js"></script>
    <script src="../../assets/js/demo3.js"></script>

    <script src="../../assets/js/script.js"></script>
    <script src="../../assets/js/validarRegistro3.js"></script>

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


