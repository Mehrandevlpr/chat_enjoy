<?php

namespace App\Controllers;

use App\services\view\view;

class login_register_controller{

     public function login(){
          $template ='login.login';
          view::render($template);
     }

     public function register(){
          $template ='login.register';
          view::render($template);
     }
}