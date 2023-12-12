<?php
include("../../conn.php");

$price_id = $_GET['price_id'];

$sql = "delete from product_price where price_id=?";
$stmt = $conn->prepare($sql);

$stmt->bind_param('i', $price_id);

$stmt->execute();

header("location:" . BASE_URL . "admin/product/product-profile.php");
?>