<?php


include_once(__DIR__.'/../Modelo/paciente.php');
include_once(__DIR__.'/../Modelo/cita.php');

require __DIR__.'/../vendor/autoload.php';

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;



$accion=(isset($_GET['accion']))?$_GET['accion']:'leer';

switch ($accion) {
    case 'agregar':

       $datosController = array("start"=>$_POST["start"],"idPaciente" =>$_POST["idPaciente"],"color"=>$_POST["color"],"textColor"=>$_POST["textColor"]);

        $respuesta = new Cita();
        $respuesta->registrarCita($datosController);
        
        
      echo json_encode($respuesta);
        
        break;
    
    
    default:
         $respuesta = new Cita();
        $respuesta ->listarCitas();
        
    
}
Class controladorCitas{
      public function listarUsuariosControllerCitas(){
        $respuesta = new paciente();
        $respuesta ->listarPacientesCitas();
       
    }
    
    public function listarCitasController() {
        
        
                $respuesta = new Cita();
        $respuesta ->listarCitas();

        
    }
    
    
}

