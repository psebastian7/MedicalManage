<?php
class  Conexion{


    public function conectar(){
        $link = new PDO("mysql:host=localhost;dbname=medicalmanage","root","");
        return $link;
    }
    }
    $connect = Conexion::conectar();
    function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
 $query = "
 SELECT * FROM chat 
 WHERE (usuarioEmisor = '".$from_user_id."' 
 AND usuarioReceptor = '".$to_user_id."') 
 OR (usuarioEmisor = '".$to_user_id."' 
 AND usuarioReceptor = '".$from_user_id."') 
 ORDER BY fechaEnvio DESC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["usuarioEmisor"] == $from_user_id)
  {
   $user_name = '<b class="text-success">Tu</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.get_user_name($row['usuarioEmisor'], $connect).'</b>';
  }
  $output .= '
  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row["mensaje"].'
    <div align="right">
     - <small><em>'.$row['fechaEnvio'].'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';
 return $output;
}

function get_user_name($user_id, $connect)
{
 $query = "SELECT nombreUsuario FROM usuarios WHERE id_usuario = '$user_id'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['nombreUsuario'];
 }
}