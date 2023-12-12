<!-- Add Product -->
<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Add New Product</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" id="form-prod" action="addproduct.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Product Name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Product Name" name="pname" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Category:</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" name="category">
                                    <?php
                                        $sql="select * from category order by categoryid asc";
                                        $query=$conn->query($sql);
                                        while($row=$query->fetch_array()){
                                            ?>
                                            <option value="<?php echo $row['categoryid']; ?>"><?php echo $row['catname']; ?></option>
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
                                <label class="control-label">Price:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Price" name="price" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Photo:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="file" name="photo">
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                </form>
            </div>
            <script>
                $("#addproduct").on("hidden.bs.modal", function() {
                    document.getElementById("form-prod").reset();
                });
            </script>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Add Category -->
<div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Add New Category</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" id="form-cat" action="addcategory.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Category Name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="cname" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                </form>
            </div>
            <script>
                $("#addcategory").on("hidden.bs.modal", function() {
                    document.getElementById("form-cat").reset();
                });
            </script>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Add Account -->
<div class="modal fade" id="addaccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Add New Account</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" id="form-account" action="addaccount.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Company:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="company" class="form-control" name="company" placeholder="Company" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Email:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Username:</label>
                            </div>
                            <div class="col-md-9">  
                                <input type="text" id="username" class="form-control" name="username" placeholder="Username" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Password:</label>
                            </div>
                            <div class="col-md-9">  
                                <div class="input-group-append">
                                    <input type="password" id="assign_password" class="form-control" name="password" placeholder="Password">
                                    <i class="bi bi-eye-slash-fill" id="eye-assign" style="font-size: 20px; margin-left: -30px;"></i>
                                </div>                
                            </div>
                        </div>
                    </div>
                    <script>
                        const password = document.getElementById("assign_password");
                        const togglePass = document.getElementById("eye-assign");
                        // when +account button is clicked
                        $("#addaccount").on('click', function(){;

                            // when icon is clicked
                            togglePass.addEventListener("click", function() {
                                // change password input to text and change icon to open eye
                                const type = password.getAttribute("type") === "password" ? "text" : "password";
                                password.setAttribute("type", type);
                                this.classList.toggle("bi-eye");
                            })
                        });

                        $("#addaccount").on('hidden.bs.modal', function() {

                            //clear all input values in modal form
                            document.getElementById("form-account").reset();

                            //set password input to password and toggle icon back to slash-fill
                            password.setAttribute("type", "password");
                            togglePass.setAttribute("class", "bi bi-eye-slash-fill");
                        });
                    </script>
                </div>
                <!-- shown.bs.modal -->
                <!-- hidden.bs.modal -->
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!---- Add Product Profile ---->
<div class="modal fade" id="add_productprofile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Add Product Profile</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="add_productprofile.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Company:</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" name="sel_company">
                                    <option selected="selected" disabled="disabled">Choose</option>
                                    <?php
                                    // select companies that are already not in product_price
                                    // $sql = "select distinct company from login_info where company <> 'MasterAdmin'";
                                    $sql = "select distinct login_info.company from login_info left outer join product_price on login_info.company = product_price.company where product_price.company is NULL and login_info.company <> 'MasterAdmin'";
                                    $comp_query = $conn->query($sql);
                                    while($comp_row = $comp_query->fetch_assoc()){
                                        //
                                        echo '<option name="sel_company" value='. $comp_row['company'] . '>' . $comp_row['company'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Create</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!---- Delete Product Profile ---->
<div class="modal fade" id="delete_productprofile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Product Profile</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="delete_productprofile.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Company:</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" name="del_company">
                                    <option selected="selected" disabled="disabled">Choose</option>
                                    <?php
                                    // select companies that are already not in product_price
                                    $sql = "select distinct company from product_price where company <> 'MasterAdmin'";
                                    $del_query = $conn->query($sql);
                                    while($del_row = $del_query->fetch_assoc()){
                                        //
                                        echo '<option value="'. $del_row['company'] . '" name="del_company">' . $del_row['company'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Add Product TO Profile -->
<div class="modal fade" id="add_product_to_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Add Product to Profile</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" id="form-account" action="add_product_to_profile.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Company:</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" name="add_product_company" required>
                                    <option disbaled="disabled" selected="selected" value="">Choose</option>
                                    <?php
                                        $comp_options_query = $conn->query("select distinct company from product_price order by price_id asc");
                                        while($comp_options = $comp_options_query->fetch_assoc()){
                                            echo '<option name="add_product_company" value=' . $comp_options['company'] . '>' . $comp_options['company'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Product:</label>
                            </div>
                            <div class="col-md-9">
                            <select class="form-control" name="add_product_product" required>
                                    <option disbaled="disabled" selected="selected">Choose</option>
                                    <?php
                                        $product_query = $conn->query("select * from product order by categoryid asc");
                                        while($product_options = $product_query->fetch_assoc()){
                                            echo '<option name="add_product_product" value=' . $product_options['productid'] . '>' . $product_options['productname'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Price:</label>
                            </div>
                            <div class="col-md-9">  
                                <input type="text" inputmode="decimal" class="form-control" name="add_product_price" placeholder="Price" required>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shown.bs.modal -->
                <!-- hidden.bs.modal -->
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
