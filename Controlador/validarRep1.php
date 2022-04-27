<?php

include('../Modelo/conexion.php');
include('../Modelo/administrador.php');
include('../Modelo/secretario.php');
include('controlador.php');

if(isset($_SESSION["medico"])){
    if(isset($rut)){
        $respuesta = administrador::validarRutUsuario($rut);
        $respuesta2 = Secretario::validarRutPacienteMedico($_SESSION["medico"], $rut);
        
         if(count($respuesta) > 0 || count($respuesta2) > 0){
             echo 0;
         }else{
             echo 1;
         }
        }
}else{
    $rut = $_POST["verRut"];

    if(isset($rut)){
    $respuesta = Administrador::validarRutUsuario($rut);
    $respuesta2 = Secretario::validarRutPaciente($rut);
    
     if(count($respuesta) > 0 || count($respuesta2) > 0){
         echo 0;
     }else{
         echo 1;
     }
    }
}

