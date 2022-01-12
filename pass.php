<?php
include "header.php";
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
?>

<body>
  <nav class="navbar fixed-top navbar-expand-lg bg-primary">
    <a class="navbar-brand text-white" href="index.php">Grocery Store</a>
  </nav>
  <section class="container">
    <div class="mx-auto col-sm-6 p-3 m-5 shadow-lg rounded">
      <form action="function_db.php" method="POST">
        <h2 class="text-center py-3">Forget Password</h2>
        <?php if (isset($_GET["msg"])) { ?>
          <div class="text-danger text-center mb-2"><?php echo $_GET["msg"]; ?></div>
        <?php } ?>
        <div class="form-group row">
          <label for="fmail" class="col-sm-4 col-form-label">New Password</label>
          <div class="col-sm-8">
            <input type="password" name="f_pass" class="form-control" id="fmail" placeholder="Password" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="fcmail" class="col-sm-4 col-form-label">Confirm Password</label>
          <div class="col-sm-8">
            <input type="password" name="fc_pass" class="form-control" id="fcmail" placeholder="Password" required>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-8 offset-sm-4">
            <button type="submit" name="fp_sub" class="btn-block btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </section>
  <div class="fixed-bottom footer-copyright bg-primary text-white text-center py-1">Copyright © 2021 Reserved by Grocery Store</div>
</body>

</html>