<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <!-- Chrome, Firefox OS and Opera -->
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="theme-color" content="hsl(24.3, 97.4%, 54.3%)" />
     <link rel="stylesheet" href="<?= baseUrlTemplate('chat/assets/css/fontawesome/css/all.min.css')?>" >
     <link href="<?= baseUrlTemplate('chat/assets/css/style.css') ?>" rel="stylesheet" type='text/css'>
     <link rel="icon" sizes="192x192" type="image/x-icon" href="<?= baseUrl('favicon.ico') ?>">
     <title>Chat_enjoy</title>
</head>
<body>
           <div class="center">
               <div class="contacts contacts-single">
                    <i class="fas fa-bars fa-2x"></i>
                    <h2>
                         Menu
                    </h2>
                    <div class="contact">
                         <div class="pic-menu"><i class="fa-solid fa-gears fa-2xl"></i></div>
                         <div class="badge">
                         1
                         </div>
                         <div class="name">
                         Setting
                         </div>
                         <div class="message">
                         Uploade  Your Profile
                         </div>
                    </div>
                    <div class="contact">
                         <div class="pic-menu"><i class="fa-solid fa-user-plus fa-2xl"></i></div>
                         <div class="badge">
                         5
                         </div>
                         <div class="name">
                         New Contact
                         </div>
                         <div class="message">
                          Add New Contact
                         </div>
                    </div>
               </div>
               <div class="chat">
                    <div class="contact bar">
                         <div class="pic banner"></div>
                         <div class="name">
                           <?= $chat['full_name'] ?>
                         </div>
                         <div class="seen">
                         Today at 12:56
                         </div>
                         <div class="dropdown-center">
                              <a class="btn btn-secondary dropdown-toggle" href="<?= baseUrl('') ?>">
                               <i class="fa-solid fa-arrow-left"></i>
                              </a>
                         </div>
                    </div>
                    <div class="messages" id="chat">
                         <?php foreach($message as $msg): ?>
                              <?php if( (time() - strtotime($msg['created_at'])) > 360 ): ?>
                                   <div class="time">
                                   Today at <?= date('Y M D' ,strtotime($msg['created_at'])); ?>
                                   </div>
                              <?php endif; ?>
                              <?php if($msg['user_id'] === $user_sender ): ?>
                              <div class="message parker">
                                   <?= $msg['message'] ?>
                                   <input type="hidden" class="sender" value="<?= $user_sender ;?>">
                              </div>
                              <?php elseif( $msg['user_id'] === $user_reciver ): ?>
                              <div class="message stark">
                                   <?= $msg['message'] ?>
                                   <input type="hidden" class="reciver" value="<?= $user_reciver ;?>">
                              </div>
                              <?php endif; ?>
                         <?php endforeach; ?>
                         <div class="message stark">
                              <div class="typing typing-1"></div>
                              <div class="typing typing-2"></div>
                              <div class="typing typing-3"></div>
                         </div>
                    </div>
                    <div class="input-single">
                         <i class="fa-solid fa-camera-retro"></i>
                         <i class="fa-regular fa-image"></i>
                         <input id="message"  placeholder="Type your message here!" spellcheck="false" type="text" />
                         <input id="info" type="hidden" value="<?= $user_sender ;?>">
                         <button id="btn"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
               </div>
          </div>
<script type="text/javascript" src="<?= baseUrlTemplate('chat/assets/js/jQuery.js'); ?>"></script>                
<script type="text/javascript">

     $(document).ready(function(){


          var url = window.location.href.split('/');
          var socket = new WebSocket("ws://localhost:8080");

          socket.onmessage = function(e) {
                    var data = JSON.parse(e.data);
                    console.log(data);
                    var html = '<div class="message stark">'+ data.message +'<input type="hidden" class="reciver" value="'+ data.user_id +'"></div>';
                    $('#chat').append(html);    

          };
          socket.onopen = function(e) {
             console.log("Connection established!");
          };

          $('.fa-arrow-left').click(function(e){
                    socket.onclose();
          });

          // $('#message').keyup(function (e) {
          //      if (e.which === 13) {
          //           return sendMessage(getMessageText());
          //      }
          // });
   
            
          $('#btn').click(function(e){
               e.preventDefault;
               console.log();
               var id = $("#info").attr('value');
               var message = $('#message').val();
               var sendInfo = {
                         message: message,
                         user_id: id,
                         chat_id: url[4],
               };
               socket.send(JSON.stringify(sendInfo));
               $.ajax({
                    
                    xhrFields: {
                        withCredentials: true
                    },
                    type: "POST",
                    url: "/chatConnection",
                    data: sendInfo,
                    dataType: "text",
                    success: function (response) {
                         console.log(response);
                         const { data: { message ,user_id } } = jQuery.parseJSON(response);
                         if (message) {
                             
                              // if(user_id === id ){
                                   var html = '<div class="message parker">'+ message +'</div>';
                                   html = html + '<input type="hidden" class="sender" value="'+ user_id +'">';
                              // }else{
                              //      var html = '<div class="message stark">'+ message +'</div>';
                              //      html = html + '<input type="hidden" class="reciver" value="'+ user_id +'">';
                              // }
                              $('#chat').append(html);
                              $('#message').val('');
                         } else {
                              alert("please check connection ...");
                         }
                    },
                    
               });
          });

          // setInterval(function(){
          //    $("#chat").load();

    
          // },1000);
    });
</script> 
</body>
</html>