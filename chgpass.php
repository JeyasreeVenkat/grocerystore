<?php
session_start();
include "db.php";
if (!isset($_SESSION["name"])) {
  header("Location:index.php");
}
$name = $_SESSION["name"];
$page = ($name == 'admin') ? "admin.php" : "user_home.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
?>

<body>

  <nav class="navbar fixed-top navbar-expand-lg bg-primary">
    <a class="navbar-brand text-white" href="index.php">Grocery Store</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#nav_i" aria-expanded="false">
      <span class="fa fa-bars text-white" aria-hidden="true"></span>
    </button>
    <div id="nav_i" class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="<?php echo $page; ?>"><i class="fa fa-home fa-x mr-1"></i>Home</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center m-5">
      <div class="shadow rounded p-3">
        <form action="function_db.php" method="POST">
          <div class="text-center text-nowrap">
            <h2>Change Password</h2>
            <?php if (isset($_GET["success_chg"])) { ?>
              <span class="text-success mt-1"><?php echo $_GET["success_chg"]; ?></span>
            <?php } ?>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-5 col-form-label">Current Password</label>
            <div class="col-sm-7">
              <input type="password" name="log_pass" class="form-control" id="inputPassword" placeholder="Password" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="chgPassword" class="col-sm-5 col-form-label">New Password</label>
            <div class="col-sm-7">
              <input type="password" name="chg_pass" class="form-control" id="chgPassword" placeholder="Password" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="chgcPassword" class="col-sm-5 col-form-label">Confirm Password</label>
            <div class="col-sm-7">
              <input type="password" name="chgc_pass" class="form-control" id="chgcPassword" placeholder="Password" required>
              <?php if (isset($_GET["error_chg"])) { ?>
                <span class="text-danger mt-1"><?php echo $_GET["error_chg"]; ?></span>
              <?php } ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 offset-sm-5">
              <button type="submit" name="chg_submit" class="btn btn-primary">Change</button>
              <a href="<?php echo $page; ?>" class="ml-2 btn btn-danger">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="fixed-bottom footer-copyright bg-primary text-white text-center py-1">Copyright © 2021 Reserved by Grocery Store</div>
</body>

</html>