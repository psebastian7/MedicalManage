<?php
require_once"conexion.php";



class Usuario extends Conexion{

    protected $rutUsuario;   
    private $nombreUsuario;  
    private $apellidoUsuario;  
    private $telefonoUsuario;  
    private $tipoUsuario;

  // public  function _construct($rutUsuario,$nombreUsuario,$apellidoUsuario,$telefonoUsuario,$tipoUsuario){
  //      $this->$rutUsuario = $rutUsuario;
    //    $this->$nombreUsuario = $nombreUsuario;
     //   $this->$apellidoUsuario = $apellidoUsuario;
     //   $this->$telefonoUsuario = $telefonoUsuario;
    //    $this->$tipoUsuario = $tipoUsuario;

   // }

  
    public function login($data){
        
        $sql = "SELECT id_usuario, rutUsuario, nombreUsuario, apellidoUsuario, telefonoUsuario, correoUsuario, passwordUsuario, tipoUsuario, empresa,especialidad, medico FROM usuarios WHERE correoUsuario = :correo";
        $query = Conexion::conectar()->prepare($sql);
        $query ->bindParam(":correo",$data["correo"], PDO::PARAM_STR  );
        $query -> execute();
        return  $query->fetch();
        $query -> close();
    
}
public function logout(){
        
  
  session_destroy();
  header("location:../../index.php");


}
public function verCuentaUsuario($id){

    $sql = "SELECT * from usuarios where id_usuario = :id";
   $query = Conexion::conectar()->prepare($sql);
   $query->bindParam(":id",$id,PDO::PARAM_INT);  $query->execute();

   $query->execute();
    return $query->fetchAll();
   $query->close();

 

}
public function editarCuentaUsuario($id,$datos){
  $sql = "UPDATE usuarios set  telefonoUsuario=:telefono, correoUsuario=:correo WHERE id_usuario=:id";
  $query = Conexion::conectar()->prepare($sql);
  $query->bindParam(":telefono",$datos["telefono"], PDO::PARAM_STR  );
  $query->bindParam(":correo",$datos["correo"], PDO::PARAM_STR  );
  $query->bindParam(":id",$id,PDO::PARAM_INT);  $query->execute();
  return $query->execute();
  $query->close();

}
public function editarContraseñaCuenta($id,$dato){
  $sql = "UPDATE usuarios set  passwordUsuario= :password WHERE id_usuario=:id";
  $query = Conexion::conectar()->prepare($sql);
  $query->bindParam(":password",$dato, PDO::PARAM_STR  );
  $query->bindParam(":id",$id,PDO::PARAM_INT);  $query->execute();
  return $query->execute();
  $query->close();

}
public function usuariosChat($id){
  $sql = "SELECT * from usuarios where medico = :id  ";
  $query = Conexion::conectar()->prepare($sql);
  $query ->bindParam(":id",$id, PDO::PARAM_INT  );

  $query->execute();
   return $query->fetchAll();
  $query->close();

  
}
public function usuariosAdminChatMedico(){
  $sql = "SELECT * from usuarios where tipoUsuario = 1  ";
  $query = Conexion::conectar()->prepare($sql);

  $query->execute();
   return $query->fetchAll();
  $query->close();

  
}
public function usuariosChatSecretario($medico){
  $sql = "SELECT * from usuarios where id_usuario = :medico  ";
  $query = Conexion::conectar()->prepare($sql);
  $query ->bindParam(":medico",$medico, PDO::PARAM_INT  );

  $query->execute();
   return $query->fetchAll();
  $query->close();

  
}
public function usuariosChatAdmin(){
  $sql = "SELECT * from usuarios inner join empresas on usuarios.empresa = empresas.id_empresa where tipoUsuario = 2 ";
  $query = Conexion::conectar()->prepare($sql);
  $query ->bindParam(":id",$id, PDO::PARAM_INT  );

  $query->execute();
   return $query->fetchAll();
  $query->close();

  
}

public function enviarMensaje($data){
  $sql = "INSERT INTO chat (usuarioEmisor,usuarioReceptor,mensaje,estadoMensaje) values (:usuarioEmisor,:usuarioReceptor,:mensaje,:estado)";
  $query = Conexion::conectar()->prepare($sql);
  $query ->bindParam(":usuarioEmisor",$data["usuarioEmisor"], PDO::PARAM_STR  );
  $query->bindParam(":usuarioReceptor",$data["usuarioReceptor"], PDO::PARAM_STR  );
  $query->bindParam(":mensaje",$data["mensaje"], PDO::PARAM_STR  );
  $query->bindParam(":estado",$data["estado"], PDO::PARAM_STR  );

  $query->execute();
   return $query->fetchAll();
  $query->close();

}


public function verHistorialConversacion($emisor,$receptor){
  $sql = "SELECT * from chat where (usuarioEmisor = :emisor and usuarioReceptor = :receptor) or (usuarioEmisor = :receptor and usuarioReceptor = :emisor)  ORDER BY fechaEnvio ASC";

  $query = Conexion::conectar()->prepare($sql);
  $query ->bindParam(":emisor",$emisor, PDO::PARAM_INT  );
  $query ->bindParam(":receptor",$receptor, PDO::PARAM_INT  );

  $query->execute();
   $result =  $query->fetchAll();

   $output = '<ul class="list-unstyled">';
   foreach($result as $row)
   {
    $user_name1 = '';
    $user_name2 = '';

    if($row["usuarioEmisor"] == $emisor)
    {
     $user_name1 = '<b class="text-success">Tu</b>';
    }
    else
    {
      $user_name2 = "<b class='text-danger'>". obtenerNombreUsuario($row['usuarioEmisor'])." </b>";
    }
    
    if($user_name1){

      $output .= '
      <div class="  text-right ">
      <li style="border-bottom:1px dotted #ccc ">
       <p class="mr-2">'.$user_name1.' </br> '.$row["mensaje"].'
        <div align="right">
         - <small><em>'.$row['fechaEnvio'].'</em></small>
        </div>
       </p>
      </li>
      </div>
      ';
    }
    if($user_name2){

      $output .= '
      <div >
      <li style="border-bottom:1px dotted #ccc ">
       <p>'.$user_name2.' </br> '.$row["mensaje"].'
        <div align="left">
         - <small><em>'.$row['fechaEnvio'].'</em></small>
        </div>
       </p>
      </li>
      </div>
      ';
    }

   }
   $output .= '</ul>';

   $query = "UPDATE chat set  estadoMensaje = 0  WHERE usuarioEmisor = ".$receptor." AND usuarioReceptor = ".$emisor." AND estadoMensaje = 1";

   $statement = Conexion::conectar()->prepare($query);
   $statement->execute();
   return $output;

  $query->close();

  
}



}

