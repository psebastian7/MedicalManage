<?php

require_once"conexion.php";


class Secretario extends Conexion{

  //public  function __construct($rutUsuario, $nombreUsuario, $apellidoUsuario, $telefonoUsuario, $tipoUsuario) {  
       // parent::__construct($rutUsuario, $nombreUsuario, $apellidoUsuario, $telefonoUsuario, $tipoUsuario);  
     
     // }  
     
    public function registrarPaciente(array $data) {
  
      $sql = "INSERT INTO pacientes (rutPaciente,nombrePaciente,apellidoPaciente,fechaNac,genero,direccionPaciente, telefonoPaciente,correoPaciente,secretario,medico, empresa) values (:rut,:nombre,:apellido,:fecha,:genero,:direccion, :telefono,:correo, :secretario, :medico, :empresa)";
        $query = Conexion::conectar()->prepare($sql);
        $query ->bindParam(":rut",$data["rut"], PDO::PARAM_STR  );
        $query->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR  );
        $query->bindParam(":apellido",$data["apellido"], PDO::PARAM_STR  );
        $query->bindParam(":fecha",$data["fechaNac"], PDO::PARAM_STR  );
        $query->bindParam(":genero",$data["genero"], PDO::PARAM_STR  );
        $query->bindParam(":telefono",$data["telefono"], PDO::PARAM_STR  );
        $query->bindParam(":correo",$data["correo"], PDO::PARAM_STR  );
        $query->bindParam(":direccion",$data["direccion"], PDO::PARAM_STR  );
        $query->bindParam(":secretario",$data["secretario"],PDO::PARAM_INT);
        $query->bindParam(":medico",$data["medico"],PDO::PARAM_INT);
        $query->bindParam(":empresa",$data["empresa"],PDO::PARAM_INT);

        return $query->execute();
        $query->close();


        


    }

    public function listarPacientes($medico){

        $sql = "SELECT * from pacientes where medico = :medico";
        $query = Conexion::conectar()->prepare($sql);
        $query->bindParam(":medico",$medico,PDO::PARAM_INT);
        $query->execute();
         return $query->fetchAll();
        $query->close();
    
      
   
   }
   public function actualizarPaciente($id,$datos){
   
    $sql = "UPDATE pacientes set  telefonoPaciente=:telefono, correoPaciente=:correo, direccion=:direccion WHERE id_paciente=:id";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":telefono",$datos["telefono"], PDO::PARAM_STR  );
    $query->bindParam(":correo",$datos["correo"], PDO::PARAM_STR  );
    $query->bindParam(":direccion",$datos["direccion"], PDO::PARAM_STR  );

    $query->bindParam(":id",$id,PDO::PARAM_INT);
    return $query->execute();
    $query->close();
  }
   public function borrarPaciente($id){
    $sql = "DELETE FROM pacientes WHERE id_paciente=:id";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":id",$id,PDO::PARAM_INT);
    return $query->execute();
    $query->close();
    
  }
 
  public function validarRutPaciente($data){
   
    $sql = "SELECT * FROM pacientes WHERE rutPaciente=:rut";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":rut",$data,PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll();
    $query->close();
  }
  public function validarRutPacienteMedico($id, $data){
   
    $sql = "SELECT * FROM pacientes WHERE rutPaciente=:rut and medico = :medico";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":rut",$data,PDO::PARAM_STR);
    $query->bindParam(":medico",$id,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
    $query->close();
  }
  public function validarEmailPaciente($data){
   
    $sql = "SELECT * FROM pacientes WHERE correoPaciente=:correo";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":correo",$data,PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll();
    $query->close();
  }
  public function validarEmailPacienteMedico($id , $data){
   
    $sql = "SELECT * FROM pacientes WHERE correoPaciente=:correo and medico = :medico";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":correo",$data,PDO::PARAM_STR);
    $query->bindParam(":medico",$id,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
    $query->close();
  }
  public function validarTelefonoPaciente($data){
   
    $sql = "SELECT * FROM pacientes WHERE telefonoPaciente=:telefono";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":telefono",$data,PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll();
    $query->close();
  }
  public function validarTelefonoPacienteMedico($id,$data){
   
    $sql = "SELECT * FROM pacientes WHERE telefonoPaciente=:telefono and medico = :medico";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":telefono",$data,PDO::PARAM_STR);
    $query->bindParam(":medico",$id,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
    $query->close();
  }

}