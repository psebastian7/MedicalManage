<?php 
session_start();
if (!$_SESSION["medico"]   &&  !$_SESSION["id_medico"])  {
   header("location:../../../index.php");
   exit();
}
	?>
<?php
 
 require_once"../../../Controlador/controlador.php";
 require_once"../../../Modelo/medico.php";
?>
<?php
 
 $motivo = $diagnostico = "";
 $errorConsulta = array("motivo" => "","diagnostico"=>"");
 if(isset($_POST["consultaRegistro"])){
 
   $motivo = $_POST["motivoConsulta"];
   $diagnostico = $_POST["diagnostico"];
   if(empty($motivo)){
    $errorConsulta["motivo"] = "Ingrese el motivo de la consulta";
    }
    if(empty($diagnostico)){
        $errorConsulta["diagnostico"] = "Ingrese el diagnostico del paciente";
    }
    if($errorConsulta["motivo"] == "" && $errorConsulta["diagnostico"] == ""){
        $consultaR = new Controlador();
        $consultaR->crearConsultaController();
        $motivo = "";
        $diagnostico = "";
    }

 }

    $medicamentos = $indicaciones = "";
    $errorReceta = array("medicamentos" => "","indicaciones"=>"");
    if(isset($_POST["recetaRegistro"])){
        if(!isset($_POST["medReceta"]) || isset($_POST["medReceta"])){

        $indicaciones = $_POST["indicaciones"];
        
        if(empty($indicaciones)){
            $errorReceta["indicaciones"] = "Ingrese las indicaciones de la receta";
        }
        if($errorReceta["medicamentos"] == "" && $errorReceta["indicaciones"] == ""){
            $recetaR = new Controlador();
            $recetaR->recetaRegistroController();
          
            $medicamentos = "";
            $indicaciones = "";
        }
    }


    }


 ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Pacientes</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.css" />
    <link rel="stylesheet" href="../../assets/css/bootstrap-multiselect.css" type="text/css"/>
    <script src="../../assets/js/ckeditor/ckeditor.js"></script>
   


    
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
        <a class="nav-link text-light mr-4" href="pacientes.php">Pacientes</a>
      </li>

    </ul>
    <span class="navbar-text">
      <a class="btn btn-danger text-light" href="../logout.php">Cerrar Sesión</a>
    </span>
  </div>
</nav>

    </div>
    <div class="container">
        <div class="row">
           
        <h2 class="text-left" >  <a href="pacientes.php">  <i class="fa fa-arrow-left  mt-3"   aria-hidden="true">Volver atras</i></a></h2>

            <div class="col-lg-6">

                <h1 class="text-center" style="margin-top: 50px;"> Ficha: </h1>
         
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#paciente" role="tab" aria-controls="home" aria-selected="true">Datos Paciente</a>
    </li>
  <li class="nav-item">
    <a class="nav-link " id="home-tab" data-toggle="tab" href="#consulta" role="tab" aria-controls="home" aria-selected="true">Consulta</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#signos" role="tab" aria-controls="profile" aria-selected="false">Signos Vitales</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#examenes" role="tab" aria-controls="profile" aria-selected="false">Examenes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#recetas" role="tab" aria-controls="contact" aria-selected="false">Receta</a>
  </li>
</ul>

    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="paciente" role="tabpanel" aria-labelledby="home-tab">

    <?php 
                        $paciente = new Controlador();
                        $paciente->verPacienteController();
          



?>

    </div>

  <div class="tab-pane fade  " id="consulta" role="tabpanel" aria-labelledby="home-tab">
  
  <h3>Consulta</h3>
  <div class="container">
      <div class="row">
     <div class="col-lg-5">
     
     <div class="card">
         <div class="card-header bg-dark text-light">
             Registrar consulta
         </div>
         <div class="card-body">
                                      <form method="POST" id="consultaForm">
                                        <div class='form-group'>
                                            <label >Motivo consulta</label>
                                            <input type='text' class='form-control' id='motivoConsulta' name="motivoConsulta"  data-field="motivoConsulta" value="<?php echo $motivo;?>"> 
                                            <div class="valid-message text-danger"><?php echo $errorConsulta["motivo"]; ?></div>
                                        </div>
                                        <div class='form-group'>
                                            <label >Diagnostico</label>
                                            <input type='text' class='form-control' id='formGroupExampleInput' name="diagnostico" data-field="diagnostico" value="<?php echo $diagnostico;?>" > 
                                            <div class="valid-message text-danger"><?php echo $errorConsulta["diagnostico"]; ?></div>
                                        </div>
                                        <div class='form-group'>
                                            <input type='submit' class='form-control btn btn-primary' id='consultaRegistro' name="consultaRegistro" value='Guardar' > 
                                        </div>
                                        <?php 
                                     
                                        ?>
                                        </form>
         </div>
         
     </div>

     
     </div>

     
     <div class="col-lg-7">
     <div class="table-responsive" style="margin-top: 30px;">
        <table class="table table-light">
            <thead class="thead-light">
            <tr>
                 <th>Fecha</th>
                 <th>Acción</th>

             </tr>
            </thead>
            <tbody>
            <?php

