<?php
session_start();
require 'db.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

function mailTo($to, $user, $subject, $body, $success, $error)
{

    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'projectdemo1310@gmail.com';
        $mail->Password = 'project@demo';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('saigrocery@gmail.com', 'onlineshopping');
        $mail->addAddress($to, $user);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        if ($mail->send()) {
            header($success);
        }
    } catch (Exception $e) {

        header($error);
    }
}

//function to show message
function message($url, $message)
{
    header("Location: $url?msg=" . $message);
}

//To validate the login details
if (isset($_POST['log_submit'])) {
    $log_user = mysqli_real_escape_string($conn, $_POST['log_name']);
    $log_pass = base64_encode(mysqli_real_escape_string($conn, $_POST['log_pass']));
    $log_sql = "SELECT * FROM user WHERE (name = '$log_user' OR email = '$log_user') AND (password = '$log_pass')";
    $log_run = mysqli_query($conn, $log_sql);

    if (mysqli_num_rows($log_run) == 1) {
        $user_in = mysqli_fetch_assoc($log_run);
        $_SESSION['name'] = $user_in['name'];
        $_SESSION['id'] = $user_in['user_id'];
        if (($log_user == "admin") or ($log_user == "admin@gmail.com")) {

            if (isset($_POST["remember"]) && ($_POST["remember"] == 1)) {
                setcookie('email', $log_user, time() + (7 * 60 * 60 * 24));
                setcookie('pass', base64_decode($log_pass), time() + (7 * 60 * 60 * 24));
            } else {
                setcookie('email', '');
                setcookie('pass', '');
            }
            header("Location: admin.php");
        } else {

            if (isset($_POST["remember"]) && ($_POST["remember"] == 1)) {
                setcookie('email', $log_user, time() + (7 * 60 * 60 * 24));
                setcookie('pass', base64_decode($log_pass), time() + (7 * 60 * 60 * 24));
            } else {
                setcookie('email', '');
                setcookie('pass', '');
            }
            header("Location: user_home.php");
        }
    } else {
        setcookie('email', '');
        setcookie('pass', '');
        header("Location: index.php?error=Invalid username or password!");
    }
}

//To register the user
if (isset($_POST['reg_submit'])) {
    $reg_user = mysqli_real_escape_string($conn, $_POST['reg_name']);
    $re_mail = mysqli_real_escape_string($conn, $_POST['reg_mail']);
    $re_address = mysqli_real_escape_string($conn, $_POST['reg_address']);
    $reg_pno = mysqli_real_escape_string($conn, $_POST['reg_phno']);
    $re_pass = base64_encode(mysqli_real_escape_string($conn, $_POST['reg_pass']));

    if ($reg_user == "admin") {
        header("Location: index.php?re_error=Invalid username you cannot use the username as admin");
    } else if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE name='$reg_user' OR email='$re_mail'")) > 0) {
        header("Location: index.php?re_error=Username or email id already exists!");
    } else {
        $_SESSION['name'] = $reg_user;
        $_SESSION['mail'] = $re_mail;
        $_SESSION['address'] = $re_address;
        $_SESSION['pno'] = $reg_pno;
        $_SESSION['pass'] = $re_pass;

        $otp = rand(10000, 99999);
        $_SESSION["otp"] = $otp;

        mailTo($re_mail, $reg_user, "Registration Verification!", 'Welcome ' . $reg_user . ' to Online Shopping website.<br><br>OTP verification code is: ' . $otp, "Location:otp.php?msg=Successfully OTP sent!", "Location: index.php?re_error=Unable to send Mail");
    }
}

//resend otp
if (isset($_POST["re_otp"])) {
    mailTo($_SESSION["mail"], $_SESSION["name"], "Registration Verification!", 'Welcome ' . $_SESSION["name"] . ' to Online Shopping website.<br><br>OTP verification code is: ' . $_SESSION["otp"], "Location:otp.php?msg=Successfully OTP Resent!", "Location: index.php?re_error=Unable to send Mail");
}

//check otp
if (isset($_POST["otp_submit"])) {
    if ($_SESSION["otp"] == $_POST["u_otp"]) {
        $run_reg = mysqli_query($conn, "INSERT INTO user(name, email, password, number, address, date) VALUES('{$_SESSION['name']}','{$_SESSION['mail']}','{$_SESSION['pass']}', '{$_SESSION['pno']}','{$_SESSION['address']}',NOW() )");
        if ($run_reg) {
            $forid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE name='{$_SESSION['name']}' OR email='{$_SESSION['mail']}'"));
            $_SESSION["id"] = $forid["user_id"];
            header("Location: user_home.php");
        }
    } else {
        header("Location: otp.php?otp_error=OTP not matched!");
    }
}

