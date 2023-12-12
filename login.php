<?php
session_start();

if(isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === True){
    header("location: catalogue.php");
    exit;
}
include_once("conn.php");
include_once(INCLUDE_PATH . "/script/func.php");
include_once(INCLUDE_PATH . "/script/validate_login.php");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="static/css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="cover-image">
        <img src="static/upload/login_image.png">
    </div>
    <form id="login" action="" method="post">
        <div class="login-box">
            <h2>Freelock</h2>
            <h2>Order Form</h2>
            <h1>Login</h1>
            <?php include(INCLUDE_PATH . "layout/err_message.php"); ?>
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" id="username" placeholder="ID" name="username" value="<?php echo $username;?>">
            </div>

            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" id="password" placeholder="Password" name="password" value="<?php echo $password;?>">
                <i class="bi bi-eye-slash-fill" id="eye" style="font-size: 20px; color:black;"></i>
            </div>
            <?php 
            if (isset($errors['empty_err'])){
                ?>
                <span style="color:red; font-size: 13px;">
                    <?php echo $errors['empty_err']?>
                </span>
                <?php
            }
            elseif (isset($errors['login_err'])){
                ?>
                <span style="color:red; font-size: 13px;">
                    <?php echo $errors['login_err']; ?>
                </span>
                <?php
            }
            ?>
            <input class="button" type="submit" name="login" value="Sign In">
        </div>
    </form>
    <script>
        // toggle password visibility
        const username = document.getElementById("username");
        const password = document.getElementById("password");
        const toggleButton = document.getElementById("eye");

        toggleButton.addEventListener("click", function() {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            toggleButton.classList.toggle("bi-eye");
        });
    
        //reset login form value after reload
        username.value = "";
        password.value = "";
    </script>
</body>
</html>