<?php

include_once('../Modelo/usuario.php');

session_start();


if(isset($_SESSION["id_admin"])){

echo notificacionesChat($_SESSION["id_admin"]);

}
if(isset($_SESSION["id_medico"])){

    echo notificacionesChat($_SESSION["id_medico"]);
    
    }
    if(isset($_SESSION["id_secretario"])){

        echo notificacionesChat($_SESSION["id_secretario"]);
        
        }