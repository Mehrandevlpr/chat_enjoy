<?php

namespace App\Controllers;

use App\models\user\user;
use App\services\view\view; 
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\services\ratchet\ChatConnection;
use App\utilities\request\request;
use App\utilities\response\Response;
use React\Socket\ConnectionInterface;
use Socket;

class chat extends main{


     private $user;

     public function index()
     {
          if( !isset($_SESSION['info'][0]['id'] ) && is_null( $_SESSION['info'][0]['id'] ) ){
               header( "location: /login" );
               exit;
          }

          $userChatId = $this->getAllChatIsActiveNow( $_SESSION['info'][0]['id'] );

         
          $this->userInstance->update([  'status' => 'online' ], [ 'id' =>  $_SESSION['info'][0]['id'] ]);
          $user = $this->userInstance->read( '*' , [ 'id' => $_SESSION['info'][0]['id'] ]);

          $chats = array();

          foreach( $userChatId as $chat ){
               $test = $this->chatInstance->read( '*' , [ 'member_id' => $chat ] );
               $chats[] = $test[0];
          }
        
          if(! count( $chats ) > 0 ){

               $data = array
               (
                    'user'  => $user[0],
                    'chat'  => [],
                    'status_addBtn' => true
               );

               $template = 'chat.home';
               view::render( $template , $data );
               exit();
          }



          $data = array
          (
               'user'  => $user[0],
               'chat'  => $chats,
               'status_addBtn' => false
          );

          // Response::responseAndDie($data,Response::HTTP_OK);
          $template = 'chat.home';
          view::render( $template , $data );

     }


     public function single($id)
     {
          

          $chat_id = $this->chatInstance->read( 'id' , [ 'random_id' => $id ]); 

          $members = $this->memberInstance->read( '*' , ['chat_id' => $chat_id ]);

          $userIds = explode( ',' , $members[0]['user_id'] );
          
          $userReciver = array();
          $userSender = array();
 
          $key = array_search( $_SESSION['info'][0]['id'] , $userIds );
          if(  in_array( $_SESSION['info'][0]['id'] , $userIds ) ){
               $userReciver[0] = $userIds[$key];
          }
          
          unset($userIds[$key]);

          $userSender[0] = end( $userIds );
          $message = $this->messageInstance->read( '*' , [ 'chat_id' => $chat_id ]);


          $chat    = $this->chatInstance->read( '*' , [ 'random_id' => $id ] );
          
          $data = array(
               "user_sender"  => $userSender[0],
               "user_reciver" => $userReciver[0],
               "message"      => $message,
               "chat"         => $chat[0]
          );

          $template ='chat.single';
          view::render( $template , $data );
          
             
     }

     public function chatConnection(){

          $chat    = $this->chatInstance->read( 'id' , [ 'random_id'  => $_POST['chat_id'] ]);
          $data = array(
               'message' => $_POST['message'],
               'user_id' => $_POST['user_id'],
               'chat_id' => $chat[0]
          );




          $this->messageInstance->create($data);
          echo json_encode([
               'message' => 'success',
               'data' => [
                    'message' => $_POST['message'],
                    'user_id' => $_POST['user_id']
               ]
          ], JSON_UNESCAPED_UNICODE);

          return false;
         
     }

     public function getAllChatIsActiveNow($user):array{

    
       
          $members = $this->memberInstance->read(['id','user_id','chat_id']);
          $memberIds = array();
          $chatList = array();
          $chats = array();

          for( $i = 0 ; $i < count( $members ) ; $i++ ){
               
               $chatList[] = explode( ',' , $members[$i]['user_id'] );

               if( in_array( $user , $chatList[$i] ) ){

                    $memberIds[] = $members[$i]['id'];
                    continue ;
               }

               $chats[] = implode(',',$chatList[$i]);
          
               
          }


          
          if(!count($memberIds) > 0){
               return array() ; // json return 
          }

          return $memberIds;
     }


     public function addContact(){
          $template = 'chat.newContact';
          view::render( $template  );
     }



}
