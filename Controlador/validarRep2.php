<?php

include('../Modelo/conexion.php');
include('../Modelo/administrador.php');
include('../Modelo/secretario.php');
include('controlador.php');




if(isset($_SESSION["medico"])){
    $email = $_POST["verEmail"];

    if(isset($email)){
    $respuesta = Administrador::validarEmailUsuario($email);
    $respuesta2 = Secretario::validarEmailPacienteMedico($_SESSION["medico"],$email);
    
     if(count($respuesta) > 0 || count($respuesta2) > 0){
         echo 0;
     }else{
         echo 1;
     }
    }
}else{
    $email = $_POST["verEmail"];

    if(isset($email)){
    $respuesta = Administrador::validarEmailUsuario($email);
    $respuesta2 = Secretario::validarEmailPaciente($email);
    
     if(count($respuesta) > 0 || count($respuesta2) > 0){
         echo 0;
     }else{
         echo 1;
     }
    }
}


    