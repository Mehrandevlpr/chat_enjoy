<?php

namespace App\Controllers;

use App\models\connection\connection;
use App\services\view\view;

class home_controller{

     public function index(){
          $template ='chat.home';
          view::render($template);
          
          
     }

}