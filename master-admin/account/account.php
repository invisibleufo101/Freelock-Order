<!DOCTYPE html>
<html>
<?php 
include("../../conn.php");
include(INCLUDE_PATH . "/layout/header_masteradmin.php");
?>
<body>
<?php include(INCLUDE_PATH . "/layout/navbar_masteradmin.php");?>
<div class="container">
    <h1 class="page-header text-center">Accounts</h1>
    <h1 class="text-left" style="font-size: medium; padding-top: 10px;">Please remember your password because it will not be displayed on this page.</h1>
    <h1 class="text-left" style="font-size: medium">Create a new account <strong style="text-decoration: underline;">IF AND ONLY IF</strong> there's no other way. <strong style="color: red">(SECURITY RISK)</strong></h1>
    <h1 class="text-left" style="font-size: medium">비밀번호는 꼭 기억해주시길 바랍니다.</h1>
    <h1 class="text-left" style="font-size: medium">비밀번호를 찾을 수 없을 시 <strong style="text-decoration: underline;">마지막 수단</strong>으로 새 계정을 만들어주시길 바랍니다. <strong style="color:red;">(보안 취약)</strong></h1>
    <div class="row">
		<div class="col-md-12">
                <select id="company_list" class="btn btn-default">
                    <option value="">Company</option>
                    <?php
                        $sql="select distinct company from login_info where company <> 'MasterAdmin'";
                        $comp_query=$conn->query($sql);
                        while($comp_row=$comp_query->fetch_assoc()){
                            $company_select = isset($_GET['company']) ? $_GET['company'] : 0;
                            $selected = ($company_select == $comp_row['company']) ? "selected" : "";
                            echo "<option $selected value=".$comp_row['company'].">".$comp_row['company']."</option>";
                        }
                    ?>
                </select>
			<a href="#addaccount" data-toggle="modal" class="pull-right btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Account</a>
		</div>
	</div>
    <div style="margin-top:10px;">
		<table id="account" class="table table-bordered table-hover">
            <thead>
                <th>Company</th>
                <th>Email</th>
                <th>Username</th>
                <th>Role</th>
                <th>Date created</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                    $where = "";

                    // only show users with the role_id of "users" (id# = 11)
                    if (isset($_GET['company'])){
                        $company_select = $_GET['company'];
                        $where = " where company = '$company_select'";
                    }

                    $sql = "select * from login_info inner join login_role on login_info.role_id = login_role.id  and userid <> '". $_SESSION['userid'] ."' $where order by userid asc";
                    $query = $conn->query($sql);

                    while($row=$query->fetch_array()){
                        ?>
                        <tr>
                            <td><?php echo $row['company'];?></td>
                            <td>
                                <?php 
                                if (filter_var($row['email'], FILTER_VALIDATE_EMAIL)){
                                    echo $row['email'];
                                }
                                else{
                                    ?>
                                    <?php
                                    echo $row['email'] . " <span style='color:red; font-size: 13px;'>* Invalid</span>";
                                }
                                ?>
                            </td>
                            <td><?php echo $row['username'];?></td>
                            <td><?php echo $row['role_name'];?></td>
                            <td><?php echo $row['date_created'];?></td>
                            <td>
                                <a href="#editaccount<?php echo $row['userid']; ?>" data-toggle="modal" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> Edit</a> || <a href="#deleteaccount<?php echo $row['userid']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                                <?php include("account_modal.php");?>
                            </td>
                        </tr>
                        <?php
                        $iter+=1;
                    }  
                ?>    
        </table>
    </div>
</div>
<?php include(ROOT_PATH . '/master-admin/modal.php'); ?>
<script type="text/javascript">
	$(document).ready(function(){

        $('#account').DataTable({
            "lengthChange": false,
            scrollY: '500px',
            scrollCollapse: true
        });
        
		$("#company_list").on('change', function(){
			if($(this).val() == 0)
			{
				window.location = 'account.php';
			}
			else
			{
				window.location = 'account.php?company='+$(this).val();
			}
		});
	});
</script>
</body>
</html>
