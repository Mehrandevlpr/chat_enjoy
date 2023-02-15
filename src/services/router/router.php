<?php
namespace App\services\router;
use App\utilities\request\request;
use App\helper\helper;

class router{
     const BASE_MIDELLWARE = "\\App\\middleware";
     const BASE_CONTROLLER = "\\App\\controller";

     public static function route() {
         $request     = new Request();
         $getAllRoute = helper::getWebroute();
         if(!in_array($request->getCurrentRoute(),\array_keys($getAllRoute))){

            // throw Exception
            die("error : was completed soon !");
         }

         \var_dump("ok");
         
     }
}

?>