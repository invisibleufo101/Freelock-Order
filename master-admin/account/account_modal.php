<!-- Edit Account -->
<div class="modal fade" id="editaccount<?php echo $row['userid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Edit Account</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="edit" method="POST" action="editaccount.php?userid=<?php echo $row['userid']; ?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Company:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php echo $row['company']; ?>" name="company" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Email:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php echo $row['email']; ?>" id="email" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:7px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Role:</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" name="role">
                                    <option value="<?php echo $row['role_id']?>"><?php echo $row['role_name']?></option>
                                    <?php
                                    $rsql = "select * from login_role where id != '". $row['role_id']."'";
                                    $role_query = $conn->query($rsql);
                                    while ($rrow = $role_query->fetch_array()){
                                        ?>
                                        <option value="<?php echo $rrow['id'];?>"><?php echo $rrow['role_name'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Username:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php echo $row['username']; ?>" name="username" required>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                <button type="submit" class="btn btn-success" onclick="return validateEmail();"><span class="glyphicon glyphicon-edit"></span> Update</button>
                </form>
            </div>
            <script>
                function validateEmail(email) {
                    var pattern = "^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$";
                    if (!(email.value.match(pattern))){
                        alert("Invalid Email");
                        return false;
                    } 
                    return true;
                }
            </script>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Delete Account -->
<div class="modal fade" id="deleteaccount<?php echo $row['userid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Account</h4></center>
            </div>
            <div class="modal-body">
                <h3 class="text-center"><?php echo $row['username']; ?></h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                <a href="delete_account.php?userid=<?php echo $row['userid']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
