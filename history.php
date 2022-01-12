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
<script>
  $(function() {
    $("#drop").hide();
  });
</script>

<body>
  <?php include "nav_u.php"; ?>
  <div class="text-center container mt-5">
    <table class="table table-bordered table-hover text-center">
      <thead class="thead-dark">
        <tr>
          <th>Bill No</th>
          <th>Items</th>
          <th>Total Price</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $history = mysqli_query($conn, "SELECT * FROM history WHERE user_id = {$_SESSION['id']}");
        $count = mysqli_num_rows($history);
        if ($count > 0) {
          while ($row12 = mysqli_fetch_assoc($history)) {
            $pur_item = unserialize(base64_decode($row12["items"]));
            echo '
                  <tr>
                    <td> ' . $row12["bill_id"] . '</td>
                    <td>' . implode(", ", $pur_item) . '</td>
                    <td>' . $row12["total"] . '</td>
                    <td>' . $row12["date"] . '</td>
                  </tr>     
        ';
          }
        } else {
          echo '<tr>
                  <td colspan="4" class="text-danger h3">No Order Placed!</td>
                <tr>';
        }

        ?>
      </tbody>
    </table>
  </div>
 <div class="footer-copyright bg-primary text-white fixed bottom text-center py-1">Copyright © 2021 Reserved by Grocery Store</div>
</body>

</html>
