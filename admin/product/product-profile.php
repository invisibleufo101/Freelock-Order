<?php 
include("../../conn.php");
include(INCLUDE_PATH . '/layout/header_admin.php'); 
include(INCLUDE_PATH . '/script/func.php');
?>
<body>
<?php include(INCLUDE_PATH . '/layout/navbar_admin.php'); ?>
<div class="container">
	<h1 class="page-header text-center">Product Profile</h1>
    <h1 class="text-left" style="font-size: 15px"><u>Add Product :</u>  Add Product to company profile 제품을 고객사 가격 프로필에 추가</h1>
    <h1 class="text-left" style="font-size: 15px"><u>Add Profile :</u>  Add Product Profile to companies that aren't registered 신규 고객사 가격 프로필 추가</h1>
    <h1 class="text-left" style="font-size: 15px"><u>Delete Profile :</u> Delete Registered company profile 현 고객사 가격 프로필 삭제</h1>
    <h1 class="text-left" style="font-size: 15px"><u>Edit :</u> Edit current price 해당 상품 가격 수정</h1>
    <h1 class="text-left" style="font-size: 15px"><u>Delete :</u> Delete current product from company profile 해당 상품을 가격 프로필에서 삭제</h1>
    <div style="padding-bottom: 20px"></div>
	<div class="row">
		<div class="col-md-12">
            <select id="companyList" class="btn btn-default">
                <option value="0">All Companies</option>
                <?php
                    $comp_sql="select distinct company from product_price where company <> 'MasterAdmin'";
                    $comp_query=$conn->query($comp_sql);
                    while($comp_row=$comp_query->fetch_assoc()){
                        $company_select = isset($_GET['company']) ? $_GET['company'] : 0;
                        $selected = ($company_select == $comp_row['company']) ? "selected" : "";
                        echo "<option $selected value=". $comp_row['company'] .">".$comp_row['company']."</option>";
                    }
                ?>
            </select>
            <select id="catList" class="btn btn-default">
                <option value="0">All Categories</option>
                <?php
                    $cat_sql="select * from category order by categoryid asc";
                    $catquery=$conn->query($cat_sql);
                    while($catrow=$catquery->fetch_array()){
                        $catid = isset($_GET['category']) ? $_GET['category'] : 0;
                        $selected = ($catid == $catrow['categoryid']) ? "selected" : "";
                        echo "<option $selected value=".$catrow['categoryid'].">".$catrow['catname']."</option>";
                    }
                ?>
			</select>
            <a href="#delete_productprofile" data-toggle="modal" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete Profile</a>
            <p class="pull-right" style="padding: 8px;"></p>
			<a href="#add_productprofile" data-toggle="modal" class="pull-right btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add Profile</a> 
            <p class="pull-right" style="padding: 8px;"></p>
            <a href="#add_product_to_profile" data-toggle="modal" class="pull-right btn btn-info"><span class="glyphicon glyphicon-plus"></span> Add Product</a> 
		</div>
	</div>
	<div style="margin-top:10px;">
		<table id="product-profile" class="table table-bordered table-hover">
			<thead>
				<th>Company</th>
				<th>Product Name</th>
				<th>Price</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php
                    $comp_where = "";
					$cat_where = "";
					if(isset($_GET['category']))
					{
						$catid=$_GET['category'];
						$cat_where = " and categoryid = $catid";
					}

                    if (isset($_GET['company']))
                    {
                        $company_select=$_GET['company'];
                        $comp_where = " and company = '$company_select'";
                    }

					$sql="select * from product_price where company <> 'MasterAdmin' $comp_where $cat_where order by categoryid asc";
					$query=$conn->query($sql);
					while($row=$query->fetch_array()){
						?>
						<tr>
							<td><?php echo $row['company']?></td>
							<td><?php echo $row['productname']; ?></td>
							<td>$<?php echo number_format($row['price'], 2); ?></td>
							<td>
								<a href="#edit_productprice<?php echo $row['price_id']; ?>" data-toggle="modal" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> Edit</a> || <a href="#delete_productprice<?php echo $row['price_id']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a>
								<?php include('productprofile_modal.php'); ?>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
        <div style="padding-bottom: 50px;"></div>
	</div>
</div>
<?php include(ROOT_PATH . '/admin/modal.php'); ?>
<script type="text/javascript">

    $(document).ready(function () {
    	$('#product-profile').DataTable({
            "lengthChange": false,
        });
	});

	$(document).ready(function(){        
        $('#companyList, #catList').on('change', function() {
            var companyFilter = $('#companyList');
            var categoryFilter = $('#catList');
            
            // when company filter is off
            if (companyFilter.val() == 0 && categoryFilter.val() != 0){
                window.location = 'product-profile.php?category='+categoryFilter.val();
            }

            else if (companyFilter.val() != 0 && categoryFilter.val() == 0){
                window.location = 'product-profile.php?company='+companyFilter.val();
            }

            else if (companyFilter.val() == 0 && categoryFilter.val() == 0){
                window.location = 'product-profile.php';
            }

            else{
                window.location = 'product-profile.php?company='+companyFilter.val()+'&category='+categoryFilter.val();
            }

        });
	});
</script>
</body>
</html>