$consultaB = new Controlador();
$consultaB->borrarConsultaController();
$consultaL = new Controlador();
$consultaL->verConsultasPacienteController();

          ?>
            </tbody>
         
        </table>

        </div>
     </div>


      </div>
  </div>
  
  </div>
  <div class="tab-pane fade" id="signos" role="tabpanel" aria-labelledby="profile-tab">
  
  <h3>Signos</h3>
 <div class="container">
     <div class="row">
     <div class="col-lg-5">
      
      <div class="card">
          <div class="card-header bg-dark text-light">
              Registrar signos vitales 
          </div>
          <div class="card-body">
          <form method="post" id="signosForm" >
       <div class="form-group">
           <label for="my-input">Presion arterial</label>
           <input id="preArterial" class="form-control" type="number" name="preArterial" min="20" max="120" data-field="preArterial">
           <div class="valid-message text-danger"></div>
       </div>  
       <div class="form-group">
           <label for="my-input">Pulso</label>
           <input id="" class="form-control" type="number" name="pulso" min="20" max="120" data-field="pulso">
           <div class="valid-message text-danger"></div>
       </div>  
       <div class="form-group">
           <label for="my-input">Peso</label>
           <input id="" class="form-control" type="number" name="peso" min="0"  data-field="peso">
           <div class="valid-message text-danger"></div>
       </div>  
       <div class="form-group">
           <label for="my-input">Altura</label>
           <input id="altura" class="form-control" type="number" name="altura" min="0"  data-field="altura">
           <div class="valid-message text-danger"></div>
       </div> 
       <div class="form-group">
           <input id="signosRegistro" class="form-control btn btn-primary" type="submit" name="signosRegistro"  value="Guardar">
       </div>
       <?php

$signosR = new Controlador();
$signosR->signosRegistroController();

        ?>
     </form>   
          </div>
         
      </div>

   
     </div>
     <div class="col-lg-7">
            <div class="table-responsive" style="margin-top: 30px;">
                <table class="table table-light">
                    <thead class="thead-light">
                    <tr>
                    <th>Fecha</th>
                  <th>Acción</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
        $signosB = new Controlador();
        $signosB->borrarSignosController();
        $signosV = new Controlador();
        $signosV->listarSignosController();

                ?>
                    </tbody>
                   
                </table>

                </div>
     </div>
     
     </div>
 </div>
  </div>
  <div class="tab-pane fade" id="examenes" role="tabpanel" aria-labelledby="profile-tab">
  
  <h3>Solicitud de examenes</h3>
  <div class="container">
      <div class="row">
          <div class="col-lg-6 col-sm">
          <form method="post" id="">
            <div class="form-group">
                <label for="">Tipos de examenes</label>
                <select id="" name="exaPaciente[]" multiple="multiple" >
                    <?php   
                    $medReceta = new Controlador();
                    $medReceta->listarExamenesConsultaController();
                    ?>
                </select>

            </div>
  
       <div class="form-group">
           <input id="registroSolicitudExa" class="form-control btn btn-primary" type="submit" name="registroSolicitudExa"  value="Guardar">
       </div>
       <?php 
        
       ?>
     </form>   
            </div>
            <div class="col-lg-6 col-sm">
            <div class="table-responsive" style="margin-top: 30px;">
        <table class="table table-light">
            <thead class="thead-light">
            <tr>
                 <th>Fecha de emisión</th>
                 <th>Acción</th>
             </tr>
            </thead>
            <tbody>
            
            <?php 
    
       ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                </tr>
            </tfoot>
        </table>

        </div>
          </div>
          <div class="col">
          
          </div>
      </div>
  </div>
  </div>
  <div class="tab-pane fade" id="recetas" role="tabpanel" aria-labelledby="contact-tab">
  
  <h3>Recetas</h3>
 
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        Registrar receta médica
                    </div>
                    <div class="card-body">
                    <form method="post" id="recetaForm">
            <div class="form-group">
                <label for="">Medicamentos</label>
                <select id="example-getting-started" name="medReceta[]" multiple="multiple" >
                    <?php   
                    $medReceta = new Controlador();
                    $medReceta->listarMedicamentosRecetaController();
                    ?>
                </select>

            </div>
            <div class="form-group">
                <label for="">Indicaciones</label>
                <textarea id="indicaciones" class="form-control ckeditor" name="indicaciones" rows="2" data-field="indicaciones" value="<?php echo $indicaciones;?>"></textarea>
                <div class="valid-message text-danger"><?php echo $errorReceta["indicaciones"]; ?></div>

            </div>
       <div class="form-group">
           <input id="recetaRegistro" class="form-control btn btn-primary" type="submit" name="recetaRegistro"  value="Guardar">
       </div>
       <?php 
      
       ?>
     </form>   
                            
                    </div>
                    
                </div>

            
            </div>
            <div class="col">
            <div class="table-responsive" style="margin-top: 30px;">
        <table class="table table-light">
            <thead class="thead-light">
            <tr>
                 <th>Fecha de emisión</th>
                 <th>Acción</th>
             </tr>
            </thead>
            <tbody>
            
            <?php 
                    
                     $recetaB = new Controlador();
                     $recetaB->borrarRecetaController();
                    $recetaV = new Controlador();
                    $recetaV->verRecetasPacienteController();
       
       ?>
            </tbody>
         
        </table>

        </div>
            
            </div>
        </div>
    </div>
  </div>
</div> 
       

  
  
  
  



   
   

	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="../../assets/js/bs-animation.js"></script>
        <script type="text/javascript" src="../../assets/js/bootstrap-multiselect.js"></script>
        <script src="../../assets/js/jquery.formValid.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#example-getting-started').multiselect();
        });

        $(function() {
    $('a[data-toggle="tab"]').on('click', function(e) {
        window.localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = window.localStorage.getItem('activeTab');
    if (activeTab) {
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});
    </script>

<script src="../../assets/js/demo1.js"></script> 

  </body>
</html>