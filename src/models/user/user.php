<?php

namespace App\models\user;

use App\models\connection\connection;

class user extends connection {
    protected static $table = 'users';
    public function __construct(){
        
        parent::__construct();
        return $this;
    }
}

?>