<?php
include_once("conn.php");
include_once(INCLUDE_PATH . "/layout/header.php");?>
<body>
<?php
include_once(INCLUDE_PATH . "/layout/navbar.php");
include_once(INCLUDE_PATH . "/script/func.php");

$password_err = $confirm_err = $change_err = "";
// $password = $new_password = $confirm_password = "";

// work on this when we are done with front
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['submit'])){    
        $password = clean_data($_POST['password']);
        $new_password = clean_data($_POST['new_password']);
        $confirm_password = clean_data($_POST['confirm_password']);

        //making query for confirming original password
        $sql = "select * from login_info where username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $username = $_SESSION['username'];
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        // check if user entered a valid original password
        if(!password_verify($password, $result['password'])){
            $password_err = "* Invalid Password";
        }
        else{
            // check if new password is same as confirmed password
            if ($new_password !== $confirm_password){
                $confirm_err = "* Passwords don't match";
            }
            else{
                // check if new password is different from original password
                if ($new_password === $password){
                    $change_err = "* No change detected from previous password";
                }
                else{   
                    //hashing new password
                    $changed_password = password_hash($new_password, PASSWORD_BCRYPT);
                    // if all checks are passed, change password of account
                    $stmt = $conn->prepare("update login_info set password=? where username=?");
                    $stmt->bind_param("ss", $changed_password, $param_username);
                    $param_username = $_SESSION['username'];
                    $stmt->execute();
                    ?>
                    <script>
                        window.alert("Your password has been successfully changed");
                        window.location.replace("index.php");
                    </script>
                    <?php   
                    exit;
                }   
            }
        }
        $stmt->close();
    }
}
?>  

<div class="container">
    <h1 class="page-header text-center">Reset Password</h1>
    <div class="col-md-offset-3">
        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" style="padding-top: 50px;">
            <div class="form-group form-group-md">
                <div class="form-group" style="padding-bottom: 40px;">
                    <h4 class="col-md-3">Enter Password:</h4>
                    <div class="col-md-4">
                        <div class="input-group-append">
                            <?php 
                            if (!empty($password_err)){
                                echo '<input class="style-control " id="password" type="password" placeholder="Password" name="password" value="" style="border-color:red; border-radius: 3px;" required>';
                            }
                            else{
                                echo '<input class="style-control " id="password" type="password" placeholder="Password" name="password" value="" required>';
                            }
                            ?>
                            <span class="input-group-text">
                                <i class="bi bi-eye-slash-fill" id="eye" style="font-size: 20px;"></i>
                            </span>
                        </div>
                        <span style="color:red;">
                        <?php 
                        if (!empty($password_err)){
                            echo $password_err;}
                        ?>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <h4 class="col-md-3">New Password:</h4>
                    <div class="col-md-4">
                        <div class="input-group-append">
                        <?php
                        if (!empty($change_err)){
                            echo '<input class="style-control" id="new-password" type="password" placeholder="New Password" name="new_password" style="border-color:red; border-radius: 3px;" value="" required>';
                        }
                        else if (!empty($confirm_err)){
                            echo '<input class="style-control" id="new-password" type="password" placeholder="New Password" name="new_password" style="border-color:red; border-radius: 3px;" value="" required>';
                        }
                        else{
                            echo '<input class="style-control" id="new-password" type="password" placeholder="New Password" name="new_password" value="" required>';
                        }
                        ?>
                        <span class="input-group-text">
                            <i class="bi bi-eye-slash-fill" id="eye-new" style="font-size: 20px;"></i>
                        </span>
                        </div>
                        <span style="color:red">
                        <?php
                        if (!empty($change_err)){
                            echo $change_err;
                        }
                        ?>
                        <span>
                    </div>
                </div>
                <div class="form-group">
                    <h4 class="col-md-3">Confirm Password:</h4>
                    <div class="col-md-4">
                        <div class="input-group-append">
                        <?php
                        if (!empty($confirm_err)){
                            echo '<input class="style-control" id="confirm-password" type="password" placeholder="Confirm Password" name="confirm_password" style="border-color:red; border-radius: 3px;" value="" required>';
                        }
                        else{
                            echo '<input class="style-control" id="confirm-password" type="password" placeholder="Confirm Password" name="confirm_password" value="" required>';
                        }
                        ?>
                            <span class="input-group-text">
                                <i class="bi bi-eye-slash-fill" id="eye-confirm" style="font-size: 20px;"></i>
                            </span>
                        </div>
                        <span style="color:red">
                            <?php
                            if (!empty($confirm_err)){
                                echo $confirm_err;
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="left: 30%;">
                <input type="submit" class="btn btn-primary" name="submit" value="Reset Password">
            </div>
        </form>
    </div>
</div>
<script>
    // toggle password for original password
    const password = document.getElementById("password");
    const eyeIcon = document.getElementById("eye");

    eyeIcon.addEventListener("click", togglePass);

    function togglePass() {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        this.classList.toggle("bi-eye")
    }

    // toggle password for new password
    const new_password = document.getElementById("new-password");
    const eyeIconNew = document.getElementById("eye-new")

    eyeIconNew.addEventListener("click", togglePassNew);

    function togglePassNew() {
        const type = new_password.getAttribute("type") === "password" ? "text" : "password";
        new_password.setAttribute("type", type);
        this.classList.toggle("bi-eye");
    }

    // toggle password for confirm password
    const confirm_password = document.getElementById("confirm-password");
    const eyeIconConfirm = document.getElementById("eye-confirm")

    eyeIconConfirm.addEventListener("click", togglePassConfirm);

    function togglePassConfirm() {
        const type = confirm_password.getAttribute("type") === "password" ? "text" : "password";
        confirm_password.setAttribute("type", type);
        this.classList.toggle("bi-eye");
    }


</script>
</body>
</html>