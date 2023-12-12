<?php
	include('../../conn.php');

	$cname=$_POST['cname'];

	$query = $conn->query("select catname from category");
	while($cat_row = $query->fetch_assoc()){
		if ($cat_row['catname'] == $cname){
			?>
			<script>
				alert("Category already exists!");
				window.location.href = "<?php echo BASE_URL ?>admin/category/category.php";
			</script>
			<?php
			exit;
		}
	}

	$sql="insert into category (catname) values (?)";
	$stmt = $conn->prepare($sql);

	$stmt->bind_param("s", $cname);
	$stmt->execute();

	header('location:' . BASE_URL . 'admin/category/category.php');

?>