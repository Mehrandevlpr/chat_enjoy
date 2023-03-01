<?php

  function basePath($path) {
      return realpath(\BASE_PATH . DIRECTORY_SEPARATOR . $path);
  }

  function baseUrl($uri) {
       return BASE_URL . $uri;
  }


  function webroute() {
       return include \BASE_PATH . "configs/web.php";
  }

  function configs($key) {
     $config = include \BASE_PATH . "configs/database.php";
     return $config[$key];
}

  function basePathTemplate($uri) {
       return basePath('template'.DIRECTORY_SEPARATOR.$uri);
  }

  function baseUrlTemplate($uri) {
     return baseUrl('template/'.$uri);
  }

