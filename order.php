<?php 
include_once("conn.php");
include_once(INCLUDE_PATH . '/layout/header.php'); 
?>
<body>
<?php include(INCLUDE_PATH . '/layout/navbar.php'); ?>
<div class="container">
	<div class="page-header">
		<img src="static/upload/freelock_logo.png" style="width: 20%; height: 20%;">
		<h1 style="display: inline; padding: 250px;">Order Form</h1>
	</div>
	<form method="post" action="<?php echo BASE_URL . "shipping.php"?>"> 
		<!------- Main Parts ------->
		<h3 style="color:#00a1b1; float: left;"><strong>Main Parts</strong></h3>
		<table id="main-table" class="table display">
			<thead>
				<tr>
					<th></th>
					<th>Product Name</th>
					<th>Side</th>
					<th>Color</th>
					<th>Base</th>
					<th>Price</th>
					<th>Quantity (PCS)</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql = "select * from product_price where company = '".$_SESSION['company']."' order by categoryid asc, productname asc";
				$query=$conn->query($sql);

				if (mysqli_num_rows($query) == 0){
					$sql="select * from product left join category on category.categoryid=product.categoryid order by product.categoryid asc, productname asc";
					$query = $conn->query($sql);
				}

				while($row=$query->fetch_array()){
					if($row['categoryid'] == 9){ 
						?>
					<tr id="product">
						<td class="text-center"><input type="checkbox" id="<?php echo $row['productid']?>" value="<?php echo $row['productid']; ?>" name="order[product_<?php echo $row['productid'] ?>][product]" style=""></td>
						<td><?php echo $row['productname']; ?></td>
						<td>
							<select class="form-control" name="order[product_<?php echo $row['productid'] ?>][side]">
								<option name="order[product_<?php echo $row['productid'] ?>][side]" value="Right">Right</option>
								<option name="order[product_<?php echo $row['productid'] ?>][side]" value="Left">Left</option>
								<option name="order[product_<?php echo $row['productid'] ?>][side]" value="Both">Both(L&R)</option>
							</select>
						</td>
						<td>
							<select class="form-control" id="product_color" name="order[product_<?php echo $row['productid'] ?>][color]">
								<option selected="selected" disabled="disabled" style="color: grey;" value="">Choose</option>
								<option name="order[product_<?php echo $row['productid'] ?>][color]" value="Black">Black</option>
								<option name="order[product_<?php echo $row['productid'] ?>][color]" value="White">White</option>
								<option name="order[product_<?php echo $row['productid'] ?>][color]" value="Custom">Custom</option>
							</select>
							<span role="alert" id="color_err" aria-hidden="true">* Please choose a color</span>
						</td>
						<td>
							<select class="form-control" id="product_base" name="order[product_<?php echo $row['productid'] ?>][base]">
								<option selected="selected" disabled="disabled" style="color: grey;" value="">Choose</option>
								<option name="order[product_<?php echo $row['productid'] ?>][base]" value="Eyestay">Eyestay</option>
								<option name="order[product_<?php echo $row['productid'] ?>][base]" value="Tongue">Tongue</option>
							</select>
							<span role="alert" id="base_err" aria-hidden="true">* Please choose a base-type</span>
						</td>
						<td class="text-right">$<?php echo number_format($row['price'], 2); ?></td>
						<td>
							<input type="number" class="form-control" id="product_qty" name="order[product_<?php echo $row['productid']?>][quantity]" min=1>
							<span role="alert" id="qty_err" aria-hidden="true">* Please enter quantity</span>
						</td>
					</tr>
					<?php
					}
				}
				?>
			</tbody>
		</table>
		
		<!------- Guides ------->
		<h3 style="color:#00a1b1;"><strong>Guides</strong></h3>
		<div class="scroll-container">
			<table id="guide-table" class="table hover display">
				<thead>
					<th></th>
					<th>Product Name</th>
					<th>Color</th>
					<th>Price</th>
					<th>Quantity (PCS)</th>
				</thead>
				<tbody>
					<?php
					$sql = "select * from product_price where company = '".$_SESSION['company']."' order by categoryid asc, productname asc";
					$query=$conn->query($sql);

					if(mysqli_num_rows($query) == 0){
						$sql="select * from product left join category on category.categoryid=product.categoryid order by product.categoryid asc, productname asc";
						$query=$conn->query($sql);
					}

					while($row=$query->fetch_array()){
						if($row['categoryid'] == 10){
							?>
							<tr id="product">
								<td class="text-center"><input type="checkbox" value="<?php echo $row['productid']; ?>" name="order[product_<?php echo $row['productid'] ?>][product]" style=""></td>
								<td><?php echo $row['productname']; ?></td>
								<td>
									<select class="form-control" id="product_color" name="order[product_<?php echo $row['productid'];?>][color]">
										<option selected="selected" disabled="disabled" style="color: grey;" value="">Choose</option>
										<option name="order[product_<?php echo $row['productid'];?>][color]" value="Black">Black</option>
										<option name="order[product_<?php echo $row['productid'];?>][color]" value="White">White</option>
										<option name="order[product_<?php echo $row['productid'];?>][color]" value="Custom">Custom</option>
									</select>
									<span role="alert" id="color_err" aria-hidden="true">* Please choose a color</span>
								</td>
								<td class="text-right">$<?php echo number_format($row['price'], 2); ?></td>
								<td>
									<input type="number" class="form-control" id="product_qty" name="order[product_<?php echo $row['productid'];?>][quantity]" min=1>
									<span role="alert" id="qty_err" aria-hidden="true">* Please enter quantity</span>
								</td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
		
		<!---- Wires ---->
		<h3 style="color:#00a1b1; float: left;"><strong>Wires</strong></h3>
		<table id="wire-table" class="table hover display">
			<thead>	
				<th></th>
				<th>Product Name</th>
				<th>Color</th>
				<th>Price</th>
				<th>Length (M)</th>
			</thead>
			<tbody>
				<?php
				$sql = "select * from product_price where company = '".$_SESSION['company']."' order by categoryid asc, productname asc";
				$query=$conn->query($sql);
				
				if (mysqli_num_rows($query) == 0){
					$sql="select * from product left join category on category.categoryid=product.categoryid order by product.categoryid asc, productname asc";
					$query=$conn->query($sql);
				}

				while($row=$query->fetch_array()){
					if($row['categoryid'] == 11){
						?>
						<tr id="product">
							<td class="text-center"><input type="checkbox" value="<?php echo $row['productid']; ?>" name="order[product_<?php echo $row['productid'] ?>][product]" style=""></td>
							<td><?php echo $row['productname']; ?></td>
							<td>
								<select class="form-control" id="product_color" name="order[product_<?php echo $row['productid'];?>][color]">
									<option selected="selected" disabled="disabled" style="color: grey;" value="">Choose</option>
									<option name="order[product_<?php echo $row['productid'];?>][color]" value="Black">Black</option>
									<option name="order[product_<?php echo $row['productid'];?>][color]" value="White">White</option>
									<option name="order[product_<?php echo $row['productid'];?>][color]" value="Custom">Custom</option>
								</select>
								<span role="alert" id="color_err" aria-hidden="true">* Please choose a color</span>
							</td>
							<td class="text-right">$<?php echo number_format($row['price'], 2); ?></td>
							<td>
								<input type="number" class="form-control" id="product_qty" name="order[product_<?php echo $row['productid'];?>][quantity]" min=1>
								<span role="alert" id="qty_err" aria-hidden="true">* Please enter quantity</span>
							</td>
						</tr>
						<?php
					}
				}
				?>
			</tbody>
		</table>

		<!---- Laces ---->
		<h3 style="color:#00a1b1; float: left;"><strong>Laces</strong></h3>
		<table id="lace-table" class="table hover display">
			<thead>	
				<th></th>
				<th>Product Name</th>
				<th>Color</th>
				<th>Price</th>
				<th>Length (M)</th>
			</thead>
			<tbody>
				<?php
				$sql = "select * from product_price where company = '".$_SESSION['company']."' order by categoryid asc, productname asc";
				$query=$conn->query($sql);

				if (mysqli_num_rows($query) == 0){
					$sql="select * from product left join category on category.categoryid=product.categoryid order by product.categoryid asc, productname asc";
					$query=$conn->query($sql);
				}

				while($row=$query->fetch_array()){
					if($row['categoryid'] == 12){
						?>
						<tr id="product">
							<td class="text-center"><input type="checkbox" value="<?php echo $row['productid']; ?>" name="order[product_<?php echo $row['productid'] ?>][product]" style=""></td>
							<td><?php echo $row['productname']; ?></td>
							<td>
								<select class="form-control" id="product_color" name="order[product_<?php echo $row['productid'];?>][color]">
									<option selected="selected" disabled="disabled" style="color: grey;" value="">Choose</option>
									<option name="order[product_<?php echo $row['productid'];?>][color]" value="Black">Black</option>
									<option name="order[product_<?php echo $row['productid'];?>][color]" value="White">White</option>
									<option name="order[product_<?php echo $row['productid'];?>][color]" value="Custom">Custom</option>
								</select>
								<span role="alert" id="color_err" aria-hidden="true">* Please choose a color</span>
							</td>
							<td class="text-right">$<?php echo number_format($row['price'], 2); ?></td>
							<td>
								<input type="number" class="form-control" id="product_qty" name="order[product_<?php echo $row['productid'];?>][quantity]" min=1>
								<span role="alert" id="qty_err" aria-hidden="true">* Please enter quantity</span>
							</td>
						</tr>
						<?php
					}
				}
				?>
			</tbody>
		</table>
		
		<!---- Submit Button ---->
		<div class="text-center" style="padding-top: 30px;">
			<button type="submit" class="btn btn-default btn-lg" onclick="return validateForm();" style="background: #00a1b1; border: 2px solid #00a1b1; font-weight: bold; color:white;" value="next" name="next">Next</button>
			<div style="padding: 40px;"></div>
		</div>
	</form>	
</div>
<script type="text/javascript">

	$(document).ready(function () {

		$('#main-table').DataTable({
			"lengthChange": false,
			"paging": false,
			"ordering": false,
			"searching": false,
			"info": false
		});

    	$('#guide-table').DataTable({
            "lengthChange": false,
			"paging": false,
			"ordering": false,
			"searching": false,
			"info": false,
			scrollY: '500px',
        	scrollCollapse: true
        });

		$('#wire-table').DataTable({
			"lengthChange": false,
			"paging": false,
			"ordering": false,
			"searching": false,
			"info": false,
		})

		$('#lace-table').DataTable({
			"lengthChange": false,
			"paging": false,
			"ordering": false,
			"searching": false,
			"info": false,
		})
	});

	// function for validating form
	function validateForm(){

		// checking if the order form is 
		var isChecked = $('input:checkbox').is(':checked');
		if (!isChecked){
			alert("Please select a product");
			return false;
		}

		var err_count = 0; // counter for errors
		var rows = document.querySelectorAll('tr#product'); // selecting all product rows
		const err_list = []; 
		// iterating through product rows for validation
		for (var i=0; i<rows.length; i++){
			
			// user inputs
			var checkbox = rows[i].querySelector('input[type="checkbox"]');
			var color_box = rows[i].querySelector('#product_color');
			var base_box = rows[i].querySelector('#product_base');
			var qty_box = rows[i].querySelector('#product_qty');

			// error messages
			var color_err = rows[i].querySelector('#color_err');
			var base_err = rows[i].querySelector('#base_err');
			var qty_err = rows[i].querySelector('#qty_err');
			
			// if checkbox is selected, check if the input boxes are selected as well.
			if (checkbox.checked){

				// check if input element exists and input value is not empty
				if (color_box !== null && color_box.value === ""){
					color_err.classList.add("visible");
					color_box.classList.add("error");

					err_count += 1;
					if (!err_list.includes(rows[i])){
						err_list.push(rows[i]);
					}
					// err_list.push(rows[i]);
				}
				// when the input area is not empty, return the UI back to normal
				else if (color_box !== null && color_box.value !== "") {
					color_err.classList.remove("visible");
					color_box.classList.remove("error");
				}
				
				// base iput
				if (base_box !== null && base_box.value === ""){
					base_err.classList.add("visible");
					base_box.classList.add("error");

					err_count += 1;
					if (!err_list.includes(rows[i])){
						err_list.push(rows[i]);
					}
					// err_list.push(rows[i]);
				}
				else if (base_box !== null && base_box.value !== ""){
					base_err.classList.remove("visible");
					base_box.classList.remove("error");	
				}

				// quantity input
				if (qty_box !== null && qty_box.value === ""){
					qty_err.classList.add("visible");
					qty_box.classList.add("error");

					err_count += 1;
					if (!err_list.includes(rows[i])){
						err_list.push(rows[i]);
					}
					// err_list.push(rows[i]);
				}
				else if (qty_box !== null && qty_box.value !== ""){
					qty_err.classList.remove("visible");
					qty_box.classList.remove("error");
				}
			}
		};
		// condition switch for checking whether to return true or false
		// returns false if there was any error
		// returns true if there weren't any
		if (err_count !== 0){

			err_list[0].scrollIntoView({block:'end', behavior:'smooth'});
			// alert("Please fill out the form");
			return false;
		}
		
		// show loading screen while order info is being processed
		return true;	
	};
</script>
</body>
</html>

