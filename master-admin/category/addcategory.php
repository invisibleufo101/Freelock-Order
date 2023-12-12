<?php
	include('../../conn.php');

	$sql="insert into category (catname) values (?)";
	$stmt = $conn->prepare($sql);

	$cname=$_POST['cname'];
	
	$stmt->bind_param("s", $cname);
	$stmt->execute();

	header('location:' . BASE_URL . 'master-admin/category/category.php');

?>