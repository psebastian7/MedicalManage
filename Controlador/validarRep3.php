<?php

include('../Modelo/conexion.php');
include('../Modelo/medico.php');
include('../Modelo/secretario.php');
include('controlador.php');


$nombreMed = $_POST["verNombre"];
$milMed = $_POST["verMil"];

if(isset($nombreMed) && isset($milMed)){
$respuesta = Medico::validarMedicamentoRepetido($nombreMed,$milMed);

 if(count($respuesta) > 0 ){
     echo 0;
 }else{
     echo 1;
 }
}

    