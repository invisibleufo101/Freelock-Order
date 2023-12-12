<nav class="navbar navbar-default" style="background:#00a1b1;">
  <style>
    .button {
      width: 100%;
      background: white;
      border: 2px white solid;
      border-radius: 6px;
      cursor: pointer;
    }
  </style>
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="catalogue.php" style="color:white">Catalogue</a></li>
        <li><a href="order.php" style="color:white">Order</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:white">My Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <p style="text-align: center; font-size: 19px;">
                <i class="bi bi-person-square"></i>
                <?php echo " " . $_SESSION['username'];?>
              </p>
            </li>
            <?php 
            if ($_SESSION['role_id'] == 12){
              ?>
              <li role="separator" class="divider"></li>
              <li><a href="<?php echo BASE_URL?>master-admin/catalogue.php">Master Admin Page</a></li>
              <?php
            }

            if ($_SESSION['role_id'] == 12 || $_SESSION['role_id'] == 10){
              ?>
              <li role="separator" class="divider"></li>
              <li><a href="<?php echo BASE_URL?>admin/catalogue.php">Admin Page</a></li>
              <?php
            }
            ?>
            <li role="separator" class="divider"></li>  
            <li><a href="order-history.php">Order History</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="reset-password.php">Reset Password</a></li>
          </ul>
        <li>
        <li><a class="" href="logout.php" style="float:right; color:black;" role="button">Log out</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>