<?php

include_once('../Modelo/conexion.php');
include_once('../Modelo/usuario.php');

session_start();


if(isset($_SESSION["id_medico"])){

    $respuesta = Usuario::usuariosChat($_SESSION["id_medico"]);

    foreach($respuesta as $row => $item){

        echo "<tr>
        <td>".$item["nombreUsuario"].cantidadMensajessinLeer($item["id_usuario"],$_SESSION["id_medico"])."</td>
        <td>".$item["apellidoUsuario"]."</td>
        <td><button type='button'  class='btn btn-danger btn-xs empezarChat' data-touserid='".$item['id_usuario']."' data-tousername='".$item['nombreUsuario']."'>Chat</button>
      
        <div id='user_model_details' ></div>
    
    
    
    
        </td>
     
  
    


</tr>

";
    }



}