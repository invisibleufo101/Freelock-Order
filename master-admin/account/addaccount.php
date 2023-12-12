<?php
    include("../../conn.php");
    include(INCLUDE_PATH . "/script/func.php");

    // Insert given info into DB
    $sql = "insert into login_info (role_id, company, email, username, password, date_created) values (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("issss", $roleid, $company, $email, $username, $password);

    // Input Fields
    $roleid = $_POST['role'];
    $company = fill_blanks($_POST['company']);
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $conn->insert_id;

    $stmt->execute();

    header("location:" . BASE_URL . "master-admin/account/account.php");
?>
