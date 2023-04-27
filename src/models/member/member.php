<?php

namespace App\models\member;

use App\models\connection\connection;

class member extends connection {
    protected static $table = 'members';
    public function __construct(){
        
        parent::__construct();
        return $this;
    }
}

?>