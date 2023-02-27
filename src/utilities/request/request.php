<?php

namespace App\utilities\request;

class request {

   public  $request_uri;
   public  $http_host;
   public  $http_user_agent;
   public  $http_accept_encoding;
   public  $http_accept;
   public  $remote_port;
   public  $request_method;
   public  $document_root;
   public  $query_string;
   public  $server_admin;
   public  $script_name;
   public  $server_software;
   public  $server_porotocol;
   public  $request_scheme;



   public function __construct() {
       //  data clean in url
       $this->request_uri             =           $_SERVER['REQUEST_URI'];
       $this->server_software         =           $_SERVER['SERVER_SOFTWARE'];
       $this->server_porotocol        =           $_SERVER['SERVER_POROTOCOL'] ?? null;
       $this->document_root           =           $_SERVER['DOCUMENT_ROOT'];
       $this->http_accept             =           $_SERVER['HTTP_ACCEPT'];
       $this->query_string            =           $_SERVER['QUERY_STRING'];
       $this->script_name             =           $_SERVER['SCRIPT_NAME'];
       $this->remote_port             =           $_SERVER['REMOTE_PORT'];
       $this->http_host               =           $_SERVER['HTTP_HOST'];
       $this->http_accept_encoding    =           $_SERVER['HTTP_ACCEPT_ENCODING'];
       $this->http_user_agent         =           $_SERVER['HTTP_USER_AGENT'];
       $this->request_method          =           $_SERVER['REQUEST_METHOD'];
       return $this;
   }

   public function getCurrentRoute(){
       return str_replace(\BASE_URL,'',$this->request_uri);
   }

   public function Redirect($url){
     header('Location:'.$url);
     die();
   }
}
