<?php include("check_login_test.php")?>
<?php include("cart_handler.php")?>
<?php include("header.inc") ?>
<?php

$host = "feenix-mariadb.swin.edu.au";
$user = "s104175342";
$pwd = "nxr3q423ks";
$dbname = "s104175342_db";
$conn = @mysqli_connect($host, $user, $pwd, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html>

  <head>
    <title>Thông tin thanh toán</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      #payment-info {
        width: 50%;
        margin: 20px auto;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 5px;
        box-shadow: 1px 1px 1px #ccc;
      }
      #payment-info h2 {
        margin-top: 0;
        font-weight: bold;
        color: #007bff;
      }
      #payment-info p {
        margin: 0;
      }
    </style>

  </head>
  <body>
    
    <div class="profile-wrapper">
        <div class="profile-sidebar">
          <ul>
            <li><a href="User information.php">User account</a></li>
            <li><a href="Payment information.php">Payment information</a></li>
            <li><a href="Address.php">Address</a></li>
            <li><a href="Change password.php">Change password</a></li>
          </ul>
        </div>
        <div class="profile-content">
          <div class="profile-header">
            <h1>Credit card</h1>
          </div>
          <div class="profile-info">
          <?php
             $username1 = $_SESSION['username'];
             if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $id = $_POST["id"];
              $cardname = $_POST["cardname"];
              $cardnum = $_POST["cardnum"];
              $cvv = $_POST["cvv"];
              $cardex = $_POST["cardex"];
          
              $sql = "UPDATE userdetail SET cardname='$cardname', cardnum='$cardnum', cvv='$cvv', cardex='$cardex' WHERE id='$id'";
          
              if (mysqli_query($conn, $sql)) {
                  echo "Data has been updated successfully.";
              } else {
                  echo "<p style='margin-top: 10px; color: red;'>Error updating data: </p>" . mysqli_error($conn);
              }
          }

          $sql = "SELECT * FROM userdetail WHERE username = '$username1'";
          $result = @mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              $id = $row['id'];
              $cardname = $row["cardname"];
              $cardnum = $row["cardnum"];
              $cvv = $row["cvv"];
              $cardex = $row["cardex"];
             
              echo'
            <form method="post">
                <table>
                    <tr>
                        <td><input type="hidden" name="id" value="' . $id . '"></td>
                    </tr>
                    <tr>
                    <td><label>Accepted Card:</label></td>
                    <td>
                    <select name="cardname">
                    <option value="Visa" ' . ($cardname == "Visa" ? 'selected' : '') . '>Visa</option>
                    <option value="America Express" ' . ($cardname == "America Express" ? 'selected' : '') . '>America Express</option>
                    <option value="Master Card" ' . ($cardname == "Master Card" ? 'selected' : '') . '>Master Card</option>
                    </select>
                    </td>
                  </tr>
                    <tr>
                        <td><label for="card-number">Card number:</label></td>
                        <td><input type="text" id="card-number" name="cardnum" placeholder="Nhập số thẻ" value="'.$cardnum.'"></td>
                    </tr>
                    <tr>
                        <td><label for="cvv">CVV:</label></td>
                        <td><input type="text" id="cvv" name="cvv" placeholder="Nhập mã CVV" value="'.$cvv.'"></td>
                    </tr>
                    <tr>
                        <td><label for="expiry-date">Expired date:</label></td>
                        <td><input type="text" id="expiry-date" name="cardex" placeholder="MM/YY" value="'.$cardex.'"></td>
                    </tr>
                    <tr><td><input type="submit" value="Update information"></td></tr>
                </table>
            </form>';
            };
            mysqli_close($conn);

            ?>
            
          </div>
        </div>
      </div>
      
      
  </body>
</html>
<?php include("footer.inc") ?>