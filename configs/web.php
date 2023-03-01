<?php

return
[
     // ------------------------------------------  login and register
     '/login'=>[
          'target' => 'login_register_controller@login',
          'methode' => 'get|post',
          'middleware'=> null
     ],
     '/register'=>[
          'target' => 'login_register_controller@register',
          'methode' => 'get|post',
          'middleware'=> null
     ],
     // ------------------------------------------  chat route
     '/'=>[
          'target' => 'home_controller@index',
          'methode' => 'get|post',
          'middleware'=> null
     ],
     '/profile'=>[
          'target' => 'home_controller@index',
          'methode' => 'get|post',
          'middleware'=> null
     ],
     '/'=>[
          'target' => 'home_controller@index',
          'methode' => 'get|post',
          'middleware'=> null
     ],

]

?>