<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli('localhost', 'root', '', 'orderform_db');
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// path to the root path of file : /Applications/XAMPP/xamppfiles/htdocs/order
define('ROOT_PATH', realpath(dirname(__FILE__)));
// path to the includes folder : /Applications/XAMPP/xamppfiles/htdocs/order/includes
define('INCLUDE_PATH', realpath(dirname(__FILE__) . "/includes"));
// URL to the root : http://localhost/order/
define('BASE_URL', "http://localhost/order/");
?>