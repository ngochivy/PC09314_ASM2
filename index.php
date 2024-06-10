<?php
session_start();

// if (!isset($_SESSION['user'])) {
//     header('Location: index.php?act=account');
//     exit;
// }

require_once "vendor/autoload.php";

require_once "src/Views/index.php";
