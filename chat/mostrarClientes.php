<?php

include_once('../Modelo/conexion.php');
include_once('../Modelo/usuario.php');

session_start();


if(isset($_SESSION["id_admin"])){

    $respuesta = Usuario::usuariosChatAdmin();

    foreach($respuesta as $row => $item){

    echo "<tr>
    <td>".$item["nombreUsuario"].cantidadMensajessinLeer($item["id_usuario"],$_SESSION["id_admin"])."</td>
    <td>".$item["apellidoUsuario"]."</td>
    <td>".$item["nombreEmpresa"]."</td>
    <td><button type='button'  class='btn btn-danger btn-xs empezarChat' data-touserid='".$item['id_usuario']."' data-tousername='".$item['nombreUsuario']."'>Chat</button>
  
    <div id='user_model_details' ></div>




    </td>
     
  
    


</tr>

";
    }



}