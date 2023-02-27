<?php

namespace App\Controllers;

use App\services\view\view;

class home_controller{

     public function index(){
          $template ='login.login';
          view::render($template);
     }
}