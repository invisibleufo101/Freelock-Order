<!---- Edit Product Profile Price ---->
<div class="modal fade" id="edit_productprice<?php echo $row['price_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Edit Product for <?php echo $row['company'];?></h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="edit_productprice.php?price_id=<?php echo $row['price_id'];?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-3">
                                <h4>Company: </h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $row['company'];?></h4>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-3">
                                <h4>Product: </h4>
                            </div>
                            <div class="col-md-8">
                                <h4><?php echo $row['productname'];?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3" style="margin-top:10px;">
                                <h4>Price:</h4>
                            </div>
                            <div class="col-md-6" style="padding-top: 10px;">
                                <input type="text" class="form-control" name="edit_price" value="<?php echo $row['price'];?>">
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!---- Delete Product Profile Price ---->
<div class="modal fade" id="delete_productprice<?php echo $row['price_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Product for <?php echo $row['company'];?></h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="delete_productprice.php?price_id=<?php echo $row['price_id'];?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-3">
                                <h4>Company: </h4>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $row['company'];?></h4>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-3">
                                <h4>Product: </h4>
                            </div>
                            <div class="col-md-8">
                                <h4><?php echo $row['productname'];?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3" style="margin-top:10px;">
                                <h4>Price:</h4>
                            </div>
                            <div class="col-md-6" style="padding-top: 10px;">
                                <h4><?php echo $row['price']?></h4>
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