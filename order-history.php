<?php 
include_once("conn.php");
include_once(INCLUDE_PATH . '/layout/header.php'); 
?>
<body>
<?php include_once(INCLUDE_PATH . '/layout/navbar.php'); ?>
<div class="container">
	<h1 class="page-header text-center">Order History</h1>
	<table class="table table-striped table-bordered">
		<thead>
			<th>Date</th>
			<th>Total</th>
			<th>Details</th>
		</thead>
		<tbody>
			<?php 
				// $sql="select * from purchase order by purchaseid desc";
                $sql="select * from purchase where customer='".$_SESSION['username']."' order by date_purchase desc";
				$query=$conn->query($sql);
				while($row=$query->fetch_array()){
					?>
					<tr>
						<td><?php echo date('M d, Y h:i A', strtotime($row['date_purchase'])) ?></td>
						<td class="text-right">$<?php echo number_format($row['total'], 2); ?></td>
						<td><a href="#details<?php echo $row['purchaseid']; ?>" data-toggle="modal" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search"></span> View </a>
							<?php include('order-history-modal.php'); ?>
						</td>
					</tr>
					<?php
				}
			?>
		</tbody>
	</table>
</div>
</body>
</html>