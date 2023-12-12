<?php
include('../../conn.php');
// check if user logged in
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != True){
// 	header("location: " . BASE_URL . "login.php");
// 	exit;
// }

// if submit button is pressed
if(isset($_POST['submit'])){

	$_SESSION['shipping'] = $_POST['shipping'];	

	// print("<pre>" .print_r($_SESSION, true). "</pre>");

	// pushing total order array into a new array (because [side] input values are always on)
	$total_order = array();
	foreach($_SESSION['order'] as $order){
		if (isset($order['product'])){

			// if side is both,
			// change order side as "left" and add additional order where side is "right"
			if (array_key_exists('side', $order) && $order['side'] == "Both"){

				// left side
				$order['side'] = "Left";

				// right side
				$add_order = array(
					'product' => $order['product'],
					'side' => "Right",
					'color' => $order['color'],
					'base' => $order['base'],
					'quantity' => $order['quantity']
				);

				// push into array
				array_push($total_order, $order);
				array_push($total_order, $add_order);
			}

			else{
				array_push($total_order, $order);
			}
		}
	}

	// inserting query into purchase about customer name (login username) and date of purchase
	$stmt = $conn->prepare("insert into purchase (customer, date_purchase) values (?, NOW())");

	$stmt->bind_param("s", $customer);

	// using login session username as customer name
	$customer = $_SESSION['username'];

	$stmt->execute();
	$pid=$conn->insert_id;
	
	$total=0;
	
	foreach($total_order as $order){
		// selecting query from product 
		$stmt = $conn->prepare("select * from product where productid=?");
		$stmt->bind_param("i", $productid);
		$productid = $order['product'];
		$stmt->execute();
		$row = $stmt->get_result()->fetch_assoc();

		// calculating subtotal of each row and total of the order
		$subtotal = $row['price'] * $order['quantity'];
		$total += $subtotal;
		
		if ($row['categoryid'] == 9){
			$stmt = $conn->prepare("insert into purchase_detail (purchaseid, productid, productname, side, color, base, price, quantity, subtotal) values (?, ?, ?, ?, ?, ?, ?, ? ,?)");
			$stmt->bind_param("iissssdid", $pid, $productid, $productname, $side, $color, $base, $price, $quantity, $subtotal);

			// bind_param inputs
			$pid = $pid;
			$productid = $order['product'];
			$productname = $row['productname'];
			$side = $order['side'];
			$color = $order['color'];
			$base = $order['base'];
			$price = $row['price'];
			$quantity = $order['quantity'];
			$subtotal = $subtotal;
		}

		else {
			// $conn->query("insert into purchase_detail (purchaseid, productid, product_name, color, price, quantity, subtotal) values ('$pid', '$productid', '".$row['productname']."', '".$order['color']."', '".$row['price']."', '".$order['quantity']."', '$subtotal')");
			$stmt = $conn->prepare("insert into purchase_detail (purchaseid, productid, productname, color, price, quantity, subtotal) values (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("iissdid", $pid, $productid, $row['productname'], $order['color'], $row['price'], $order['quantity'], $subtotal);

			// param inputs
			$pid = $pid;
			$productid = $productid;
			$productname = $row['productname'];
			$color = $order['color'];
			$price = $row['price'];
			$quantity = $order['quantity'];
			$subtotal = $subtotal;
		}
		$stmt->execute();
		
	// end of for loop	
	}

	// update purchase table to insert total cost
	$stmt = $conn->prepare("update purchase set total=? where purchaseid=?");
	$stmt->bind_param("di", $total, $pid);
	$pid = $pid;
	$total = $total;
	$stmt->execute();

	// inserting query into purchase_delievery table
	$sql = "insert into purchase_shipping (
			purchaseid,
			due_date,
			carrier_type,
			billing_number,
			POD,
			customer_po,
			consignee_attn,
			consignee_tel,
			consignee_address,
			notify_attn, notify_tel,
			notify_address
		) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

	$stmt = $conn->prepare($sql);

	$stmt->bind_param("ississssssss", $purchaseid, $due_date, $carrier_type, $billing_number, $POD, $customer_po, $consignee_attn, $consignee_tel, $consignee_address, $notify_attn, $notify_tel, $notify_address);
	
	$purchaseid = $pid;
	$due_date = $_SESSION['shipping']['shipping_date'];
	$carrier_type = $_SESSION['shipping']['carrier_type'];
	$billing_number = $_SESSION['shipping']['billing_number'];
	$POD = $_SESSION['shipping']['pod'];
	$customer_po = $_SESSION['shipping']['po_number'];
	
	$consignee_attn = $_SESSION['shipping']['consignee']['attn'];
	$consignee_tel = $_SESSION['shipping']['consignee']['tel'];
	$consignee_address = $_SESSION['shipping']['consignee']['address'];

	$notify_attn = $_SESSION['shipping']['notify']['attn'];
	$notify_tel = $_SESSION['shipping']['notify']['tel'];
	$notify_address = $_SESSION['shipping']['notify']['address'];

	$stmt->execute();

	// direct to mailsender
	header("location:" . BASE_URL . "includes/script/mailsender.php");
	exit;
}
?>