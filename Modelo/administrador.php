
<?php

require_once"conexion.php";

class Administrador extends Conexion{


    public function registrarAdmin( $datos) {
        $sql = "INSERT INTO usuarios (rutUsuario,nombreUsuario,apellidoUsuario,telefonoUsuario,correoUsuario,passwordUsuario,tipoUsuario) values (:rut,:nombre,:apellido,:telefono,:correo,:passwordUs,:tipoUsuario)";
        $query = Conexion::conectar()->prepare($sql);
        $query ->bindParam(":rut",$datos["rut"], PDO::PARAM_STR  );
        $query->bindParam(":nombre",$datos["nombre"], PDO::PARAM_STR  );
        $query->bindParam(":apellido",$datos["apellido"], PDO::PARAM_STR  );
        $query->bindParam(":telefono",$datos["telefono"], PDO::PARAM_STR  );
        $query->bindParam(":correo",$datos["correo"], PDO::PARAM_STR  );
        $query->bindParam(":passwordUs",$datos["password"], PDO::PARAM_STR  );
        $query->bindParam(":tipoUsuario",$datos["tipoUsuario"], PDO::PARAM_INT  );

        $query-> execute();

      }
      public function borrarAdmin($id){
        $sql = "DELETE FROM usuarios WHERE id_usuario=:id";
        $query = Conexion::conectar()->prepare($sql);
        $query->bindParam(":id",$id,PDO::PARAM_INT);
        return $query->execute();
        $query->close();
          
      }
      public function registrarMedico( $datos) {
        $sql = "INSERT INTO usuarios (rutUsuario,nombreUsuario,apellidoUsuario,telefonoUsuario,correoUsuario,passwordUsuario,tipoUsuario,empresa,especialidad) values (:rut,:nombre,:apellido,:telefono,:correo,:passwordUs,:tipoUsuario,:empresa,:especialidad)";
        $query = Conexion::conectar()->prepare($sql);
        $query ->bindParam(":rut",$datos["rut"], PDO::PARAM_STR  );
        $query->bindParam(":nombre",$datos["nombre"], PDO::PARAM_STR  );
        $query->bindParam(":apellido",$datos["apellido"], PDO::PARAM_STR  );
        $query->bindParam(":telefono",$datos["telefono"], PDO::PARAM_STR  );
        $query->bindParam(":correo",$datos["correo"], PDO::PARAM_STR  );
        $query->bindParam(":passwordUs",$datos["password"], PDO::PARAM_STR  );
        $query->bindParam(":tipoUsuario",$datos["tipoUsuario"], PDO::PARAM_INT  );
        $query->bindParam(":empresa",$datos["empresa"], PDO::PARAM_INT  );
        $query->bindParam(":especialidad",$datos["especialidad"], PDO::PARAM_INT  );

        $query-> execute();

      }
      public function listarMedicosEmpresa($id){
  
        $sql = "SELECT * from usuarios inner join especialidad on  usuarios.especialidad = especialidad.id_especialidad where usuarios.empresa = :id and usuarios.tipoUsuario = 2";
    
        $query = Conexion::conectar()->prepare($sql);
        $query->bindParam(":id",$id,PDO::PARAM_INT);
        $query->execute();
         return $query->fetchAll();
        $query->close();
      }
      public function listarAdmins($id){
 
        $sql = "SELECT * from usuarios where tipoUsuario = 1 and id_usuario != :id ";
       $query = Conexion::conectar()->prepare($sql);
       $query->bindParam(":id",$id,PDO::PARAM_INT);
       $query->execute();
        return $query->fetchAll();
       $query->close();
   
     
   
   }
      public function listarEspecialidad(){
  
        $sql = "SELECT * from especialidad";
        $query = Conexion::conectar()->prepare($sql);
        $query->execute();
         return $query->fetchAll();
        $query->close();
      }
      public function registrarEmpresa( $datos) {
        $sql = "INSERT INTO empresas (nombreEmpresa,direccionEmpresa,regionEmpresa,comunaEmpresa,admin) values (:nombre,:direccion,:region,:comuna,:admin)";
        $query = Conexion::conectar()->prepare($sql);
        $query ->bindParam(":nombre",$datos["nombre"], PDO::PARAM_STR  );
        $query->bindParam(":direccion",$datos["direccion"], PDO::PARAM_STR  );
        $query->bindParam(":region",$datos["region"], PDO::PARAM_STR  );
        $query->bindParam(":comuna",$datos["comuna"], PDO::PARAM_STR  );
        $query->bindParam(":admin",$datos["admin"], PDO::PARAM_INT  );


        $query-> execute();
      }

      public function listarEmpresas(){
  
        $sql = "SELECT * from empresas";
        $query = Conexion::conectar()->prepare($sql);
        $query->execute();
         return $query->fetchAll();
        $query->close();
      }
      public function verDetalleEmpresa($id){
  
        $sql = "SELECT * from empresas where id_empresa = :id";
        $query = Conexion::conectar()->prepare($sql);
        $query->bindParam(":id",$id,PDO::PARAM_INT);
        $query->execute();
         return $query->fetchAll();
        $query->close();
      }
      public function validarNombreEmpresa($datos){
  
        $sql = "SELECT * from empresas where nombreEmpresa = :nombre";
        $query = Conexion::conectar()->prepare($sql);
        $query ->bindParam(":nombre",$datos, PDO::PARAM_STR  );
        $query->execute();
         return $query->fetchAll();
        $query->close();
      }
      public function validarTelefonoUsuario($datos){
  
        $sql = "SELECT * from usuarios where telefonoUsuario = :telefono";
        $query = Conexion::conectar()->prepare($sql);
        $query ->bindParam(":telefono",$datos, PDO::PARAM_STR  );
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
      public function validarEmailUsuario($datos){
  
        $sql = "SELECT * from usuarios where correoUsuario = :correo";
        $query = Conexion::conectar()->prepare($sql);
        $query ->bindParam(":correo",$datos, PDO::PARAM_STR  );
        $query->execute();
         return $query->fetchAll();
        $query->close();
      }
    
}