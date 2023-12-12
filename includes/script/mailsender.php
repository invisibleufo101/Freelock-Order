<?php
include_once("../../conn.php");

//Load dependencies from composer
//If this causes an error, run 'composer install'
require 'PHPMailer/vendor/autoload.php';
require INCLUDE_PATH . '/script/func.php';

/**
 * This example shows how to send via Google's Gmail servers using XOAUTH2 authentication
 * using the league/oauth2-client to provide the OAuth2 token.
 * To use a different OAuth2 library create a wrapper class that implements OAuthTokenProvider and
 * pass that wrapper class to PHPMailer::setOAuth().
*/

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;

//Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

// starting session to figure out what the customer username is
session_start();

// stopping direct link access
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != True){
    header("location: " . BASE_URL . "login.php");
    exit;
}

// query last inserted order from purchase table
$sql = "select * from purchase where customer='".$_SESSION['username']."' order by purchaseid desc limit 1";
$query = $conn->query($sql);
$result = $query->fetch_array();

// extract all the relevent info from the query
$customer = $_SESSION['username'];
$date_purchase = date('Ymd', strtotime($result['date_purchase']));
$total = "$ " . $result['total'];

// initialize table
$csv_info = array();

// query last inserted items from purchase_detail table
$sql="select * from purchase_detail left join product on product.productid=purchase_detail.productid where purchaseid='".$result['purchaseid']."'";
$dquery=$conn->query($sql);

// push items into the csv_info array (2-D array)
while($row = $dquery->fetch_array()){
    $product_info = array();

    $product_info['ProductName'] = $row['productname'];

    if ($row['side'] == ''){
        $product_info['Side'] = '';
    }
    else{
        $product_info['Side'] = $row['side'];
    }

    $product_info['Color'] = $row['color'];

    if ($row['base'] == NULL){
        $product_info['Base'] = '';
    }
    else{
        $product_info['Base'] = $row['base'];
    }

    $product_info['Price'] = "$ " . $row['price'];
    $product_info['Quantity'] = $row['quantity'];
    $product_info['Subtotal'] = "$ " . $row['subtotal'];

    array_push($csv_info, $product_info);
}

$sql = "select company from login_info where username='$customer'";
$companyquery = $conn->query($sql);
$companyresult = $companyquery->fetch_array();
$company = $companyresult['company'];

// create and name the csv file
$filename = ROOT_PATH . "/static/output/" . $date_purchase . "_" . $company . "_" . $customer . "_" . $result['purchaseid'] . ".csv";
$csv_file = fopen($filename, "w");

// inserting category in the first line
$categories = array("Product Name", "Side", "Color", "Base", "Price", "Quantity", "Subtotal");
fputcsv($csv_file, $categories, ",");

// inserting product info lines (2-D array)
foreach($csv_info as $info){
    fputcsv($csv_file, $info, ",");
}

// inserting total 
$total_info = array("", "", "", "", "", "Total", $total);
fputcsv($csv_file, $total_info, ",");

fwrite($csv_file, "\n");

// querying recent shipping info
$sql = "select * from purchase_shipping where purchaseid='".$result['purchaseid']."'";
$ship_query = $conn->query($sql);
$ship_info = $ship_query->fetch_assoc();

// write Consignee Info
fwrite($csv_file, "Consignee \n");

$consignee_cat = array("Attn", "Tel", "Address");
fputcsv($csv_file, $consignee_cat, ",");

$consignee_info = array($ship_info['consignee_attn'], $ship_info['consignee_tel'], $ship_info['consignee_address']);
fputcsv($csv_file, $consignee_info, ",");

fwrite($csv_file, "\n");

// write Notify Info
fwrite($csv_file, "Notify \n");
$notify_cat = array("Attn", "Tel", "Address");
fputcsv($csv_file, $notify_cat, ",");

$notify_info = array($ship_info['notify_attn'], $ship_info['notify_tel'], $ship_info['notify_address']);
fputcsv($csv_file, $notify_info, ",");

