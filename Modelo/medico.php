<?php

require_once"conexion.php";



class Medico extends Conexion{

 

      public function registrarSecretario( $datos) {
        $sql = "INSERT INTO usuarios (rutUsuario,nombreUsuario,apellidoUsuario,telefonoUsuario,correoUsuario,passwordUsuario,tipoUsuario, empresa, medico) values (:rut,:nombre,:apellido,:telefono,:correo,:passwordUs,:tipoUsuario,:empresa,:medico)";
        $query = Conexion::conectar()->prepare($sql);
        $query ->bindParam(":rut",$datos["rut"], PDO::PARAM_STR  );
        $query->bindParam(":nombre",$datos["nombre"], PDO::PARAM_STR  );
        $query->bindParam(":apellido",$datos["apellido"], PDO::PARAM_STR  );
        $query->bindParam(":telefono",$datos["telefono"], PDO::PARAM_STR  );
        $query->bindParam(":correo",$datos["correo"], PDO::PARAM_STR  );
        $query->bindParam(":passwordUs",$datos["password"], PDO::PARAM_STR  );
        $query->bindParam(":tipoUsuario",$datos["tipoUsuario"], PDO::PARAM_INT  );
        $query->bindParam(":empresa",$datos["empresa"], PDO::PARAM_INT  );
        $query->bindParam(":medico",$datos["medico"], PDO::PARAM_INT  );

        $query-> execute();

      }
    

      public function listarSecretarios($id){
 
     $sql = "SELECT * from usuarios where medico = :id";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":id",$id,PDO::PARAM_INT);
    $query->execute();
     return $query->fetchAll();
    $query->close();

  

}
public function borrarSecretario($id){
  $sql = "DELETE FROM usuarios WHERE id_usuario=:id";
  $query = Conexion::conectar()->prepare($sql);
  $query->bindParam(":id",$id,PDO::PARAM_INT);
  return $query->execute();
  $query->close();
    
}





  public function listarPacientesMedico($id){
  
        $sql = "SELECT * from pacientes where medico = :id";
        $query = Conexion::conectar()->prepare($sql);
        $query->bindParam(":id",$id,PDO::PARAM_INT);
        $query->execute();
         return $query->fetchAll();
        $query->close();
    
 
 }
 public function crearConsulta($id,$data){
  $sql = "INSERT INTO consulta (motivoConsulta,diagnostico, paciente,medico) values (:motivo,:diagnostico,:id, :medico)";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":motivo",$data["motivo"], PDO::PARAM_STR);
    $query->bindParam(":diagnostico",$data["diagnostico"], PDO::PARAM_STR);
    $query->bindParam(":id",$id,PDO::PARAM_INT);
    $query->bindParam(":medico",$data["medico"],PDO::PARAM_INT);

      return $query->execute();
      
    
    $query->close();

 
  }
  public function registrarSignos($id,$data){
    $sql = "INSERT INTO signosvitales (preArterial,pulso, altura, peso,imc,paciente,medico) values (:presion,:pulso,:altura,:peso,:imc,:id,:medico)";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":presion",$data["presion"], PDO::PARAM_STR);
    $query->bindParam(":pulso",$data["pulso"], PDO::PARAM_STR);
    $query->bindParam(":altura",$data["altura"], PDO::PARAM_STR);
    $query->bindParam(":peso",$data["peso"], PDO::PARAM_STR);
    $query->bindParam(":imc",$data["imc"], PDO::PARAM_STR);
    $query->bindParam(":medico",$data["medico"], PDO::PARAM_INT);

    $query->bindParam(":id",$id,PDO::PARAM_INT);

      return $query->execute();
      
    
    $query->close();




   }
   public function borrarSignos($id){
   
    $sql = "DELETE FROM signosvitales WHERE id_signo=:id";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":id",$id,PDO::PARAM_INT);
    return $query->execute();
    $query->close();
  }

   public function verSignosPaciente($id, $medico){
    $sql = "SELECT * FROM signosvitales WHERE paciente=:id and medico = :medico";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":medico",$medico,PDO::PARAM_INT);
    $query->bindParam(":id",$id,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
    $query->close();
    }
    public function borrarConsulta($id){
   
      $sql = "DELETE FROM consulta WHERE id_consulta=:id";
      $query = Conexion::conectar()->prepare($sql);
      $query->bindParam(":id",$id,PDO::PARAM_INT);
      return $query->execute();
      $query->close();
    }

   

  public function verConsultasPaciente($id, $medico){
    $sql = "SELECT * FROM consulta WHERE paciente=:id and medico = :medico";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":medico",$medico,PDO::PARAM_INT);
    $query->bindParam(":id",$id,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
    $query->close();

  }
 

  public function verPaciente($id){
    $sql = "SELECT * FROM pacientes WHERE id_paciente=:id";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":id",$id,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
    $query->close();
    
  }
  public function registrarExamen(array $data) {
    $sql = "INSERT INTO examenes (nombreExamen,descripcion) values (:nombre,:descripcion)";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);
    $query->bindParam(":descripcion",$data["descripcion"], PDO::PARAM_STR);
      
      return $query->execute();
      
    
    $query->close();
  }
  public function listarExamenes(){
   
    $sql = "SELECT id_examen,nombreExamen,descripcion from examenes";
    $query = Conexion::conectar()->prepare($sql);
    $query->execute();
     return $query->fetchAll();
    $query->close();

          
}
public function listarExamenesPaciente(){
  $sql = "SELECT id_examen,nombreExamen,descripcion from examenes";
  $query = Conexion::conectar()->prepare($sql);
  $query->execute();
   return $query->fetchAll();
  $query->close();

}


  public function registrarMedicamento(array $data) {
    $sql = "INSERT INTO medicamentos (nombreMedicamento,miligramos,descripcion,medico) values (:nombre,:miligramos,:descripcion,:medico)";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);
    $query->bindParam(":miligramos",$data["miligramos"], PDO::PARAM_INT);
    $query->bindParam(":descripcion",$data["descripcion"], PDO::PARAM_STR);
    $query->bindParam(":medico",$data["medico"], PDO::PARAM_INT);

      return $query->execute();
      
    
    $query->close();

  }

  public function listarMedicamentos($id){
   
    $sql = "SELECT id_medicamento,nombreMedicamento,miligramos,descripcion from medicamentos where medico = :id";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":id",$id,PDO::PARAM_INT);
    $query->execute();
     return $query->fetchAll();
    $query->close();

          
}
public function listarMedicamentosReceta($id){
  $sql = "SELECT id_medicamento,nombreMedicamento,miligramos,descripcion from medicamentos where medico = :id";
  $query = Conexion::conectar()->prepare($sql);
  $query->bindParam(":id",$id,PDO::PARAM_INT);
  $query->execute();
   return $query->fetchAll();
  $query->close();

}


