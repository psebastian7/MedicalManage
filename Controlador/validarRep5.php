<?php 


include('../Modelo/conexion.php');
include('../Modelo/administrador.php');
include('../Modelo/secretario.php');


$telefono = $_POST["verTelefono"];

if(isset($telefono) ){
$respuesta = Administrador::validarTelefonoUsuario($telefono );
$respuesta2 = Administrador::validarTelefonoPaciente($telefono );

if(count($respuesta) > 0 || count($respuesta2) > 0){
    echo 0;
 }else{
     echo 1;
 }
}