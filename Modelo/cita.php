<?php
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
 class Cita{
      private $start;  
  
    private $idpaciente;  
    private $color;
    private $textColor;
    
 
        public  function __construct() {  
        
        $acc = ServiceAccount::fromJsonFile(__DIR__.'/bd.json');
        $firebase = (new Factory)->withServiceAccount($acc)->create();
        $this->database = $firebase->getDatabase();
 }
 
 
       public function listarCitas(){
   //  $hola= $this->database->getReference("pruebas")->getSnapshot()->getValue();
     //   return compact($hola);
     
     $reference = $this->database->getReference('cita');

     $snapshot = $reference->getSnapshot();
     $value = $snapshot->getValue();
     return $value;
          if($value > 0){

     foreach($value as $key => $item){
      echo $item["idPaciente"];
      echo $item["start"];

          }
         
        }else{
          echo "No hay resultados";

        }
          return $value;
     

}
 
 
       public function registrarCita(array $data) {

        if (empty($data) || !isset($data)) { return FALSE; }
        
        $this->database->getReference("cita")->push($data);
   

      
        return TRUE;
      }
 }


