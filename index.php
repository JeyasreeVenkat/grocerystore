<?php
include "header.php";
require "db.php";
if (isset($_SESSION["name"])) {
    $p_name = $_SESSION["name"];
    if ($p_name == "admin") {
        header("Location:admin.php");
    } else {
        header("Location:user_home.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <div>
        <?php include "nav_i.php"; ?>
    </div>

    <!--body images-->

    <div class="mx-auto">
        <div id="items" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="index.php#item1"><img class="img-fluid w-100" src="images/Vegetables/full_veg.jpg" alt="First slide"></a>
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Fresh vegetables</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <a href="index.php#item2"><img class="img-fluid w-100" src="images/Drinks/full_image.jpg" alt="Second slide"></a>
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Energy Drinks</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <a href="index.php#item3"><img class="img-fluid w-100" src="images/Fruits/full_fruit.jpg" alt="Third slide"></a>
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Sweet Fruits</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <a href="index.php#item4"><img class="img-fluid w-100" src="images/Oils/full_oil.jpg" alt="fourth slide"></a>
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Pure Oils</h3>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#items" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#items" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!--items-->

    <!--vegetables-->

    <div class="container-fluid text-center">
        <h1 id="item1" class="text-dark">Vegetables</h1>
        <div class="row justify-content-center">
            <?php
            $veg = mysqli_query($conn, "SELECT * FROM product WHERE p_category = 'Vegetables'");
            while ($row1 = mysqli_fetch_assoc($veg)) {
                echo '
                <div class="col-md-3 m-3 rounded">
                    <div class="card shadow">
                        <img class="img-fluid" src="images/Vegetables/' . $row1["p_img"] . '" alt="">
                        <div class="card-body bg-light">
                            <h5 class="card-title">' . $row1["p_name"] . '</h5>
                            <div class="card-text">
                                <p>' . $row1["p_qty"] . ' ' . $row1["p_measure"] . '  = ₹' . $row1["p_price"] . '</p> 
                                <p>Availability: ' . $row1["available"] . ' ' . $row1["p_measure"] . '</p>
                            </div>
                            <button  href="#m3" data-backdrop="static" data-toggle="modal" class="btn btn-sm btn-primary">Add to cart</button>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <!--drinks-->

    <div class="container-fluid text-center">
        <h1 id="item2" class="text-dark">Drinks</h1>
        <div class="row justify-content-center">
            <?php
            $drink = mysqli_query($conn, "SELECT * FROM product WHERE p_category = 'Drinks'");
            while ($row2 = mysqli_fetch_assoc($drink)) {
                echo '
                        <div class="col-md-3 m-3 rounded">
                        <div class="card shadow">
                        <img class="img-fluid" src="images/Drinks/' . $row2["p_img"] . '" alt="">
                        <div class="card-body bg-light">
                            <h5 class="card-title">' . $row2["p_name"] . '</h5>
                            <div class="card-text">
                                <p>' . $row2["p_qty"] . ' ' . $row2["p_measure"] . '  = ₹' . $row2["p_price"] . '</p> 
                                <p>Availability: ' . $row2["available"] . ' ' . $row2["p_measure"] . '</p>
                            </div>
                            <button  href="#m3" data-backdrop="static" data-toggle="modal" class="btn btn-sm btn-primary">Add to cart</button>
                        </div>
                    </div>
                        </div>';
            }
            ?>
        </div>
    </div>

    <!--Fruits-->

    <div class="container-fluid text-center">
        <h1 id="item3" class="text-dark">Fruits</h1>
        <div class="row justify-content-center">

            <?php
            $fruit = mysqli_query($conn, "SELECT * FROM product WHERE p_category = 'Fruits'");
            while ($row3 = mysqli_fetch_assoc($fruit)) {
                echo '
                    <div class="col-md-3 m-3 rounded">
                        <div class="card shadow">
                            <img class="img-fluid" src="images/Fruits/' . $row3["p_img"] . '" alt="">
                            <div class="card-body bg-light">
                                <h5 class="card-title">' . $row3["p_name"] . '</h5>
                                <div class="card-text">
                                    <p>' . $row3["p_qty"] . ' ' . $row3["p_measure"] . '  = ₹' . $row3["p_price"] . '</p> 
                                    <p>Availability: ' . $row3["available"] . ' ' . $row3["p_measure"] . '</p>
                                </div>
                                <button  href="#m3" data-backdrop="static" data-toggle="modal" class="btn btn-sm btn-primary">Add to cart</button>
                            </div>
                        </div>
                    </div>';
            }
            ?>

        </div>
    </div>

    <!--oils-->

    <div class="container-fluid text-center">
        <h1 id="item4" class="text-dark">Oils</h1>
        <div class="row justify-content-center">
            <?php
            $oil = mysqli_query($conn, "SELECT * FROM product WHERE p_category = 'Oils'");
            while ($row4 = mysqli_fetch_assoc($oil)) {
                echo '
                <div class="col-md-3 m-3 rounded">
                    <div class="card shadow p-1">
                        <img class="img-fluid" src="images/Oils/' . $row4["p_img"] . '" alt="">
                        <div class="card-body bg-light">
                            <h5 class="card-title">' . $row4["p_name"] . '</h5>
                            <div class="card-text">
                                <p>' . $row4["p_qty"] . ' ' . $row4["p_measure"] . '  = ₹' . $row4["p_price"] . '</p> 
                                <p>Availability: ' . $row4["available"] . ' ' . $row4["p_measure"] . '</p>
                            </div>
                            <button  href="#m3" data-backdrop="static" data-toggle="modal" class="btn btn-sm btn-primary">Add to cart</button>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>


    <?php include "footer.php"; ?>

    <!-- login modal -->

    <div id="m1" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Login Form</h3>
                    <a href="index.php" class="close btn btn-danger">&times;</a>
                </div>
                <?php
                if (isset($_GET["error"])) {
                    echo '<span class="text-center text-danger">' . $_GET["error"] . '</span>';
                }
                ?>
                <div class="modal-body">
                    <!-- login form -->
                    <form action="function_db.php" method="POST">
                        <div class="form-group row">
                            <label for="uname" class="col-sm-3 col-form-label">Username/Email</label>
                            <div class="col-sm-9">
                                <input type="text" name="log_name" class="form-control" value="" id="uname" placeholder="Username" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="log_pass" class="form-control" value="" id="inputPassword" placeholder="Password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <label class="form-check-label"><input name="remember" value="1" type="checkbox">Remember me</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" name="log_submit" class="btn btn-primary">Login</button>
                                <a href="#m2" class="btn btn-primary" data-dismiss="modal" data-toggle="modal">Sign Up</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="index.php" class="btn btn-sm btn-secondary">Cancel</a>
                    <a href="./forgetpassword.php" class="text-danger">Forget Password?</a>
                </div>
            </div>
        </div>
    </div>

    <!--Registeration modal-->

    <div id="m2" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Registeration Form</h3>
                    <a href="index.php" class="close btn btn-danger">&times;</a>
                </div>
                <?php
                if (isset($_GET["re_error"])) {
                    echo '<div class="text-danger text-center">' . $_GET["re_error"] . '</div>';
                }
                ?>
                <div class="modal-body">
                    <!-- Registeration form -->
                    <form action="function_db.php" method="POST">
                        <div class="form-group row">
                            <label for="urname" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="reg_name" class="form-control" id="urname" placeholder="Username" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="reg_mail" class="form-control" id="inputmail" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea name="reg_address" class="form-control" id="address" placeholder="Detailed address" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputphno" class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="tel" name="reg_phno" class="form-control" id="inputphno" placeholder="phone Number" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputrPassword" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="reg_pass" class="form-control" id="inputrPassword" placeholder="Password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" name="reg_submit" class="btn-block btn btn-primary">Sign up</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                    Already have an account? <a href="#m1" class="text-danger" data-dismiss="modal" data-toggle="modal">Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- cart modal-->

    <!-- login modal -->

    <div id="m3" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">You have to login first</h3>
                    <button type="button" class="close btn-danger" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- login form -->
                    <form action="function_db.php" method="POST">

                        <div class="form-group row">
                            <label for="umname" class="col-sm-3 col-form-label">Username/Email</label>
                            <div class="col-sm-9">
                                <input type="text" name="log_name" class="form-control" value="" id="umname" placeholder="Username/Email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputmPassword" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="log_pass" class="form-control" value="" id="inputmPassword" placeholder="Password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <label class="form-check-label"><input name="remember" value="1" type="checkbox"> Remember me</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 offset-sm-3">
                                <button type="submit" name="log_submit" class="btn btn-primary">Login</button>
                                <a href="#m2" class="btn btn-primary" data-dismiss="modal" data-toggle="modal">Sign Up</a>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="./forgetpassword.php" class="text-danger">Forget Password?</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_GET["error"])) {
        echo '
                <script>
                $(document).ready(function(){   
                    $("#m1").modal({backdrop: "static", keyboard: false});
                });
                </script>';
    }
    if (isset($_GET["re_error"])) {
        echo '
                <script>
                $(document).ready(function(){   
                    $("#m2").modal({backdrop: "static", keyboard: false});
                });
                </script>';
    }

    if (isset($_COOKIE['email']) && isset($_COOKIE['pass'])) {
        $email = $_COOKIE['email'];
        $pass = $_COOKIE['pass'];
        echo "<script>
                        document.getElementById('uname').value ='$email';
                        document.getElementById('inputPassword').value='$pass';
                    </script>";
    }
    ?>
</body>

</html>