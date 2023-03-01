<?php
namespace App\services\router;

use App\exceptions\router\classException;
use App\exceptions\router\methodException;
use App\exceptions\router\routeException;
use App\utilities\request\request;
use App\helper\helper;
use App\services\view\view;

class router{
     const BASE_MIDELLWARE = "\\App\\middlewares\\";
     const BASE_CONTROLLER = "\\App\\controllers\\";

     public static function route() {
         $request     = new Request();
         $currentUri  = $request->getCurrentRoute();
         $getAllRoute = webroute();
         //// check if route exists
         if(!in_array($currentUri,\array_keys($getAllRoute))){
            view::renderErrorTemplate('error');
            die(); 
         }

         
        ///// in class : check if method exists  
        //////// check if is request method is correct
        [$class, $method] = \explode('@',$getAllRoute[$currentUri]['target']);
        $className =  self::BASE_CONTROLLER.$class;

        if(!class_exists($className)){

              throw new classException();
              die();
        }

        $fullPathClass =  new $className();

        if(!\method_exists($fullPathClass,$method)){

            throw new  methodException();
            die();
        }
        $fullPathClass->$method();
        
         
     }
}

?>