public function borrarMedicamento($id){
   
    $sql = "DELETE FROM medicamentos WHERE id_medicamento=:id";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":id",$id,PDO::PARAM_INT);
    return $query->execute();
    $query->close();
  }
  public function actualizarMedicamento($id,$data){
   
    $sql = "UPDATE medicamentos set nombreMedicamento=:nombre, miligramos=:miligramos, descripcion=:descripcion WHERE id_medicamento=:id";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);
    $query->bindParam(":miligramos",$data["miligramos"], PDO::PARAM_STR);
    $query->bindParam(":descripcion",$data["descripcion"], PDO::PARAM_STR);
    $query->bindParam(":id",$id,PDO::PARAM_INT);
    return $query->execute();
    $query->close();
  }
  public function registrarReceta($id,$data){
    $sql = "INSERT INTO receta (medicamentos,indicaciones, paciente, medico) values (:medicamentos,:indicaciones,:id, :medico)";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":medicamentos",$data["medicamentos"], PDO::PARAM_STR);
    $query->bindParam(":indicaciones",$data["indicaciones"], PDO::PARAM_STR);
    $query->bindParam(":medico",$data["medico"],PDO::PARAM_INT);
    $query->bindParam(":id",$id,PDO::PARAM_INT);

      return $query->execute();
      
    
    $query->close();

  }
  public function borrarReceta($id){
   
    $sql = "DELETE FROM receta WHERE id_receta=:id";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":id",$id,PDO::PARAM_INT);
    return $query->execute();
    $query->close();
  }
 
  public function verRecetaPaciente($id,$medico){
    $sql = "SELECT * FROM receta WHERE paciente=:id and medico = :medico";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":medico",$medico,PDO::PARAM_INT);
    $query->bindParam(":id",$id,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
    $query->close();
    }

  
  public function validarRutUsuario($data){
   
    $sql = "SELECT * FROM usuarios WHERE rutUsuario=:rut";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":rut",$data,PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll();
    $query->close();
  }
  public function validarEmailUsuario($data){
   
    $sql = "SELECT * FROM usuarios WHERE correoUsuario=:correo";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":correo",$data,PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll();
    $query->close();
  }
  public function validarMedicamentoRepetido($nombre,$mil){
   
    $sql = "SELECT * FROM medicamentos WHERE nombreMedicamento=:nombre AND miligramos = :mil";
    $query = Conexion::conectar()->prepare($sql);
    $query->bindParam(":nombre",$nombre,PDO::PARAM_STR);
    $query->bindParam(":mil",$mil,PDO::PARAM_INT);

    $query->execute();
    return $query->fetchAll();
    $query->close();
  }
      }
