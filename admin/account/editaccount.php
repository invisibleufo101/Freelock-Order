<?php
    include("../../conn.php");

    $userid = $_GET['userid'];
    
    $company = $_POST['company'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    
    $sql = "update login_info set company=?, email=?, username=? where userid='$userid'";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sss", $company, $email, $username);
    $stmt->execute();
    $stmt->close();

    header("location:" . BASE_URL . "admin/account/account.php");
?>