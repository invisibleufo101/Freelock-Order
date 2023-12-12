<?php 
include("conn.php");
include_once(INCLUDE_PATH . "/layout/header.php");?>
<body>
<?php 
include_once(INCLUDE_PATH . "/layout/navbar.php"); 
include_once(INCLUDE_PATH ."/script/func.php");
?>

<style>
	.panel-body img{
	    width: 100%;
	    height: 23rem;
	    object-fit: cover;
	}

    .catalogue:hover{
        opacity: 0.3;
    }
</style>
<div class="container">
	<div class="page-header">
		<img src="static/upload/freelock_logo.png" style="width: 20%; height: 20%;">
		<h1 class="text-center" style="display: inline; padding: 250px;"></h1>
	</div>
	<ul class="nav nav-tabs">
		<?php
			$sql="select * from category order by categoryid asc limit 1";
			// $sql = "select * from category order by categoryid asc";
			$fquery=$conn->query($sql);
			$frow=$fquery->fetch_array();
			?>
				<li class="active"><a data-toggle="tab" href="#<?php echo fill_blanks($frow['catname']); ?>"><?php echo $frow['catname'] ?></a></li>
			<?php

			$sql="select * from category order by categoryid asc";
			$nquery=$conn->query($sql);
			$num=$nquery->num_rows-1;

			$sql="select * from category order by categoryid asc limit 1, $num";
			$query=$conn->query($sql);
			while($row=$query->fetch_array()){
				?>
				<li><a data-toggle="tab" href="#<?php echo fill_blanks($row['catname']); ?>"><?php echo $row['catname'] ?></a></li>
				<?php
			}
		?>
	</ul>

	<div class="tab-content">
		<?php
			$sql="select * from category order by categoryid asc limit 1";
			// $sql = "select * from category order by categoryid asc";
			$fquery=$conn->query($sql);
			$ftrow=$fquery->fetch_array();
			?>
				<div id="<?php echo fill_blanks($ftrow['catname'])?>" class="tab-pane fade in active" style="margin-top:20px;">
					<?php
						$sql = "select * from product_price inner join product on product_price.productid = product.productid where product_price.categoryid = '".$ftrow['categoryid']."' and company = '".$_SESSION['company']."'";
						$pfquery=$conn->query($sql);

						// if user's company doesn't have a custom profile, show DEFAULT settings
						if (mysqli_num_rows($pfquery) == 0){
							$sql="select * from product where categoryid='".$ftrow['categoryid']."'";
							$pfquery=$conn->query($sql);
						}
						
						$inc=4;
						while($pfrow=$pfquery->fetch_array()){
							$inc = ($inc == 4) ? 1 : $inc+1; 
							if($inc == 1){
								echo "<div class='row'>";
							}; 
							?>
								<div class="col-md-3">
									<div class="panel panel-default">
										<div class="panel-heading text-center">
											<b><?php echo $pfrow['productname']; ?></b>
										</div>
                                        <!---- edit ---->

										<div class="panel-body">
											<a href="#show-product-<?php echo ($pfrow['productid']);?>" data-toggle="modal">
												<img class="catalogue" src="<?php if(empty($pfrow['photo'])){echo "static/upload/noimage.jpg";} else{echo $pfrow['photo'];} ?>" height="225px;" width="100%">
											</a>
										</div>
										<div class="panel-footer text-center">
											$<?php echo number_format($pfrow['price'], 2); ?>
										</div>
                                        
									</div>
								</div>
                                <?php include("catalogue_modal.php");?>
							<?php
							if($inc == 4) echo "</div>";
						}

						if($inc == 1) echo "<div class='col-md-3'></div><div class='col-md-3'></div><div class='col-md-3'></div></div>"; 
						if($inc == 2) echo "<div class='col-md-3'></div><div class='col-md-3'></div></div>"; 
						if($inc == 3) echo "<div class='col-md-3'></div></div>"; 
	
					?>
		    	</div>
			<?php
			$sql="select * from category order by categoryid asc";
			$tquery=$conn->query($sql);
			$tnum=$tquery->num_rows-1;

			$sql="select * from category order by categoryid asc limit 1, $tnum";
			$cquery=$conn->query($sql);
			while($trow=$cquery->fetch_array()){
				?>
				<div id="<?php echo fill_blanks($trow['catname']); ?>" class="tab-pane fade" style="margin-top:20px;">
					<?php
						$sql = "select * from `product_price` inner join product on product_price.productid = product.productid where product_price.categoryid = '".$trow['categoryid']."' and company = '".$_SESSION['company']."'";
						$pquery=$conn->query($sql);

						// if user's company doesn't have a custom profile, show DEFAULT settings
						if (mysqli_num_rows($pquery) == 0){
							$sql="select * from product where categoryid='".$trow['categoryid']."'";
							$pquery = $conn->query($sql);
						}

						$inc=4;
						while($prow=$pquery->fetch_array()){
							$inc = ($inc == 4) ? 1 : $inc+1; 

							if($inc == 1){
								echo "<div class='row'>";
							}; 
							?>	
								<div class="col-md-3">
									<div class="panel panel-default">
										<div class="panel-heading text-center">
											<b><?php echo $prow['productname']; ?></b>
										</div>

                                        <!---- edit ---->

										<div class="panel-body">
											<a href="#show-product-<?php echo $prow['productid'];?>" data-toggle="modal"><img class="catalogue" src="<?php if($prow['photo']==''){echo "static/upload/noimage.jpg";} else{echo $prow['photo'];} ?>" height="" width=""></a>
                                            
										</div>
										<div class="panel-footer text-center">
											$<?php echo number_format($prow['price'], 2); ?>
										</div>
									</div>
								</div>
                                <?php include("catalogue_modal.php");?>
							<?php
							if($inc == 4) echo "</div>";
						}	
						if($inc == 1) echo "<div class='col-md-3'></div><div class='col-md-3'></div><div class='col-md-3'></div></div>"; 
						if($inc == 2) echo "<div class='col-md-3'></div><div class='col-md-3'></div></div>"; 
						if($inc == 3) echo "<div class='col-md-3'></div></div>"; 

					?>
		    	</div>
				<?php
			}
		?>
	</div>
</div>
</body>
</html>