// mail sent for forget password
if (isset($_POST["f_sub"])) {
    $_SESSION["fmail"] = $_POST["f_email"];
    $fmail = $_SESSION["fmail"];
    $pass_upd = mysqli_query($conn, "SELECT * FROM user WHERE email = '$fmail'");
    if (mysqli_num_rows($pass_upd) == 1) {
        $fotp = rand(10000, 99999);
        $_SESSION["f_otp"] = $fotp;
        mailTo($fmail, "User", 'Verification!', 'Forget Password verification code is: ' . $fotp, "Location:f_otp.php?msg=OTP Successfully sent!", "Location: index.php?error=Unable to send Mail!");
    } else {
        header("Location: index.php?error=E-mail id not found!");
    }
}

// mail sent for resent otp forget password
if (isset($_POST["re_fotp"])) {
    $fmail = $_SESSION["fmail"];
    $pass_upd = mysqli_query($conn, "SELECT * FROM user WHERE email = '$fmail'");
    if (mysqli_num_rows($pass_upd) == 1) {
        mailTo($fmail, 'User', 'Verification!', 'Forget Password verification code is: ' . $_SESSION["f_otp"], "Location: f_otp.php?msg=OTP Successfully Resent!", "Location: index.php?error=Unable to send Mail!");
    } else {
        header("Location: index.php?error=E-mail id not found!");
    }
}

//checking otp for forget password
if (isset($_POST["fotp_sub"])) {
    if ($_SESSION["f_otp"] == $_POST["fu_otp"]) {
        header("Location: pass.php");
    } else {
        header("Location: f_otp.php?fotp_error=OTP not matched!");
    }
}

//update forget password
if (isset($_POST["fp_sub"])) {
    $fmail = $_SESSION["fmail"];
    $npass = $_POST["f_pass"];
    $cpass = $_POST["fc_pass"];
    if ($npass == $cpass) {
        $pass = base64_encode($npass);
        $pass_upd = mysqli_query($conn, "UPDATE user SET password = '$pass' WHERE (email = '$fmail')");
        if ($pass_upd) {
            header("Location: index.php?error=Login with New password");
        }
    } else {
        header("Location: pass.php?msg=Password Mismatched!");
    }
}

//change user and admin password
if (isset($_POST["chg_submit"])) {
    $id = $_SESSION["id"];
    $oldpass = base64_encode(mysqli_real_escape_string($conn, $_POST["log_pass"]));
    $chkpass = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE user_id = $id"));
    $newpass = mysqli_real_escape_string($conn, $_POST["chg_pass"]);
    $con_pass = mysqli_real_escape_string($conn, $_POST["chgc_pass"]);
    if ($chkpass["password"] == $oldpass) {
        if ($newpass == $con_pass) {
            $pass = base64_encode($newpass);
            $upadpass = mysqli_query($conn, "UPDATE user SET password= '$pass' WHERE user_id = $id");
            if ($upadpass) {
                header("Location: chgpass.php?success_chg=Password Successfully Changed!");
            }
        } else {
            header("Location: chgpass.php?error_chg=Password mismatched for new and current password!");
        }
    } else {
        header("Location: chgpass.php?error_chg=wrong old password!");
    }
}

//add product
if (isset($_POST["add"])) {
    $p_name = mysqli_real_escape_string($conn, $_POST['pname']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $targetDir = "images/$category/";
    if (!empty($_FILES["file"]["name"])) {
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $_SESSION["img"] = $fileName;
                $qty = mysqli_real_escape_string($conn, $_POST['qty']);
                $unit = mysqli_real_escape_string($conn, $_POST['unit']);
                $p_price = mysqli_real_escape_string($conn, $_POST['pprice']);
                $p_avail = mysqli_real_escape_string($conn, $_POST['avail']);

                $add_sql = mysqli_query($conn, "INSERT INTO product(p_name, p_img, p_category, p_qty, p_measure, p_price, available) VALUES('$p_name', '{$_SESSION['img']}', '$category', '$qty', '$unit', '$p_price', '$p_avail')");
                if ($add_sql) {
                    message("edit_product.php", "Product Added Successfully!");
                } else {
                    message("edit_product.php", "Product Adding Failed!");
                }
            }
        } else {
            message("edit_product.php", "Wrong file format!");
        }
    }
}

//Delete the product
if (isset($_POST['d_id'])) {
    $del_id = $_POST['d_id'];
    $del_sql = mysqli_query($conn, "DELETE FROM product WHERE p_id = '$del_id'");
    if ($del_sql) {
        echo "Product Deleted Successfully!";
    }
}

