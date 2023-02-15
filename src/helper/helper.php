<?php

namespace App\Helper;

// continue with trait

class helper{

     public static function getBasePath($path) {
        return \realpath(\BASE_PATH . $path);
     }

     public static function getBaseUrl($uri) {
          return BASE_URL . $uri;
     }


     public static function getWebroute() {
          return include \BASE_PATH . "config_route/web.php";
     }

     public static function getBaseTemplate($path) {
          return self::getBasePath("template\\".$path);
     }
}