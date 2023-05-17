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
                <h1>Address</h1>
                <div class="profile-info">        
                    <?php
                    $username1 = $_SESSION['username'];
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $id = $_POST["id"];
                        $street = $_POST["street"];
                        $town = $_POST["town"];
                        $post = $_POST["post"];
                    
                        $sql = "UPDATE userdetail SET street='$street', town='$town', post='$post' WHERE id='$id'";
                    
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
                        $street = $row["street"];
                        $town = $row["town"];
                        $post = $row["post"];
                    
                        echo '<form method="post">
                            <table>
                                <tr>
                                    <td><input type="hidden" name="id" value="' . $id . '"></td>
                                </tr>
                                <tr>
                                    <td><label>Street:</label></td>
                                    <td><input type="text" name="street" value="'.$street.'"></td>
                                </tr>
                                <tr>
                                    <td><label>Town:</label></td>
                                    <td><input type="text" name="town" value="'.$town.'"></td>
                                </tr>
                                <tr>
                                    <td><label>Postcode:</label></td>
                                    <td><input type="text" name="post" value="'.$post.'"></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" value="Update address"></td>
                                </tr>
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