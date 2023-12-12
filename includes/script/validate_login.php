<?php
include_once("../../conn.php");
include_once(INCLUDE_PATH . "script/func.php");

$errors = [];

if (isset($_POST['login'])){
    // clean out username and password
    $username = clean_data($_POST['username']);
    $password = clean_data($_POST['password']);
    
    if(checkEmptyLogin($username, $password)){
        $errors['empty_err'] = "* Please enter your ID and/or Password";
    }
    else{
        $sql = "select * from login_info where username=?";
    
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("s", $param_username);
            $param_username = $username;
    
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
    
            if ($result['username'] == $username && password_verify($password, $result['password'])){
                
                session_start();
                $_SESSION['isLogin'] = True;
                $_SESSION['username'] = $result['username'];
                $_SESSION['userid'] = $result['userid'];
                $_SESSION['company'] = $result['company'];
                ?>
                    <script>window.alert($result['role_id'])</script>
                    <?php
    
                // if account user-role is admin, redirect to the admin page
                if ($result['role_id'] == "10"){
                    $_SESSION['role_id'] = 10;
                    header("location:" . BASE_URL . "admin/catalogue.php");
                    exit;
                }
                elseif ($result['role_id'] == "12"){
                    $_SESSION['role_id'] = 12;
                    header("location:" . BASE_URL . "master-admin/catalogue.php");
                    exit;
                }
                // if not, redirect to the user page
                else{
                    $_SESSION['role_id'] = 11;
                    header("location:" . BASE_URL . "catalogue.php");
                    exit;
                }
    
            }
            else{
        
                $errors['login_err'] = "* Invalid ID and/or Password";
                
            }
        }
        else{
            
            $errors['login_err'] = "* Invalid ID and/or Password";
            
        }
    }
}

?>