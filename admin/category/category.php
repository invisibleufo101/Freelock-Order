<?php 
include("../../conn.php");
include(INCLUDE_PATH . '/layout/header_admin.php'); 
?>
<body>
<?php include(INCLUDE_PATH . '/layout/navbar_admin.php'); ?>
<div class="container">
	<h1 class="page-header text-center">Categories</h1>
	<h1 class="text-left" style="font-size: 15px">Add, edit, or delete Categories here</h1>
	<h1 class="text-left" style="font-size: 15px;">이 페이지에서 카테고리를 추가, 편집, 삭제해주시길 바랍니다</h1>
	<div class="row">
		<div class="col-md-12">
			<a href="#addcategory" data-toggle="modal" class="pull-right btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Category</a>
		</div>
	</div>
	<div style="margin-top:10px;">
		<table id="cat" class="table table-striped table-bordered">
			<thead>
				<th>Category Name</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php
					$sql="select * from category order by categoryid asc";
					$query=$conn->query($sql);
					while($row=$query->fetch_array()){
						?>
						<tr>
							<td><?php echo $row['catname']; ?></td>
							<td>
								<a href="#editcategory<?php echo $row['categoryid']; ?>" data-toggle="modal" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> Edit</a> || <a href="#deletecategory<?php echo $row['categoryid']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a>
								<?php include('category_modal.php'); ?>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php include(ROOT_PATH . '/admin/modal.php'); ?>
<script>
	$(document).ready(function () {
    	$('#cat').DataTable({
			"lengthChange": false,
			"paging": false,
			"ordering": false,
			"searching": false,
			"info": false
		});
	});
</script>
</body>
</html>