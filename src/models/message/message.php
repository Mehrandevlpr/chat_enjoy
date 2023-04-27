<?php

namespace App\models\message;

use App\models\connection\connection;

class message extends connection {
    protected static $table = 'messages';
    public function __construct(){
        
        parent::__construct();
        return $this;
    }
}

?>