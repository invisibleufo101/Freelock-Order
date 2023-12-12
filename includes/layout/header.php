<?php 
// include("../../conn.php"); 
// initialize session
session_start();

// if the user is not logged in, redirect him to the login page
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] !== True){
    header("location: " . BASE_URL . "login.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="static/css/order.css" />
	<link rel="stylesheet" href="static/css/catmodal.css" />
	<link rel="stylesheet" href="static/css/style.css" />
	<link rel="stylesheet" href="static/css/loadscreen.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

	<title>Freelock Orderform</title>
</head>