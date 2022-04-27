<?php

include('../Modelo/conexion.php');
include('../Modelo/usuario.php');

session_start();

if(isset($_SESSION["id_medico"])){

echo $respuesta = Usuario::verHistorialConversacion($_SESSION['id_medico'], $_POST['to_user_id']);
}

if(isset($_SESSION["id_secretario"])){

    echo $respuesta = Usuario::verHistorialConversacion($_SESSION["id_secretario"], $_POST['to_user_id']);
}

if(isset($_SESSION["id_admin"])){

    echo $respuesta = Usuario::verHistorialConversacion($_SESSION["id_admin"], $_POST['to_user_id']);
}