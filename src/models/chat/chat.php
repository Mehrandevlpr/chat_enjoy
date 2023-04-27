<?php

namespace App\models\chat;

use App\models\connection\connection;

class chat extends connection {
    protected static $table = 'chats';
    public function __construct(){
        parent::__construct();

    }
}

?>