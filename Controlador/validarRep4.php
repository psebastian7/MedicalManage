<?php 


include('../Modelo/conexion.php');
include('../Modelo/administrador.php');


$nombreEmpresa = $_POST["verNombre"];

if(isset($nombreEmpresa ) ){
$respuesta = Administrador::validarNombreEmpresa($nombreEmpresa );

 if(count($respuesta) > 0 ){
     echo 0;
 }else{
     echo 1;
 }
}
