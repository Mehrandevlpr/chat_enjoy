<?php

namespace App\exceptions\router;

use Exception;

class methodException extends Exception{
     public function __construct(){
          throw new Exception("Error : route dose not exist !!");
     }
}