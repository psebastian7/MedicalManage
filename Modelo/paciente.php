<?php
  use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;  

class Paciente{
   private $nombreUsuario;  
    private $apellidoUsuario;  
    private $telefonoUsuario;  
    private $tipoUsuario;
    
     public  function __construct() {  
        
        $acc = ServiceAccount::fromJsonFile(__DIR__.'/bd.json');
        $firebase = (new Factory)->withServiceAccount($acc)->create();
        $this->database = $firebase->getDatabase();
      }  
    
    
          public function listarPacientesCitas(){
   //  $hola= $this->database->getReference("pruebas")->getSnapshot()->getValue();
     //   return compact($hola);
     
     $reference = $this->database->getReference('pacientes');

     $snapshot = $reference->getSnapshot();
     $value = $snapshot->getValue();
     if($value > 0){

     foreach($value as $key => $item){
      echo '<option value='.$key.'>'.$item["nombre"]."   ".$item["rut"].'</option>';
          }
          return $value;
        }else{
          echo "No hay resultados";

        }

}
    
}
