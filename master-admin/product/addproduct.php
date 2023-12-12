<?php
	include('../../conn.php');
	include_once(INCLUDE_PATH . '/script/func.php');
	
	// $sql="insert into product (productname, categoryid, price, photo) values ('$pname', '$category', '$price', '$location')";
	$sql="insert into product (productname, categoryid, price, photo) values (?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);

	$pname=$_POST['pname'];
	$price=$_POST['price'];
	$category=$_POST['category'];

	$fileinfo=PATHINFO($_FILES["photo"]["name"]);
		
	if(empty($fileinfo['filename'])){
		$location="";
	}	
	else{
		$newFilename=$fileinfo['filename'] .".". $fileinfo['extension'];
		
		if ($category == 9){
			move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/product_image/Main-Parts/" . $newFilename);
		}
		elseif ($category == 10){
			move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/product_image/Guides/" . $newFilename);
		}
		elseif ($category == 11){
			move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/product_image/Wires/" . $newFilename);
		}
		elseif ($category == 12){
			move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/product_image/Laces/" . $newFilename);
		}
		else{
			move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $newFilename);
		}
		$location="upload/" . $newFilename;
	}

	$stmt->bind_param("sids", $pname, $category, $price, $location);
	$stmt->execute();

	header('location:' . BASE_URL . 'master-admin/product/product.php');

?>