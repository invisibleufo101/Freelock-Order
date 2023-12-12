<?php 
// include_once("../../conn.php"); 
// initialize session
session_start();

//if the user is not logged in, redirect him to the login page
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != True){
    header("location:" . BASE_URL . "login.php");
    exit;
}
// if the user is logged in but is not admin, redirect him to catalogue.php
else{
	$roleid = 11;
	$sql = "select * from login_info where username = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $username);

	$username = $_SESSION['username'];

	$stmt->execute();
	$result = $stmt->get_result()->fetch_assoc();
	if ($result['role_id'] !== 12){
		?>
		<script>window.alert("You do not have permission on this page")</script>
		<?php
		header("location:" . BASE_URL . "catalogue.php");
        exit;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo BASE_URL?>static/css/catmodal.css">
	<link rel="stylesheet" href="<?php echo BASE_URL?>static/css/style.css">
	<link rel="stylesheet" href="<?php echo BASE_URL?>static/css/loadscreen.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

	<title>Freelock Orderform</title>
</head>