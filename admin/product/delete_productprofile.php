<?php
include("../../conn.php");

$sql = "delete from product_price where company=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $company);

$company = $_POST['del_company'];

$stmt->execute();

header("location:" . BASE_URL . "admin/product/product-profile.php");
?>