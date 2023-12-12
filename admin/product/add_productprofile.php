<?php
	include('../../conn.php');
	include_once(INCLUDE_PATH . '/script/func.php');

	session_start();
	if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != True){
		header("location: " . BASE_URL . "login.php");
		exit;
	}

    // Insert selected company from add_productprofile.php 
	$sql= "insert into product_price 
		(productid, categoryid, productname, company, price) 
		select productid, categoryid, productname, ?, price from product";
		
	$stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $company);
    $company = $_POST['sel_company'];
	
    $stmt->execute();

	header('location:' . BASE_URL . 'admin/product/product-profile.php');

?>