function obtenerNombreUsuario($id)
{
 $sql = "SELECT nombreUsuario FROM usuarios WHERE id_usuario = :id";
 $query = Conexion::conectar()->prepare($sql);
 $query ->bindParam(":id",$id, PDO::PARAM_INT  );
$query->execute();
$result = $query->fetchAll();
 foreach($result as $row)
 {
  return  $row['nombreUsuario'];
 }
}
function cantidadMensajessinLeer($emisor,$receptor)
{
 
 $sql = "SELECT * FROM chat WHERE usuarioEmisor = :emisor and usuarioReceptor = :receptor AND estadoMensaje = 1";

 $query = Conexion::conectar()->prepare($sql);
 $query ->bindParam(":emisor",$emisor, PDO::PARAM_INT  );
 $query ->bindParam(":receptor",$receptor, PDO::PARAM_INT  );

 $query->execute();
 $contador = $query->rowCount();
 $output = '';
 if($contador > 0)
 {
  $output = '<span class="badge badge-secondary ml-5">'.$contador.'</span>';
 }else if($contador == 0){
  $output = '<span class="label label-success"></span>';

 }
 return $output;
}

function notificacionesChat($receptor)
{
 
 $sql = "SELECT * FROM chat WHERE  usuarioReceptor = :receptor AND estadoMensaje = 1";
 $query = Conexion::conectar()->prepare($sql);
 $query ->bindParam(":receptor",$receptor, PDO::PARAM_INT  );

 $query->execute();
 $contador = $query->rowCount();
 $output = '';
 if($contador > 0)
 {
  $output = '<span class="badge badge-secondary ">'.$contador.'</span>';
 }else if($contador == 0){
  $output = '<span class="label label-success"></span>';

 }
 return $output;
}

