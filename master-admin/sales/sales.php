<?php 
include("../../conn.php");
include(INCLUDE_PATH . '/layout/header_masteradmin.php'); 
?>
<body>
<?php include(INCLUDE_PATH . '/layout/navbar_masteradmin.php'); ?>
<div class="container">
	<h1 class="page-header text-center">Sales History</h1>
	<table id="sales" class="table table-striped table-bordered">
		<thead>
			<th>Date</th>
			<th>Company</th>
			<th>Customer</th>
			<th>Total Sales</th>
			<th>Details</th>
		</thead>
		<tbody>
			<?php 
				$sql="select * from purchase order by purchaseid desc";
				$query=$conn->query($sql);
				while($row=$query->fetch_array()){
					?>
					<tr>
						<td><?php echo date('M d, Y h:i A', strtotime($row['date_purchase'])) ?></td>
						<td>
							<?php  
							$search=$conn->query("select company from login_info where username='".$row['customer']."'");
							$result=$search->fetch_array();
							echo $result['company'];
							?>
						</td>
						<td><?php echo $row['customer']; ?></td>
						<td class="text-right">$<?php echo number_format($row['total'], 2); ?></td>
						<td><a href="#details<?php echo $row['purchaseid']; ?>" data-toggle="modal" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search"></span> View </a>
							<?php include('sales_modal.php'); ?>
						</td>
					</tr>
					<?php
				}
			?>
		</tbody>
	</table>
</div>
<script>
	$(document).ready(function () {
    	$('#sales').DataTable({
			"order" : [[0, 'desc']]
		});
	});
</script>
</body>
</html>