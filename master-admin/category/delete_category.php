<?php
	include('../../conn.php');

	$id = $_GET['category'];

	$sql="delete from category where categoryid='$id'";
	$conn->query($sql);

	header('location:' . BASE_URL . 'master-admin/category/category.php');
?>