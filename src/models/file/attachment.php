<?php

namespace App\models\attachment;

use App\models\connection\connection;

class attachment extends connection {
    protected static $table = 'attachments';
    public function __construct(){
        
        parent::__construct();
        return $this;
    }
}

?>