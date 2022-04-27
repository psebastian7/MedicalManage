<?php
///Enviar mensaje 
include('../Modelo/conexion.php');
include('../Modelo/usuario.php');

session_start();

if(isset($_SESSION["id_medico"])){
    $data = array(
        'usuarioReceptor'  => $_POST['to_user_id'],
        'usuarioEmisor'  => $_SESSION['id_medico'],
        'mensaje'  => $_POST['chat_message'],
        'estado'   => '1'
       );
       
       $respuesta = new Usuario();
       $respuesta->enviarMensaje($data);
    
       
       
       if($respuesta)
       {
        echo $respuesta2 = Usuario::verHistorialConversacion($_SESSION['id_medico'], $_POST['to_user_id']);
       }
}
if(isset($_SESSION["id_secretario"])){

    $data = array(
        'usuarioReceptor'  => $_POST['to_user_id'],
        'usuarioEmisor'  => $_SESSION['id_secretario'],
        'mensaje'  => $_POST['chat_message'],
        'estado'   => '1'
       );
       
       $respuesta = new Usuario();
       $respuesta->enviarMensaje($data);
    
       
       
       if($respuesta)
       {
        echo $respuesta2 = Usuario::verHistorialConversacion($_SESSION['id_secretario'], $_POST['to_user_id']);
       }

}

if(isset($_SESSION["id_admin"])){


    $data = array(
        'usuarioReceptor'  => $_POST['to_user_id'],
        'usuarioEmisor'  => $_SESSION['id_admin'],
        'mensaje'  => $_POST['chat_message'],
        'estado'   => '1'
       );
       
       $respuesta = new Usuario();
       $respuesta->enviarMensaje($data);
    
       
       
       if($respuesta)
       {
        echo $respuesta2 = Usuario::verHistorialConversacion($_SESSION['id_admin'], $_POST['to_user_id']);
       }

}



