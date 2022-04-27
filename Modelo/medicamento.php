<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class Medicamento {
    protected $database;

    public  function __construct() {  
          
          $acc = ServiceAccount::fromJsonFile(__DIR__.'/bd.json');
          $firebase = (new Factory)->withServiceAccount($acc)->create();
          $this->database = $firebase->getDatabase();
        }  





}