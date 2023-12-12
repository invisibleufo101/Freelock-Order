<?php
include('../../conn.php');

$product_price = $_POST['edit_price'];
$price_id = $_GET['price_id'];

$sql = "update product_price set price=? where price_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('di', $product_price, $price_id);

$stmt->execute();

header("location:" . BASE_URL . "admin/product/product-profile.php");
?>