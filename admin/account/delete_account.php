<?php
    include("../../conn.php");

    $userid = $_GET['userid'];

    $sql = "delete from login_info where userid='$userid'";
    $conn->query($sql);

    header("location:" . BASE_URL . "admin/account/account.php");

?>