<?php
// returns true if login is empty (username, password, or both)
function checkEmptyLogin($username, $password){
    $result;
    if (empty($username) || empty($password)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function checkLogin($username, $password, $db){
    
    $result;
    $sql = "select * from login_info where username=?";
    mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        $result = false;
    }
    mysqli_stmt_bind_param("stmt", "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_fetch_assoc($result)){
        if (password_verify($password, $result['password'])){
            $result = true;
        }
        else {
            $result = false;
        }
    }
    else{
        $result = false;
    }
    mysqli_stmt_close($stmt);
    return $result;
}

function clean_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// decodes bin2hex strings
function decode($string){
    return hex2bin($string);
}

// fills the blanks with hyphens (prevents html errors)
function fill_blanks($string){
    $string = str_replace(" ", "-", $string);
    return $string;
}

// gets the set name of main parts (e.g. DPA, MPK, DPZ)
function get_setname($name){
    $name = explode(" ", $name)[0];
    return $name;
}

function escape_blanks($string){
    $result = "";
    $words = explode(" ", $string);
    for($i=0; $i<count($words); $i++){
        if ($i == count($words) - 1){
            $words[$i] = $words[$i];
        }
        else{
            $words[$i] .= "\  ";
        }
        $result .= $words[$i];
    }
    return $result;
}

?>