<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'kyauserver786');
define('DB_NAME', 'kyau_store_management_system');
 
/* Connection with Database */
$pdo_conn = new PDO("mysql:host=" .DB_SERVER. ";dbname=" .DB_NAME, DB_USERNAME,DB_PASSWORD);
session_start();
?>

