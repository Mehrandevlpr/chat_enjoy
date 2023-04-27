<?php

use App\models\user\user;
?>
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
     <link href="<?= baseUrlTemplate('chat/assets/css/bootstrap.css') ?>" rel="stylesheet" type='text/css'>
     <link href="<?= baseUrlTemplate('chat/assets/js/js.js') ?>" rel="stylesheet" type='text/css'>
     <link rel="icon" sizes="192x192" type="image/x-icon" href="<?= baseUrl('favicon.ico') ?>">
     <title>Chat_enjoy</title>
</head>
<body>
           <div class="center">
               <div class="contacts">
                    <i class="fas fa-bars fa-2x"></i>
                    <h2>
                         Menu
                    </h2>
                    <div class="contact">
                         <a href="">
                              <div class="pic-menu"><i class="fa-solid fa-gears fa-2xl"></i></div>
                              <div class="badge">
                              1
                              </div>
                              <div class="name">
                              Setting
                              </div>
                              <div class="message-setting">
                              Uploade  Your Profile
                              </div>
                         </a>
                    </div>

                    <div class="contact">
                        <a href="">
                              <div class="pic-menu"><i class="fa-solid fa-user-plus fa-2xl"></i></div>
                              <div class="badge">
                              5
                              </div>
                              <div class="name">
                              New Contact
                              </div>
                              <div class="message-setting">
                              Add New Contact
                              </div>
                        </a>
                    </div>
               </div>
               <div class="chat">
                    <div class="contact bar">
                         <div class="pic banner">
                            <i class="fa-regular fa-circle fa-sm  <?= isset($user['status']) ? 'status-online' : 'status-online' ?>"></i>
                         </div>
                         <div class="name">
                           <?= $user['first_name'] ?>
                         </div>
                         <div class="seen">
                           <?= $user['status']  ?>
                         </div>
                         <div class="dropdown-center">
                              <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                               <h2>...</h2>
                              </button>
                              <ul class="dropdown-menu">
                                   <li><a class="dropdown-item" href="#">Action</a></li>
                                   <li><a class="dropdown-item" href="#">Action two</a></li>
                                   <li><a class="dropdown-item" href="#">Action three</a></li>
                              </ul>
                         </div>
                    </div>
                    <div class="messages-index" id="chat">
                        <?php if( ! count($chat) > 0 ): ?>
                         <a href="<?= baseUrl('') ?>" class="contact-list">
                             <div>
                                <h1 class="pic-index pic-index-1"><i class="fa-solid fa-user-tie"></i></h1>
                             </div>
                             <div class="user-msg">
                               <h3><?= 'No Contact yet !!!' ?></h3>
                             </div>
                              
                           </a>
                           <?php else: ?>
                            <?php foreach($chat as $key => $chats): ?>
                              <a href="<?= baseUrl('single/'.$chats['random_id']) ?>" class="contact-list">
                              <div>
                                   <img class="pic-index" src="<?= $chats['profile'] ?>" alt="">
                                   <i class="fa-regular fa-circle fa-sm status-online"></i>
                                   
                                   <?php ?>
                                   <?php ?>
                                   <?php ?>
                              </div>
                              <div class="user-msg">
                                   <h3><?= strtok($chats['full_name'],' ').' :' ?></h3>
                                   <small>
                                        <?= substr('hello man every thing',0,15).'...' ?>
                                   </small>
                              </div>
                                   
                              </a>
                           <?php endforeach; ?>
                          <?php endif; ?>
                         <?php if($status_addBtn === true): ?>
                              <a href="<?= baseUrl('addContact') ?>"><span class='pulse-button'>+</span></a>
                         <?php else: ?>
                           <a href="<?= baseUrl('addContact') ?>"> <span class='add-button'>+</span></a>
                         <?php endif; ?>
                    </div>
                    <div class="input">

                    </div>
               </div>
          </div>
<script type="text/javascript" src="<?= baseUrlTemplate('chat/assets/js/js.js'); ?>"></script>    
 <script>
//    $(document).ready(function(){
//      // $("button").click(function(){
//      //    $("#div1").load("demo_test.txt");
//      // });
//    });
</script>         
</body>
</html>