<?php
	include('../../conn.php');
	include(INCLUDE_PATH . 'script/func.php');

	$id=$_GET['product'];

	$pname=$_POST['pname'];
	$category=$_POST['category'];
	$price=$_POST['price'];

	$sql="select * from product where productid='$id'";
	$query=$conn->query($sql);
	$row=$query->fetch_array();

	$fileinfo=PATHINFO($_FILES["photo"]["name"]);
	
	if(empty($fileinfo['filename'])){
		$location = $row['photo'];
	}	
	else{
		$newFilename=$fileinfo['filename'] .".". $fileinfo['extension'];
		
		if ($row['categoryid'] == '9'){
			move_uploaded_file($_FILES["photo"]["tmp_name"], "static/upload/product_image/Main-Parts/" . $newFilename);
			$location = "static/upload/product_image/Main-Parts/" . get_setname($pname) . "/" . $newFilename;
		}
		elseif ($row['categoryid'] == '10'){
			move_uploaded_file($_FILES["photo"]["tmp_name"], "static/upload/product_image/Guides/" . $newFilename);
			$location = "static/upload/product_image/Guides/" . $pname . "/" . $newFilename;
		}
		elseif ($row['categoryid'] == '11'){
			move_uploaded_file($_FILES["photo"]["tmp_name"], "static/upload/product_image/Wires/" . $newFilename);
			$location = "static/upload/product_image/Wires/" . $pname . "/" . $newFilename;
		}
		elseif ($row['categoryid'] == '12'){
			move_uploaded_file($_FILES["photo"]["tmp_name"], "static/upload/product_image/Laces/" . $newFilename);
			$location = "static/upload/product_image/Laces/" . $pname . "/" . $newFilename;
		}
		else{
			move_uploaded_file($_FILES["photo"]["tmp_name"], "static/upload/" . $newFilename);
			$location="upload/" . $newFilename;
		}
	}

	$sql="update product set productname='$pname', categoryid='$category', price='$price', photo='$location' where productid='$id'";
	$conn->query($sql);

	// updating the product profile as well (only the product name and category id)
	$stmt = $conn->prepare("update product_price inner join product on product_price.productid = product.productid set product_price.productname=?, product_price.categoryid=? where product.productid = '$id'");
	$stmt->bind_param("si", $pname, $category);

	$stmt->execute();

	header('location:' . BASE_URL . 'admin/product/product.php');
?>