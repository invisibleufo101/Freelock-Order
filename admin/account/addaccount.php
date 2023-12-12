<?php
    include("../../conn.php");
    include(INCLUDE_PATH . "/script/func.php");

    // Input Fields
    $roleid = 11;
    $company = fill_blanks($_POST['company']);
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $conn->insert_id;

    // checking if duplicate user account exists
    $query = $conn->query("select username, email from login_info");
    while($user_query = $query->fetch_assoc()){
        if ($user_query['email'] == $email){
            ?>
            <script>
                alert("Email is already registered!")
                window.location.href = "<?php echo BASE_URL ?>admin/account/account.php";
            </script>
            <?php
            exit;
        }
        elseif ($user_query['username'] == $username){
            ?>
            <script>
                alert("User is already registered!")
                window.location.href = "<?php echo BASE_URL ?>admin/account/account.php";
            </script>
            <?php
            exit;
        }
    }

    // Insert given info into DB
    $sql = "insert into login_info (role_id, company, email, username, password, date_created) values (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("issss", $roleid, $company, $email, $username, $password);

    $stmt->execute();

    header("location:" . BASE_URL . "admin/account/account.php");
?>
