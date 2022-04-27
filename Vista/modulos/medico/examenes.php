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
   if($errorMed["nombre"] == "" && $errorMed["miligramos"] == "" && $errorMed["descripcion"] == ""){
    $registro = new Controlador();
    $registro ->registrarMedicamentoController();
    header("location:medicamentos.php");
   }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Examenes</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../..//assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
    <link rel="stylesheet" href="../../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/Features-Boxed.css">
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
        <a class="nav-link text-light mr-4" href="chat.php">Chat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light mr-4" href="pacientes.php">Pacientes</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link text-light mr-4 " href="#">Medicamentos <span class="sr-only"></span></a>
      </li>
      <li class="nav-item  ">
        <a class="nav-link text-light mr-4 " href="cuenta.php?action=&idCuenta=<?php echo $_SESSION["id_medico"];?>">Cuenta </a>
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
                <h1 class="text-center" style="margin-top: 50px;">Examenes</h1>
            </div>
        </div>
    </div>
     <div class="container">
        <div class="row ">
            <div class="col">
            <form method="POST" id="" >
                    <div class="form-group"><label>Nombre examen</label><input class="form-control" type="text" name="exaNombre" id="exaNombre"  data-field="" value=""><div class="valid-message"> </div></div>
                    <div class="form-group"><label>Descripción</label><input class="form-control" type="text" name="exaDes" id="exaDes" data-field="" value=""><div class="valid-message"></div></div>
                    <button class="btn btn-primary"
                            type="submit" id="exaRegistro" style="margin-top: 30px;" name="exaRegistro">Guardar</button></div>
                </form>
                
              
            </div>
            <div class="col">
            <div  class="table-responsive" style="margin-top: 30px;">
                <table class="table" id="">
                        <thead class="thead-dark">
                            <tr>
                                <th>Examen</th>
                                <th>Descripción</th>
                                <th>Acción</th>

                            </tr>
                        </thead>
                        <tbody id="">
            
                        <?php 


                        $registro = new Controlador();
                        $registro->registrarExamenController();
                       $vista = new Controlador();
                       $vista->listarExamenesController();
?>

                        </tbody>
                    </table>
                </div>
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
    <script src="../../assets/js/script.js"></script>
    
    

  </body>
</html>


