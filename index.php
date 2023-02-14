<?php
echo realpath(__DIR__);

include_once "bootstrap/init.php";

use App\services\router\router;

$router = new router();


?>