//edit the product
if (isset($_POST['edit'])) {
    $edit = $_SESSION["edit_id"];
    $pe_name = mysqli_real_escape_string($conn, $_POST['pename']);
    $ep_price = mysqli_real_escape_string($conn, $_POST['peprice']);
    $ep_avail = mysqli_real_escape_string($conn, $_POST['eavail']);
    $edit_sql = mysqli_query($conn, "UPDATE product SET p_name = '$pe_name', p_price = '$ep_price', available = '$ep_avail' WHERE p_id = '$edit'");
    if ($edit_sql) {
        message("edit_product.php", "Updated Successfully!");
    }
}

//search the item
if (isset($_POST["search"])) {
    $search = $_POST["search"];
    $search_sql = mysqli_query($conn, "SELECT * FROM product WHERE p_name LIKE '$search%'");
    $outputs = '<div class="container-fluid text-center">
                <h1 class="pt-3">Searched Items</h1>
                <div class="row justify-content-center">';
    if (mysqli_num_rows($search_sql) > 0) {
        while ($row13 = mysqli_fetch_assoc($search_sql)) {
            $outputs .= '
            <div class="col-md-3 m-3 rounded">
            <div class="card shadow">
                <img class="img-fluid" src="images/' . $row13["p_category"] . '/' . $row13["p_img"] . '" alt="">
                <div class="card-body bg-light">
                    <h5 class="card-title">' . $row13["p_name"] . '</h5>
                    <div class="card-text">
                        <p>' . $row13["p_qty"] . ' ' . $row13["p_measure"] . '  = ₹' . $row13["p_price"] . '</p> 
                        <p>Availability: ' . $row13["available"] . ' ' . $row13["p_measure"] . '</p>
                    </div>';
            if (isset($_SESSION["shopping_cart"])) {
                $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
                if (!in_array($row13["p_id"], $item_array_id)) {
                    $outputs .= '<button onclick="addToCarts(' . $row13["p_id"] . ')" class="btn btn-primary">Add to cart</button>';
                } else {
                    $outputs .= '<button class="btn btn-success disabled">Added to Cart</button>';
                }
            } else {
                $outputs .= '<button onclick="addToCarts(' . $row13["p_id"] . ')" class="btn btn-primary">Add to cart</button>';
            }
            $outputs .= '</div>
                        </div>
                        </div>';
        }
    } else {
        $outputs .= '<p class="py-4 text-danger h2 text-center">No Item Found!</p>';
    }
    $outputs .= '</div>
                </div>';
    echo $outputs;
}

//add to cart
if (isset($_POST["cart_id"])) {
    $id = $_POST["cart_id"];
    $row10 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM product WHERE p_id ='$id'"));
    $item_array = array(
        'item_id' => $row10["p_id"],
        'item_name' => $row10["p_name"],
        'item_price' => $row10["p_price"],
        'item_quantity' => $row10["p_qty"],
        'item_measure' => $row10["p_measure"],
    );
    $_SESSION["shopping_cart"][$row10["p_id"]] = $item_array;
}

//checkout
if (isset($_POST["checkout"])) {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        $id = $values["item_id"];
        $row11 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM product WHERE p_id = '$id'"));
        $avail = $row11["available"] - $values["item_quantity"];
        mysqli_query($conn, "UPDATE product SET available = '$avail' WHERE p_id = '$id'");
    }
}

//store to DB
if (isset($_POST["store"])) {
    if (!empty($_SESSION["shopping_cart"])) {
        $total = 0;
        $arr = array();
        $id = $_SESSION["id"];
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            array_push($arr, $values["item_quantity"] . $values["item_measure"] . ' of ' . $values["item_name"] . ' = ' . number_format($values["item_quantity"] * $values["item_price"], 2));
            $total = $total + ($values["item_quantity"] * $values["item_price"]);
        }
        $item = base64_encode(serialize($arr));
        mysqli_query($conn, "INSERT INTO history(user_id, items, total, date) VALUES('{$_SESSION["id"]}', '$item', '$total', NOW())");
    }
}

//remove from the cart
if (isset($_POST["action"]) && $_POST["action"] == "delete") {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        if ($values["item_id"] == $_POST["id"]) {
            echo $_SESSION["shopping_cart"][$keys]["item_name"] . " is removed!";
            unset($_SESSION["shopping_cart"][$keys]);
        }
    }
}

