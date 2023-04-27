<?php

namespace App\Controllers;

use App\utilities\sanitizer\sanitizer;
use App\services\view\view;
use App\models\user\user;
use App\utilities\uploader\uploader;
use App\exceptions\upload\uploadException;
use App\utilities\request\request;
use App\utilities\response\Response;

class login_register extends main{


     public function login(){
          
          $referrer = ($_SERVER['HTTP_REFERER']) ?? '';
          $isLoggedIn = explode('/',$referrer);
          $referrer = end($isLoggedIn);

          if(  in_array( $referrer , [ 'isUserLogin' , 'register' ,'profile'] ) )
          {
               
               if( ! isset( $_POST['submit'] ) ){  

                    throw new uploadException();
               }
               
               $uploader    = new uploader( $_FILES['profile'] );
               $profilePath = $uploader->save();
     
               $user_info = array( 
     
                    'first_name'      => $_POST['firstName'],
                    'last_name'       => $_POST['lastName'],
                    'email'           => $_POST['email'],
                    'profile'         => $profilePath['profile'],
                    'phone'           => $_POST['phone'],
                    'password'        => $_POST['password'],
                    'password_hash'   => password_hash($_POST['re_password'],PASSWORD_BCRYPT),
                    'hash_profile'    => $profilePath['profileHash']
               );
     
               if(sanitizer::validate_register($_POST,$user_info)===false){
     
                    header('Location: '.BASE_URL.'register');
                    exit();
               }
     
               
               $user = $this->userInstance->read('email' , ['email' => $_POST['email'] ] );
     
               if((count( $user ) > 0) || !( $this->userInstance->create($user_info) ) ){
     
                    $template ='login.register';
                    view::render( $template );
                    exit();

               }
     
               $this->userInstance->create( $user_info );

     
          }

         
          $template ='login.login';
          view::render( $template );
     }


     public function register(){

          $template ='login.register';
          view::render( $template );
     }



     public function profile(){

          $filter=array( 'email' , 'password' , 're_password' );
          $pattern = array (

                '#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i',
                '#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i',
                '#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i',
          );
          $user_info = array (
               
               'email' => $_POST['email'],
               'password' => $_POST['password'],
               're_password' => $_POST['re_password']
          );
                 
          if( sanitizer::validate_register( $_POST , $filter ) === false )
          {
               $this->register();
               exit();
          }

          $user_info = preg_replace( $pattern , [ '' , '' , '' ] , $user_info );

          if( strlen( $_POST['email'] ) !== strlen( $user_info['email'] )){

               $this->register();
               exit();
          }
          
          if(  strnatcmp( $_POST['password'] , $_POST['re_password'] ) !== 0 )
          {

               $this->register();
               exit();
          }

          
          $template ='login.profile';
          view::render( $template , $user_info );
     }


     public function isUserLogin(){
          
          $_SESSION['info'][0]['id'] = null;
          $user = $this->userInstance->read('*' , ['email' => $_POST['email'] ] );
       
          if( !( count( $user ) > 0 ) || !( password_verify( $_POST['password'] , $user[0]['password_hash'] ) ))
          {

               $this->register();
               exit();
          }
          $_SESSION['info'][0]['id'] = $user[0]['id'];

          header("location: /");
          exit;

     }

     





}