<?php

namespace App\exceptions\upload;

use Exception;

class uploadSizeException extends Exception{
     public function __construct(){
          throw new Exception("Error : File Size Is Too Large  !!");
     }
}