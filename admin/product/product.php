<?php 
include("../../conn.php");
include(INCLUDE_PATH . '/layout/header_admin.php'); 
?>
<body>
<?php include(INCLUDE_PATH . '/layout/navbar_admin.php'); ?>
<div class="container">
	<h1 class="page-header text-center">Product Inventory</h1>
	<h1 class="text-left" style="font-size: 15px">Add, edit, or delete Products here</h1>
	<h1 class="text-left" style="font-size: 15px; padding-bottom: 8px;">이 페이지에서 상품을 추가, 편집, 삭제해주시길 바랍니다</h1>
	<div class="row">
		<div class="col-md-12">
			<select id="catList" class="btn btn-default">
			<option value="0">All Categories</option>
			<?php
				$sql="select * from category";
				$catquery=$conn->query($sql);
				while($catrow=$catquery->fetch_array()){
					$catid = isset($_GET['category']) ? $_GET['category'] : 0;
					$selected = ($catid == $catrow['categoryid']) ? "selected" : "";
					echo "<option $selected value=".$catrow['categoryid'].">".$catrow['catname']."</option>";
				}
			?>
			</select>
			<a href="#addproduct" data-toggle="modal" class="pull-right btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Product</a>
		</div>
	</div>
	<div style="margin-top:10px;">
		<table id="inventory" class="table table-bordered display hover">
			<thead>
				<th>Photo</th>
				<th>Product Name</th>
				<th>Price</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php
					$where = "";
					if(isset($_GET['category']))
					{
						$catid=$_GET['category'];
						$where = " where product.categoryid = $catid";
					}
					$sql="select * from product left join category on category.categoryid=product.categoryid $where order by product.categoryid asc, productname asc";
					$query=$conn->query($sql);
					while($row=$query->fetch_array()){
						?>
						<tr>
							<td>
								<a href="<?php if(empty($row['photo'])){echo BASE_URL . "static/upload/noimage.jpg";} else{echo BASE_URL . $row['photo'];} ?>">
								<img src="<?php if(empty($row['photo'])){echo BASE_URL . "static/upload/noimage.jpg";} else{echo BASE_URL . $row['photo'];} ?>" height="30px" width="40px">
								</a>
							</td>
							<td><?php echo $row['productname']; ?></td>
							<td>$<?php echo number_format($row['price'], 2); ?></td>
							<td>
								<a href="#editproduct<?php echo $row['productid']; ?>" data-toggle="modal" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> Edit</a> || <a href="#deleteproduct<?php echo $row['productid']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a>
								<?php include('product_modal.php'); ?>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<div style="padding-bottom: 50px;"></div>
<?php include(ROOT_PATH . '/admin/modal.php'); ?>
<script type="text/javascript">

	$(document).ready(function () {
    	$('#inventory').DataTable({
			// "info": false,
			"lengthChange": false,
			scrollY: '500px',
        	scrollCollapse: true
		});
	});

	$(document).ready(function(){
		$("#catList").on('change', function(){
			if($(this).val() == 0)
			{
				window.location = 'product.php';
			}
			else
			{
				window.location = 'product.php?category='+$(this).val();
			}
		});
	});
</script>
</body>
</html>