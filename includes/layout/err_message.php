<?php
if (isset($_SESSION['error_msg'])){
    ?>
    <span style="color:red; font-size: 13px;">
        <?php
        echo $_SESSION['error_msg'];
        unset($_SESSION['error_msg']);
        ?>
    </span>
    <?php
}
?>
