<?php

include_once "bootstrap.php";
include_once BASE_PATH . "vendor\\autoload.php";
use Medoo\Medoo;

session_start();

$dbh = new Medoo(configs('medoo'));

?>