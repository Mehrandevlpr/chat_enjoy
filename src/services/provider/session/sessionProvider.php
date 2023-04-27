<?php

namespace App\services\provider\session;


class sessionProvider {
    protected $Host;
    protected $Database;
    protected $User;
    protected $Password;
    protected $Link_ID  = 0;
    protected $Query_ID = 0;
    protected $Record   = array();
    protected $Row      = 0;
    protected $Errno    = 0;
    protected $Error    = "";
    protected $Halt_On_Error = "yes";
    protected $Auto_Free = 1;     
    protected $PConnect  = 0;
    
    function _construct(){
       $this->Host = $_SESSION['SQLIP'];
       $this->Database = $_SESSION['SQLDB'];
       $this->User = $_SESSION['SQLUSER'];
       $this->Password = $_SESSION['SQLPASS'];
    }

  }
  ?>