<?php

  function basePath($path) {
      return realpath(\BASE_PATH . DIRECTORY_SEPARATOR . $path);
  }

  function baseUrl($uri) {
       return BASE_URL . $uri;
  }


  function webroute() {
       return include \BASE_PATH . "config_route/web.php";
  }

  function basePathTemplate($uri) {
       return basePath('template'.DIRECTORY_SEPARATOR.$uri);
  }

  function baseUrlTemplate($uri) {
     return baseUrl('template'.DIRECTORY_SEPARATOR.$uri);
  }

