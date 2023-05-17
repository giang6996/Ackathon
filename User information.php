<?php include("check_login_test.php")?>
<?php include("cart_handler.php")?>
<?php include("header.inc") ?>
<?php
require_once("db.php");
?>
<!DOCTYPE html>
<html>

  <head>
    <title>User</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">

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
            <h1>User information</h1>
            <div class="profile-info">
            <img src="styles/images/user_logo.png" alt="Avatar">
            
          <?php
             $username1 = $_SESSION['username'];
             if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $id = $_POST["id"];
              $username = $_POST["username"];
              $fname = $_POST["fname"];
              $lname = $_POST["lname"];
              $email = $_POST["email"];
              $phonenum = $_POST["phonenum"];
          
              $sql = "UPDATE userdetail SET username='$username', fname='$fname', lname='$lname', email='$email', phonenum='$phonenum' WHERE id='$id'";
          
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
              $username = $row["username"];
              $fname = $row["fname"];
              $lname = $row["lname"];
              $email = $row["email"];
              $phonenum = $row["phonenum"];
                echo '<form method="post">
                <table>
                  <tr>
                      <td><input type="hidden" name="id" value="' . $id . '"></td>
                  </tr>
                  <tr>
                    <td><label>Username:</label></td>
                    <td><input type="text" name="username"  value="'.$username.'"></td>
                  </tr>
                  <tr>
                    <td><label>First name:</label></td>
                    <td><input type="text" name="fname"  value="'.$fname.'"></td>
                  </tr>
                  <tr>
                    <td><label>Last name:</label></td>
                    <td><input type="text" name="lname"  value="'.$lname.'"></td>
                  </tr>
                  <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="text" name="email" value="'.$email.'"></td>
                    </td>
                  </tr>
                  <tr>
                    <td><label for="phone">Phone number:</label></td>
                    <td><input type="text" name="phonenum" value="'.$phonenum.'"></td>
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
      </div>
      
      
  </body>
</html>
<?php include("footer.inc") ?>