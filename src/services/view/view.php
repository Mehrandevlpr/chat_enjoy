<?php

namespace App\services\view;

class view {

     public static function render($view,$data =[],$layout=null) {
         /// cache 
         ///// extrect
         ///////// view
         $view         = str_replace('.',\DIRECTORY_SEPARATOR,$view);
         $fullViewPath = \BASE_VIEW_PATH.$view.'.php';

         if(!file_exists($fullViewPath) && !is_readable($fullViewPath)){
            self::renderErrorTemplate('error',$data);
         }

         ob_start();
         extract($data);
         include_once $fullViewPath;
         $view = ob_get_clean();
         if(is_null($layout))
              echo $view;
         $layout_full_path = \BASE_VIEW_PATH . "$layout.php";
     }

    //  public static function renderFromTemplate($view,$data =[],$layout='') {
          
    //  }

     public static function renderErrorTemplate($view,$data =[],$layout='') {
         include_once \BASE_VIEW_PATH.'errors'.DIRECTORY_SEPARATOR.$view.'.php';
     }


}