//display the cart
if (isset($_POST["display"])) {
    $output = '<table class="table table-sm text-center table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price of 1 Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>';
    if (!empty($_SESSION["shopping_cart"])) {
        $total = 0;
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            $output .= '
                            <tr>
                                <td>' . $values["item_name"] . '</td>
                                <td><i class="fa fa-plus-square text-primary btn" onclick="plus(' . $values["item_id"] . ')"></i><span id=' . $values["item_id"] . '>' . $values["item_quantity"] . '</span><i onclick="minus(' . $values["item_id"] . ')" class="fa fa-minus-square text-primary btn"></i></a>' . $values["item_measure"] . '</td>
                                <td>₹ ' . $values["item_price"] . '</td>
                                <td>₹ ' . number_format($values["item_quantity"] * $values["item_price"], 2) . '</td>
                                <td><i class="fa fa-trash fa-lg text-primary btn" onclick="removeItem(' . $values["item_id"] . ')"></i></td>
                            </tr>';
            $total = $total + ($values["item_quantity"] * $values["item_price"]);
        }

        $output .= '
                        <tr>
                            <td class="h3" colspan="3">Total</td>
                            <td>₹ ' . number_format($total, 2) . '</td>
                            <td></td>
                        </tr>
                        <script>showButton();</script>
                        ';
    } else {
        $output .= '
                        <tr>
                            <td class="h4 py-5 text-danger" colspan="5">Your Cart is Empty!</td>
                        </tr>
                        <script>hideButton();</script>
                        ';
    }

    $output .= '</tbody>
        </table>';
    echo $output;
}

//add or plus the quantity in cart
if (isset($_POST["plus_id"])) {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        if ($values["item_id"] == $_POST["plus_id"]) {
            $_SESSION["shopping_cart"][$keys]["item_quantity"] += 1;
            echo "1 " . $_SESSION["shopping_cart"][$keys]["item_measure"] . " of " . $_SESSION["shopping_cart"][$keys]["item_name"] . " added!";
        }
    }
}

//minus the quantity in cart
if (isset($_POST["min_id"])) {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        if ($values["item_id"] == $_POST["min_id"]) {
            if ($_SESSION["shopping_cart"][$keys]["item_quantity"] == 1) {
                echo "limit reached can't decreased!";
            } else {
                $_SESSION["shopping_cart"][$keys]["item_quantity"] -= 1;
                echo "1 " . $_SESSION["shopping_cart"][$keys]["item_measure"] . " of " . $_SESSION["shopping_cart"][$keys]["item_name"] . " removed!";
            }
        }
    }
}

//clear all the cart
if (isset($_POST["action"]) && $_POST["action"] == "del") {
    unset($_SESSION["shopping_cart"]);
}

