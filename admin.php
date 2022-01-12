<?php
session_start();
include "db.php";
if (!isset($_SESSION["name"])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
?>

<body class="mainad">
    <?php include "nav_ad.php"; ?>
    <!--user history-->
    <?php
    $run_his = mysqli_query($conn, "SELECT user.user_id, user.name, user.email, user.number, user.address, history.items, history.total, history.date FROM user INNER JOIN history ON user.user_id = history.user_id");
    $c = 1;
    echo "
                <div class='container-fluid text-nowrap my-5'>
                <h2>Purchase History</h2>
                <div class='table-responsive-sm'>
                
                <table class='table table-bordered table-hover text-center'>
                    <thead class='table-primary'>
                        <tr>
                            <th>S.No</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>User Mail ID</th>
                            <th>User Contact No</th>
                            <th>User Address</th>
                            <th>Product Purchased</th>
                            <th>Total Amount</th>
                            <th>Purchase Date and Time</th>
                        </tr>
                    </thead>
                    <tbody>
                </div>";
    if (mysqli_num_rows($run_his) > 0) {
        while ($row = mysqli_fetch_assoc($run_his)) {
            $pur_item = unserialize(base64_decode($row["items"]));
            echo "
                <tr>
                    <td>$c</td>
                    <td>$row[user_id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[number]</td>
                    <td>$row[address]</td>
                    <td>" . implode(', ', $pur_item) . "</td>
                    <td>$row[total]</td>
                    <td>$row[date]</td>
                </tr>
                ";
            $c++;
        }
    } else {
        echo "<tr><td colspan='9' class='text-danger h3'>No Orders!</td></tr>";
    }

    echo "</tbody>
            </table>";
    ?>
    </div>
</body>

</html>