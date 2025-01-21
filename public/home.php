<?php
$_SESSION = [];

include_once "../utils/autoloader.php";
require_once './asset/partials/header.php';

$display = new DisplayManager();

echo $display->displayHome();

require_once './asset/partials/footer.php'
?>