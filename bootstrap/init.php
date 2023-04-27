<?php
session_start();

include_once "bootstrap.php";

include_once BASE_PATH . "vendor\\autoload.php";
use Medoo\Medoo;



$dbh = new Medoo(configs('medoo'));




?>