// display all items in homepage
if (isset($_POST["display_item"])) {
    // <!--vegetables-->
    $output = '<div class="container-fluid text-center">
    <h1 id="Vegetables">Vegetables</h1>
    <div class="row justify-content-center">';
    $vegu = mysqli_query($conn, "SELECT * FROM product WHERE p_category = 'Vegetables'");
    while ($row5 = mysqli_fetch_assoc($vegu)) {
        $output .= '
        <div class="col-md-3 m-3 rounded">
        <div class="card shadow">
            <img class="img-fluid" src="images/Vegetables/' . $row5["p_img"] . '" alt="">
            <div class="card-body bg-light">
                <h5 class="card-title">' . $row5["p_name"] . '</h5>
                <div class="card-text">
                    <p>' . $row5["p_qty"] . ' ' . $row5["p_measure"] . '  = ₹' . $row5["p_price"] . '</p> 
                    <p>Availability: ' . $row5["available"] . ' ' . $row5["p_measure"] . '</p>
                </div>';
        if (isset($_SESSION["shopping_cart"])) {
            $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
            if (!in_array($row5["p_id"], $item_array_id)) {
                $output .= '<button onclick="addToCart(' . $row5["p_id"] . ')" class="btn btn-primary">Add to cart</button>';
            } else {
                $output .= '<button class="btn btn-success btn-sm disabled">Added to Cart</button>';
            }
        } else {
            $output .= '<button onclick="addToCart(' . $row5["p_id"] . ')" class="btn btn-primary btn-sm">Add to cart</button>';
        }
        $output .= '</div>
        </div>
        </div>';
    }
    $output .= '</div>
                </div>';

    // <!--drinks-->

    $output .= '
    <div class="container-fluid text-center">
    <h1 id="Drinks">Drinks</h1>
    <div class="row justify-content-center">';
    $drinku = mysqli_query($conn, "SELECT * FROM product WHERE p_category = 'Drinks'");
    while ($row6 = mysqli_fetch_assoc($drinku)) {
        $output .= '
        <div class="col-md-3 m-3 rounded">
        <div class="card shadow">
        <img class="img-fluid" src="images/Drinks/' . $row6["p_img"] . '" alt="">
        <div class="card-body bg-light">
            <h5 class="card-title">' . $row6["p_name"] . '</h5>
            <div class="card-text">
                <p>' . $row6["p_qty"] . ' ' . $row6["p_measure"] . '  = ₹' . $row6["p_price"] . '</p> 
                <p>Availability: ' . $row6["available"] . ' ' . $row6["p_measure"] . '</p>
            </div>';
        if (isset($_SESSION["shopping_cart"])) {
            $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
            if (!in_array($row6["p_id"], $item_array_id)) {
                $output .= '<button onclick="addToCart(' . $row6["p_id"] . ')" class="btn btn-primary btn-sm">Add to cart</button>';
            } else {
                $output .= '<button class="btn btn-success btn-sm disabled">Added to Cart</button>';
            }
        } else {
            $output .= '<button onclick="addToCart(' . $row6["p_id"] . ')" class="btn btn-primary btn-sm">Add to cart</button>';
        }
        $output .= '</div>';

        $output .= '</div>
                    </div>';
    }
    $output .= '</div>
                </div>';

    // <!--Fruits-->

    $output .= '
    <div class="container-fluid text-center">
    <h1 id="Fruits">Fruits</h1>
    <div class="row justify-content-center">';
    $fruitu = mysqli_query($conn, "SELECT * FROM product WHERE p_category = 'Fruits'");
    while ($row7 = mysqli_fetch_assoc($fruitu)) {
        $output .= '
        <div class="col-md-3 m-3 rounded">
        <div class="card shadow">
            <img class="img-fluid" src="images/Fruits/' . $row7["p_img"] . '" alt="">
            <div class="card-body bg-light">
                <h5 class="card-title">' . $row7["p_name"] . '</h5>
                <div class="card-text">
                    <p>' . $row7["p_qty"] . ' ' . $row7["p_measure"] . '  = ₹' . $row7["p_price"] . '</p> 
                    <p>Availability: ' . $row7["available"] . ' ' . $row7["p_measure"] . '</p>
                </div>';

        if (isset($_SESSION["shopping_cart"])) {
            $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
            if (!in_array($row7["p_id"], $item_array_id)) {
                $output .= '<button onclick="addToCart(' . $row7["p_id"] . ')" class="btn btn-primary btn-sm">Add to cart</button>';
            } else {
                $output .= '<button class="btn btn-success btn-sm disabled">Added to Cart</button>';
            }
        } else {
            $output .= '<button onclick="addToCart(' . $row7["p_id"] . ')" class="btn btn-primary btn-sm">Add to cart</button>';
        }
        $output .= '</div>';
        $output .= '</div>
                    </div>';
    }
    $output .= '</div>
                </div>';

    //    <!--oils-->

    $output .= '
    <div class="container-fluid text-center">
    <h1 id="Oils">Oils</h1>
    <div class="row justify-content-center">';
    $oilu = mysqli_query($conn, "SELECT * FROM product WHERE p_category = 'Oils'");
    while ($row8 = mysqli_fetch_assoc($oilu)) {
        $output .= '
        <div class="col-md-3 m-3 rounded">
        <div class="card p-1 shadow">
            <img class="img-fluid" src="images/Oils/' . $row8["p_img"] . '" alt="">
            <div class="card-body bg-light">
                <h5 class="card-title">' . $row8["p_name"] . '</h5>
                <div class="card-text">
                    <p>' . $row8["p_qty"] . ' ' . $row8["p_measure"] . '  = ₹' . $row8["p_price"] . '</p> 
                    <p>Availability: ' . $row8["available"] . ' ' . $row8["p_measure"] . '</p>
                </div>';
        if (isset($_SESSION["shopping_cart"])) {
            $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
            if (!in_array($row8["p_id"], $item_array_id)) {
                $output .= '<button onclick="addToCart(' . $row8["p_id"] . ')" class="btn btn-primary btn-sm">Add to cart</button>';
            } else {
                $output .= '<button class="btn btn-success btn-sm disabled">Added to Cart</button>';
            }
        } else {
            $output .= '<button onclick="addToCart(' . $row8["p_id"] . ')" class="btn btn-primary btn-sm">Add to cart</button>';
        }
        $output .= '</div>';
        $output .= '</div>
                    </div>';
    }
    $output .= '</div>
                </div>';
    echo $output;
}
