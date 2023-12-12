<?php
    include("../../conn.php");

    $userid = $_GET['userid'];
    
    $role = $_POST['role'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    
    $sql = "update login_info set role_id=?, company=?, email=?, username=? where userid='$userid'";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssss", $role, $company, $email, $username);
    $stmt->execute();
    $stmt->close();

    header("location:" . BASE_URL . "master-admin/account/account.php");
?>