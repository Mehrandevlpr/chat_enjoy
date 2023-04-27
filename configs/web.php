<?php

return
[
     // ------------------------------------------  login and register
     '/login'=>[
          'target' => 'login_register@login',
          'methode' => 'get|post',
          'middleware'=> null
     ],
     '/register'=>[
          'target' => 'login_register@register',
          'methode' => 'get|post',
          'middleware'=> null
     ],
     '/profile'=>[
          'target' => 'login_register@profile',
          'methode' => 'get|post',
          'middleware'=> null
     ],
     '/isUserLogin'=>[
          'target' => 'login_register@isUserLogin',
          'methode' => 'get|post',
          'middleware'=> null
     ],

     // ------------------------------------------  chat route
     '/'=>[
          'target' => 'chat@index',
          'methode' => 'post',
          'middleware'=> null
     ],
     '/single/{id}'=>[
          'target' => 'chat@single',
          'methode' => 'get|post',
          'middleware'=> null
     ],
     '/chatConnection'=>[
          'target' => 'chat@chatConnection',
          'methode' => 'get|post',
          'middleware'=> null
     ],
     '/info'=>[
          'target' => 'chat@currentUser',
          'methode' => 'get|post',
          'middleware'=> null
     ],
     '/addContact'=>[
          'target' => 'chat@addContact',
          'methode' => 'get|post',
          'middleware'=> null
     ],

]

?>