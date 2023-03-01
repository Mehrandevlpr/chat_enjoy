<?php

namespace App\exceptions\connection;

use Exception;

class PdoException extends Exception{
     public function __construct(){
          throw new Exception("Error : connection dose not exist !!");
     }
}