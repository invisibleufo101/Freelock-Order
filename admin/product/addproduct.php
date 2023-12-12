<?php
	include('../../conn.php');
	include_once(INCLUDE_PATH . '/script/func.php');

	$pname=$_POST['pname'];
	$price=$_POST['price'];
	$category=$_POST['category'];

	// checking if input productname is a duplciate
	$query = $conn->query("select productname from product");
	while($query_row = $query->fetch_assoc()){
		if ($query_row['productname'] == $pname){
			?>
			<script>
				alert("Product already exists!");
				window.location.href = "<?php echo BASE_URL ?>admin/product/product.php";
			</script>
			<?php
			exit;
		}
	}

	$sql="insert into product (productname, categoryid, price, photo) values (?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);


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

	$query = $conn->query("select * from product order by productid desc limit 1");
	$new_product = $query->fetch_assoc();

	$sql = "insert into product_price (productid, categoryid, productname, company, price) 
		select distinct ".$new_product['productid'].", ".$new_product['categoryid'].", '".$new_product['productname']."', 
		company , ".$new_product['price']." from product_price";

	$conn->query($sql);

	header('location:' . BASE_URL . 'admin/product/product.php');

?>