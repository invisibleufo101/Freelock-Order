<?php
	include('../../conn.php');

	$id = $_GET['product'];

	// delete product from PRODUCT
	$conn->query("delete from product where productid='$id'");

	// delete product from PRODUCT PROFILE
	$sql = "delete from product_price where productid='$id'";
	$conn->query($sql);

	header('location:' . BASE_URL . 'admin/product/product.php');
?>