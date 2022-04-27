<?php
 
 require_once"../../../Controlador/controladorCitas.php";
 require_once"../../../Modelo/paciente.php";
 require_once"../../../Modelo/cita.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
         <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

        <script src="../../assets/js/jquery.min.js"></script>
        
        <script src="../../assets/js/moment.min.js"></script>
   
      
        <link rel="stylesheet" href="../../assets/css/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
   
        <script src="../../assets/js/fullcalendar.min.js"></script>
        <script src="js/es.js"></script>
        <script src="../../assets/js/es.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <title></title>
    </head>
    <body>
    <nav class="navbar navbar-light navbar-expand-lg bg-secondary text-nowrap text-uppercase" id="mainNav" style="height: 95px;">
        <div class="container"><a class="navbar-brand text-center js-scroll-trigger" href="#page-top" data-bs-hover-animate="pulse" style="margin: 13px 13px;">Medical manage</a><button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded"
                data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto"></ul>
                <ul class="nav navbar-nav"></ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">inicio</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#"></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#"></a></li>
                </ul> <a href="../logout.php"><button class="btn btn-primary" type="button" style="background-color: #841111;" >Cerrar Sesión</button></a></div>
        </div>
    </nav>      
        <section>
              <div class="container">
                <div class="row">
                    <div class="col"></div>
                    <div class="col-7"><div class="CalendarioWeb"></div></div>
                    <div class="col"></div>
                </div>
                
            </div>
            
              <?php
                       $vista = new controladorCitas();
                       $vista->listarCitasController();
                  
                       ?>
        
          
          
             <script>
                $(document).ready(function(){
                $('.CalendarioWeb').fullCalendar({
                    header:{
                      left:'today,prev,next ',
                      center:' title  ',
                      right:' month,basicWeek,basicDay, agendaWeek,agendaDay'
                    },
                    dayClick:function(date,jsEvent,view){
        $('#txtFecha').val(date.format());                
        $("#modalCrud").modal();
                    },
            
                     events:[{title:'Juan',
                     start: '2019-07-01'}
                     
             

],    
                   
                 eventClick:function(calEvent,jsEvent,view){
                  
                  
                     $('#horaDeAtencion').modal();
                     $('#paciente').html(calEvent.idPaciente);
                     FechaHora= calEvent.start._i.split(" ");
                     $('#txtFecha2').val(FechaHora[0]);
                     $('#txtHora2').val(FechaHora[1]);
                     
                     
    var idjs =(calEvent.idPaciente);
   
   
    }
                });
                
            });
                                </script>
                                
                                
                                
                                
                                <div class="modal fade" id="horaDeAtencion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloHora">Hora de atención</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
              <p>ID Hora: <input type="text" id="idHora" readonly=""></input></p>
      </div> 
      <div class="modal-body">
        <p>Estado hora: <label id="estadoHora"></label></p>
      </div>
              <div class="modal-body">
             <p>ID paciente: <label id="paciente"></label></p>
      </div> 
       
            <div class="modal-body">
         
                Fecha: <input type="date" id="txtFecha2"></input></p>   
          Hora:<input type="time" id="txtHora2" name="txtHora" required=""><br/>
       
      </div>
      
   
      <div class="modal-footer">
           <button type="button" id="btnModificar" class="btn btn-success" data-dismiss="modal">Modificar</button>
        <button type="button" id="btnEliminar" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
       
      </div>
    </div>
  </div>
</div>
        
         
        
         
            <div class="modal fade" id="modalCrud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloHora">Hora de atención</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="estadoHora"></div>
      </div>
           <div class="modal-body">
         
          Fecha:<input type="date" id="txtFecha" name="txtFecha" required=""><br/>
          Hora:<input type="time" id="txtHora" name="txtHora" required=""><br/>
          Paciente:<select id="idPaciente">
            
              
              <?php
              $vista = new controladorCitas();
$vista->listarUsuariosControllerCitas();
              
              ?>
          </select><br/>
       
      </div>
      
      <div class="modal-footer">
           <button type="button" id="btnAgregar" class="btn btn-success" data-dismiss="modal">Agregar</button>

       
      </div>
    </div>
  </div>
</div>
        </section>
        
        <script>
        
          $('#btnAgregar').click(function(){
        
           RecolectarDatosGUI();
           //----
         EnviarInformacion('agregar',nuevaHora);
             
          })  ;
          
        
        
        
        function RecolectarDatosGUI(){
             nuevaHora={
               idPaciente:$('#idPaciente').val(),
               estado:"Ocupada",
               color:"red",
               textColor:"white",
               start:$('#txtFecha').val()+" "+$('#txtHora').val()
             
           };
        }
        
        
             
           function EnviarInformacion(accion,objEvento){
               $.ajax({
                   type:'POST',
                   url:'../../../Controlador/controladorCitas.php?accion='+accion,
                   data:objEvento,
                   success:function(msg){
                       if (msg) {
    //-----   
                            $('.CalendarioWeb').fullCalendar('refetchEvents');
                            $("#modalCrud").modal('toggle');
                                }
                   },
                            error:function(){
                            alert("Hay un error");
              }     
                   
               });
           }
        
        
        
        
        
        </script>
        
    </body>
</html>