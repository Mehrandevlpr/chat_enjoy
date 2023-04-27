<?php

namespace App\Controllers;

use App\models\attachment\attachment;
use App\models\chat\chat;
use App\models\member\member;
use App\models\message\message;
use App\models\setting\setting;
use App\models\user\user;


class main{
     protected $userInstance;
     protected $chatInstance;
     protected $messageInstance;
     protected $memberInstance;
 


     public function __construct()
     {


          $this->userInstance    = self::getUserData();
          $this->chatInstance    = self::getChatData();
          $this->messageInstance = self::getMessageData();
          $this->memberInstance  = self::getMember();

          
          return $this ;
     }


     public static function getUserData(){
 
          $user  = new user();
          return $user;
      
     }
     public static function getChatData(){
 
          // if( isset( $_SESSION['info'] ) && ! empty( $_SESSION['info'] ) ){
            
          // }
    
          $chat  = new chat();
          return $chat;
             
     }
     public function getSettingData(){
 
          // if( isset( $_SESSION['info'] ) && ! empty( $_SESSION['info'] ) ){
            
          // }
    
          $setting  = new setting();
          return      $setting;
             
     }
     public function getMessageData(){
 
          // if( isset( $_SESSION['info'] ) && ! empty( $_SESSION['info'] ) ){
            
          // }
    
          $message  = new message();
          return      $message;
             
     }

     public function getAttachment(){
 
          // if( isset( $_SESSION['info'] ) && ! empty( $_SESSION['info'] ) ){
            
          // }
    
          $attachment  = new attachment();
          return         $attachment;
             
     }
     public function getMember(){
 
          // if( isset( $_SESSION['info'] ) && ! empty( $_SESSION['info'] ) ){
            
          // }
    
          $attachment  = new member();
          return         $attachment;
             
     }


}