<?php

namespace App\exceptions\upload;

use Exception;

class uploadException extends Exception{
     public function __construct(){
          throw new Exception("Error : upload File Is Not Found !!");
     }
}