fwrite($csv_file, "\n");

// write the rest of Shipping Info
$ship_rest_cat = array("Due Date", "Carrier Type", "Billing Number", "POD", "Customer P/O No.");
fputcsv($csv_file, $ship_rest_cat, ",");

$ship_rest_info = array($ship_info['due_date'], $ship_info['carrier_type'], $ship_info['billing_number'], $ship_info['POD'], $ship_info['customer_po']);
fputcsv($csv_file, $ship_rest_info, ",");

fwrite($csv_file, "\n");

// inserting rest of the info
$others_info = array(
    array("Company: ", $company), 
    array("Customer: ", $customer), 
    array("Date of Purchase: ", date("Y-m-d", strtotime($date_purchase)))
);

foreach($others_info as $info){
    fputcsv($csv_file, $info, ",");
}

fclose($csv_file);

// ---------------------------------------------------------------------------------------------------------------------------------------

//Create a new PHPMailer instance
$mail = new PHPMailer();

// Encoding in Korean
$mail->CharSet = "euc-kr";
$mail->Encoding = "base64";


//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
// $mail->SMTPDebug = SMTP::DEBUG_OFF;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number:
// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
// - 587 for SMTP+STARTTLS
$mail->Port = 465;

//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Set AuthType to use XOAUTH2
$mail->AuthType = 'XOAUTH2';

// Authentication Requirements
$email = 'freelock.export2@gmail.com';
$clientId = '';
$clientSecret = '';
$refreshToken = '';

$mail->oauthUserEmail = "freelock.export2@gmail.com";
$mail->oauthClientId = $clientId;
$mail->oauthClientSecret = $clientSecret;
$mail->oauthRefreshToken = $refreshToken;

//Create a new OAuth2 provider instance
$provider = new Google(
    [
        'clientId' => $clientId,
        'clientSecret' => $clientSecret,
    ]
);

//Pass the OAuth provider instance to PHPMailer
$mail->setOAuth(
    new OAuth(
        [
            'provider' => $provider,
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'refreshToken' => $refreshToken,
            'userName' => $email,
        ]
    )
);

//Set who the message is to be sent from
//For gmail, this generally needs to be the same as the user you logged in as
$mail->setFrom($email, 'Freelock Order');

//Set who the message is to be sent to
// query for getting customer email
$sql = "select * from login_info where username='".$_SESSION['username']."'";
$query = $conn->query($sql);
$result = $query->fetch_array();
$customer_email = $result['email'];

// send mail BOTH to the director and customer
// $mail->addAddress('mccoy@skcni.net', 'Mccoy Ha');
$mail->addAddress('ihasdag@gmail.com');

// email reference for other employees
// $mail->AddCC('sales@skcni.net', iconv("UTF-8", "EUC-KR", "박승원")); <------------------
// $mail->AddCC('export@skcni.net', iconv("UTF-8", "EUC-KR", "김주관")); <------------------
// $mail->AddCC('export2@skcni.net', iconv("UTF-8", "EUC-KR", "하승우")); <------------------

//Set the subject line
$mail->Subject = 'Freelock Order Form Confirmation Email';
// $mail->Subject = 'Freelock Orderform Confirmation Email';

//Replace the plain text body with one created manually
$mail->Body = "Your purchase order is attached to this mail.\nThis is an automated message from https://freelockorder.com";
$mail->AltBody = "Your purchase order is attached to this mail.\nThis is an automated message from https://freelockorder.com";

//Attach file
$mail->addAttachment($filename);

if (!$mail->send()) {
    ?>
    <script>
        window.alert("<?php echo $mail->ErrorInfo; ?>");
        window.alert("Sorry. Something went wrong. Check order history for confirmation.")
    </script>
    <?php
} else {
    ?>
    <script>
        window.alert("Your order has been successfully placed!");
        window.location.href = "<?php echo BASE_URL; ?>order-history.php";
    </script>
    <?php
   exit;
}

// Delete File 
// unlink($filename);
?>