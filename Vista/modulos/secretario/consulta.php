<?php
 
 require_once"../../../Controlador/controlador.php";
 require_once"../../../Modelo/medico.php";
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
    <link rel="stylesheet" href="../../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/Features-Boxed.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="../../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.css" />
    <link rel="stylesheet" href="../../assets/css/bootstrap-multiselect.css" type="text/css"/>
    <script src="../../assets/js/ckeditor/ckeditor.js"></script>
  


  </head>
  
  <body class="page-top">

  <nav class="navbar navbar-light navbar-expand-lg bg-secondary text-nowrap text-uppercase" id="mainNav" style="height: 95px;">
        <div class="container"><a class="navbar-brand text-center js-scroll-trigger" href="#page-top" data-bs-hover-animate="pulse" style="margin: 13px 13px;">Medical manage</a><button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded"
                data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto"></ul>
                <ul class="nav navbar-nav"></ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">inicio</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">usuarios</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">medicamentos</a></li>
                </ul> <a href="../logout.php"><button class="btn btn-primary" type="button" style="background-color: #841111;" >Cerrar Sesión</button></a></div>
        </div>
    </nav>

    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center" style="margin-top: 50px;">Consulta: </h1>
         
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
      <div class="table-responsive" style="margin-top: 30px;">
        <table class="table table-light">
            <thead class="thead-light">
            <tr>
                 <th>Fecha</th>
                <th>Enfermedad Actual</th>
                 <th>Diagnostico</th>
             </tr>
            </thead>
            <tbody>
            <?php

$consultaL = new Controlador();
$consultaL->verConsultasPacienteController();

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
  </div>
  
  </div>
  <div class="tab-pane fade" id="signos" role="tabpanel" aria-labelledby="profile-tab">
  
  <h3>Signos</h3>
 <div class="container">
     <div class="row">
   
     <div class="col">
            <div class="table-responsive" style="margin-top: 30px;">
                <table class="table table-light">
                    <thead class="thead-light">
                    <tr>
                        <th>Presion arterial</th>
                        <th>Pulso</th>
                        <th>Peso</th>
                        <th>Altura</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php

        $signosV = new Controlador();
        $signosV->listarSignosController();

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
     
     </div>
 </div>
  </div>
  <div class="tab-pane fade" id="examenes" role="tabpanel" aria-labelledby="profile-tab">
  
  <h3>Examenes</h3>

  </div>
  <div class="tab-pane fade" id="recetas" role="tabpanel" aria-labelledby="contact-tab">
  
  <h3>Recetas</h3>
 
    <div class="container">
        <div class="row">
            
            <div class="col">
            <div class="table-responsive" style="margin-top: 30px;">
        <table class="table table-light">
            <thead class="thead-light">
            <tr>
                 <th>Fecha de emisión</th>
                <th>Medicamentos</th>
                 <th>Indicaciones</th>
             </tr>
            </thead>
            <tbody>
            
            <?php 
         $recetaV = new Controlador();
         $recetaV->verRecetasPacienteController();
       
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example-getting-started').multiselect();
        });
    </script>
 
 <script>
    $('#myTab a').click(function(e) {
  $(this).tab('show');
});

// store the currently selected tab in the hash value
$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
  var id = $(e.target).attr("href").substr(1);
  window.location.hash = id;
});

// on load of the page: switch to the currently selected tab
var hash = window.location.hash;
$('#myTab  a[href="' + hash + '"]').tab('show');
    </script>
  </body>
</html>