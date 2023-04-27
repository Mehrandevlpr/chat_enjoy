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

        //  var_dump($getAllRoute,$currentUri);
        $uri_path = parse_url( $_SERVER['REQUEST_URI'] , PHP_URL_PATH );
        $uri_segments = explode( '/' , $uri_path );
        
        if( ! ( $uri_segments[1] === 'single' && is_numeric( $uri_segments[2] ) ) &&
            ( ! in_array( $currentUri,\array_keys( $getAllRoute ) ) ) ){

            view::renderErrorTemplate( 'error' );
            die(); 
        }
        

        //// check if route exists with ID
        if(  isset( $uri_segments[2] )  ){
        $currentUri = '/single/{id}';
        }
    
    
        ///// in class : check if method exists  
        //////// check if is request method is correct
        
        [$class, $method] = \explode( '@' , $getAllRoute[$currentUri]['target'] );
        $className =  self::BASE_CONTROLLER.$class;
  
        if(!class_exists($className)){

              throw new classException();
              die();
        }

        $fullPathClass =  new $className($request);

        if( !\method_exists( $fullPathClass , $method ) ){

            throw new  methodException();
            die();
        }
        $fullPathClass->$method( $uri_segments[2] ?? null );
        
         
    }
}

?>