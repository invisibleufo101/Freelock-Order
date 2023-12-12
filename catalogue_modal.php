<!---- First Tab Content ---->
<style>
    a:hover, a:focus {
        color:black;
        text-decoration: none;
    }   

    .showcase {
        width: 100%;
        height: auto;
    }
</style>
<div class="modal fade" id="show-product-<?php echo $pfrow['productid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="carousel-showcase-<?php echo $pfrow['productid'];?>" class="carousel slide">
                <div class="carousel-inner" role="listbox">
                <?php 
                // dynamically loading images to the modal carousel(image slide)
                $sql = "select * from category where categoryid='".$pfrow['categoryid']."'";
                $query = $conn->query($sql);
                $result = $query->fetch_array();
                $catname = $result['catname'];

                // selecting images in the productid folder (static/upload/product_image/category_name/productid/productid_image.jpg); 
                $img_dir = "static/upload/product_image/" . fill_blanks($catname) . "/" . get_setname($pfrow['productname']) . "/*";
                $images = glob($img_dir);

                if (empty($images)){
                    ?>
                    <div class="item active">
                        <img class="showcase" src="static/upload/noimage.jpg">
                        <div class="carousel-caption">
                            
                        </div>
                    </div>
                    <?php
                }
                else{
                    for ($i=0; $i<count($images); $i++){
                        if ($i == 0){
                            ?>
                            <div class="item active">
                                <img class="showcase" src="<?php echo $images[$i]?>">
                                <div class="carousel-caption">
                                    
                                </div>
                            </div>
                            <?php
                        }
                        else{
                            ?>
                            <div class="item">
                                <img class="showcase" src="<?php echo $images[$i]; ?>">
                                <div class="carousel-caption">
                                    
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>        
                </div>

                <?php
                if (count($images) > 1){
                    echo '<a class="carousel-control-prev" href="#carousel-showcase-'.$pfrow['productid'].'" role="button" data-slide="prev">';
                    echo '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="font-size: 50px;"></span>';
                    echo '<span class="sr-only">Previous</span>';
                    echo '</a>';

                    echo '<a class="carousel-control-next" href="#carousel-showcase-'.$pfrow['productid'].'" role="button" data-slide="next">';
                    echo '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="font-size: 50px;"></span>';
                    echo '<span class="sr-only">Next</span>';
                    echo '</a>';
                }
                ?>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!---- Other Tab Contents ---->
<div class="modal fade" id="show-product-<?php echo $prow['productid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="carousel-showcase-<?php echo $prow['productid'];?>" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php
                    $sql = "select * from category where categoryid='".$prow['categoryid']."'";
                    $query = $conn->query($sql);
                    $result = $query->fetch_array();
                    $catname = $result['catname'];

                    $img_dir = "static/upload/product_image/" . fill_blanks($catname) . "/" . $prow['productname'] . "/*";
                    $images = glob($img_dir);

                    if (empty($images)){
                        ?>
                        <div class="item active">
                            <img class="showcase" src="static/upload/noimage.jpg">
                            <div class="carousel-caption">
                                
                            </div>
                        </div>
                        <?php
                    }
                    else{
                        for ($i=0; $i<count($images); $i++){
                            if ($i == 0){
                                ?>
                                <div class="item active">
                                    <img class="showcase" src="<?php echo $images[$i] ?>">
                                    <div class="carousel-caption">
                                        
                                    </div>
                                </div>
                                <?php
                            }
                            else{
                                ?>
                                <div class="item">
                                    <img class="showcase" src="<?php echo $images[$i] ?>">
                                    <div class="carousel-caption">
                                        
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                
                <!--- Remove Prev/Next buttons if no product image is found OR there is only one image --->
                <?php
                if (count($images) > 1){
                    echo '<a class="carousel-control-prev" href="#carousel-showcase-'.$prow['productid'].'" role="button" data-slide="prev">';
                    echo '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="font-size: 50px;"></span>';
                    echo '<span class="sr-only">Previous</span>';
                    echo '</a>';

                    echo '<a class="carousel-control-next" href="#carousel-showcase-'.$prow['productid'].'" role="button" data-slide="next">';
                    echo '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="font-size: 50px;"></span>';
                    echo '<span class="sr-only">Next</span>';
                    echo '</a>';
                }
                ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
