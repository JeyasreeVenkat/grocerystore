<?php
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
    <button class="navbar-toggler" data-toggle="collapse" data-target="#nav_i" aria-expanded="false">
      <span class="fa fa-bars text-white" aria-hidden="true"></span>
    </button>
    <div id="nav_i" class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="index.php"><i class="fa fa-home fa-x mr-1"></i>Home</a>
        </li>
      </ul>
    </div>
  </nav>

  <section class="container">
    <div class="mx-auto col-md-6 m-5">
      <div class="p-3 shadow-lg rounded">
        <form action=" function_db.php" method="POST">
          <h2 class="text-center py-3">Forget Password</h2>
          <div class="form-group row">
            <label for="funame" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" name="f_email" class="form-control" id="funame" placeholder="Email" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
              <button type="submit" name="f_sub" class="btn btn-block btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <div class="fixed-bottom footer-copyright bg-primary text-white text-center py-1">Copyright © 2021 Reserved by Grocery Store</div>
</body>

</html>