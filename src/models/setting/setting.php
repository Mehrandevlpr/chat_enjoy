<?php

namespace App\models\setting;

use App\models\connection\connection;

class setting extends connection {
    protected static $table = 'settings';
    public function __construct(){
        
        parent::__construct();
        return $this;
    }
}

?>