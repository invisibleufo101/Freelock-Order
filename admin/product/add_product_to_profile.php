<?php
include("../../conn.php");
include(INCLUDE_PATH . "/script/func.php");

session_start();
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != True){
    header("location: " . BASE_URL . "login.php");
    exit;
}

$company = $_POST['add_product_company'];
$productid = $_POST['add_product_product']; // productid
$price = $_POST['add_product_price'];

$query = $conn->query("select productid from product_price where company='$company'");

while($result = $query->fetch_assoc()){
    if ($result['productid'] == $productid){
        ?>
        <script>
        alert("Product already exists in the profile!")
        window.location.href = "<?php echo BASE_URL?>admin/product/product-profile.php";
        </script>
        <?php
        exit;
    }
}

// query product to get productid, categoryid, productname
$sql = "select * from product where productid = '$productid'";
$prod_query = $conn->query($sql);
$prod_info = $prod_query->fetch_assoc();

$catid = $prod_info['categoryid'];
$productname = $prod_info['productname'];

// insert product into selected company profile
$sql = "insert into product_price (productid, categoryid, productname, company, price) values (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

$stmt->bind_param("iissd", $productid, $catid, $productname, $company, $price);

$stmt->execute();
?>
<script>
    alert("Product added!")
    window.location.href = "<?php echo BASE_URL?>admin/product/product-profile.php";
</script>
<?php
exit;
?>