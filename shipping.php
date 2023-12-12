<?php 
include_once("conn.php");
include_once(INCLUDE_PATH . '/layout/header.php'); 

if(isset($_POST['next'])){
    $_SESSION['order'] = $_POST['order'];
}
else{
    ?>
    <script>
        alert("Please select a product");
        window.location.href = "<?php echo BASE_URL ?>order.php";
    </script>
    <?php
    exit;
}
?>
<style>
    
</style>
<body>
<?php include(INCLUDE_PATH . '/layout/navbar.php'); ?>
<div class="overlay"></div>
<div class="spanner">
    <div class="loader"></div>
    <p style="font-size: 20px;">Processing...</p>
</div>

<div class="container">
    <div class="page-header">
		<img src="static/upload/freelock_logo.png" style="width: 20%; height: 20%;">
		<h1 style="display: inline; padding: 250px;">Shipping</h1>
	</div>
    <form class="row g-3" style="padding: 10px;" method="post" action="<?php echo BASE_URL . "includes/script/purchase.php"; ?>">
        <h2>Consignee</h2>
        <div class="row"></div>
        <div class="col-md-4" id="container">
            <label class="form-label">Attn</label>
            <input type="text" class="form-control" placeholder="Consignee Name" id="con_name" name="shipping[consignee][attn]">
        </div>
        <div class="col-md-3" id="container">
            <label for="con_tel" class="form-label">Tel</label>
            <input type="tel" pattern="(+[0-9]{2,3})[0-9]{3,4}-[0-9]{3,4}-[0-9]{3,4}" placeholder="(+82)010-1234-5678" class="form-control" id="con_tel" name="shipping[consignee][tel]">
        </div>
        <div class="col-md-6" id="container">
            <label for="con_address" class="form-label">Address</label>
            <input type="text" placeholder="Address" class="form-control" id="con_address" name="shipping[consignee][address]">
        </div>
        <div class="row" style="padding-bottom: 50px;"></div>
        <div style="margin:20px 0 20px; border-bottom: 2px solid black;"></div>

        <h2>Notify - Recipient</h2>
        <div class="form-group">
            <div class="checkbox">
                <label> 
                    <input id="duplicate" type="checkbox" onclick="disableBoxes(this);">Same as Consignee
                </label>
            </div>
        </div>
        
        <div class="col-md-4" id="container">
            <label for="noti_name" class="form-label">Attn</label><span role="alert" id="color_err" aria-hidden="true">* Please choose a color</span>
            <input type="text" class="form-control" placeholder="Consignee Name" id="noti_name" name="shipping[notify][attn]">
        </div>
        
        <div class="col-md-3" id="container">
            <label for="noti_tel" class="form-label">Tel</label>
            <input type="tel" pattern="(+[0-9]{2})[0-9]{3}-[0-9]{4}-[0-9]{4}" placeholder="(+82)010-1234-5678" class="form-control" id="noti_tel" name="shipping[notify][tel]">
        </div>
        <div class="col-md-6" id="container">
            <label for="noti_address" class="form-label">Address</label>
            <input type="text" placeholder="Address" class="form-control" id="noti_address" name="shipping[notify][address]">
        </div>
        
        <div class="row" style="padding-bottom: 50px;"></div>
        <div style="margin:20px 0 20px; border-bottom: 2px solid black;"></div>

        <div class="col-md-6" id="container">
            <label for="ready-date" class="form-label"><abbr title="Date when the products are ready to ship out">Ready Date</abbr></label>
            <input type="date" class="form-control" id="ready-date" min="<?php echo date("Y-m-d", strtotime(date("Y-m-d") . ' + 21 days')) ;?>" name="shipping[shipping_date]">
        </div>
        <div class="row"></div>
        <div class="col-md-6" id="container">
            <label for="pod" class="form-label">P.O.D</label>
            <input type="text" class="form-control" placeholder="Port of Delievery" id="pod" name="shipping[pod]">
        </div>
        <div class="col-md-3" id="container">
            <label for="carrier" class="form-label">Carrier Type</label>
            <select id="carrier" class="form-control" name="shipping[carrier_type]" onchange="enableBilling(this)">
                <option value="" selected="selected" disabled="disabled">Choose</option>
                <option name="shipping[carrier_type]" value="Ocean">Ocean</option>
                <option name="shipping[carrier_type]" value="Air">Air</option>
                <option name="shipping[carrier_type]" value="FEDEX">FEDEX</option>
                <option name="shipping[carrier_type]" value="DHL">DHL</option>
            </select>
        </div>
        <div class="col-md-3" id="container">
            <label for="bill-number" class="form-label">Billing Number</label>
            <input type="text" class="form-control" id="bill-number" name="shipping[billing_number]" disabled>
        </div>   
        <div class="col-md-3" id="container">
            <label for="po_number" class="form-label">Customer P/O Number</label>
            <input type="text" class="form-control" id="po_number" name="shipping[po_number]">
        </div>       
        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-7" style="padding: 50px;">

            <!---- Animation ---->
                <div class="wrapper">
                    <button type="submit" class="btn btn-default btn-lg" onclick="return loadScreen();" name="submit" value="submit"><strong>Submit</strong></button>
                </div>
            <!-------------------->
            </div>
        </div>
    </form>
    <script>

        function disableBoxes() {
            const checkbox = document.querySelector("#duplicate");
            if (checkbox.checked){
                // disable boxes
                document.querySelector("#noti_name").setAttribute('disabled', '');
                document.querySelector("#noti_tel").setAttribute('disabled', '');
                document.querySelector("#noti_address").setAttribute('disabled', '');

                // 
                document.querySelector("#noti_name").removeAttribute('required');
                document.querySelector("#noti_tel").removeAttribute('required');
                document.querySelector("#noti_address").removeAttribute('required');

                document.querySelector("#noti_name").value = "";
                document.querySelector("#noti_tel").value = "";
                document.querySelector("#noti_address").value = "";

            }
            else{
                // enable boxes and make them required
                document.querySelector("#noti_name").removeAttribute('disabled');
                document.querySelector("#noti_tel").removeAttribute('disabled');
                document.querySelector("#noti_address").removeAttribute('disabled');

                document.querySelector("#noti_name").setAttribute('required', '');
                document.querySelector("#noti_tel").setAttribute('required', '');
                document.querySelector("#noti_address").setAttribute('required', '');

            }
        }

        function enableBilling() {
            const carrierBox = document.querySelector("#carrier");
            const billBox = document.querySelector("#bill-number");
            if (carrierBox.value == "DHL" || carrierBox.value == "FEDEX"){
                billBox.removeAttribute('disabled');
                billBox.setAttribute('required', '');
            }
            else
            {
                billBox.setAttribute('disabled', '');
                billBox.removeAttribute('required');
                billBox.value = "";
            }
        }
        
        // function for loading screen animation
        // show the hidden elements, start animation
        function loadScreen(){
            var err_count = 0;
            var inputBoxes = document.querySelectorAll("#con_name, #con_tel, #con_address, #noti_name, #noti_tel, #noti_address, #ready-date, #pod, #carrier, #bill-number, #po_number");

            for (let i=0; i < inputBoxes.length; i++){

                if (inputBoxes[i].hasAttribute('disabled')){
                    continue;
                }

                else if (inputBoxes[i].value == ""){
                    inputBoxes[i].classList.add("error");
                    err_count += 1;
                }

                else{
                    inputBoxes[i].classList.remove("error");
                }
            }

            if (err_count > 0){
                alert("Please fill in the form")
                return false;
            }
            
            // document.querySelector("div.spanner").classList.add("show");
            // document.querySelector("div.overlay").classList.add("show");
            $("div.spanner").addClass("show");
            $("div.overlay").addClass("show");
            
            // scroll window height to the center of the loading screen
            const element = document.querySelector("div.spanner");
            const elementRect = element.getBoundingClientRect();
            const absoluteElementTop = elementRect.top + window.pageYOffset;
            const middle = absoluteElementTop - (window.innerHeight / 2);
            element.scrollIntoView(0, middle);

            return true;
        };

    </script>
</body>
</html>