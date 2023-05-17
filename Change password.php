<?php include("check_login_test.php")?>
<?php include("cart_handler.php")?>
<?php include("header.inc") ?>
<?php

require_once("db.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
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
                <h1 style="margin-bottom: 10px;">Change Password</h1>
                <hr>
                <div class="profile-info">
                    <?php
                    $username = "";

                    if (isset($_SESSION["username"])) {
                        $username = $_SESSION["username"];
                    }
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $id = $_POST["id"];
                        $currentPassword = $_POST["current_password"];
                        $newPassword = $_POST["new_password"];
                        $confirmPassword = $_POST["confirm_password"];
                        
                        $sql = "SELECT pass FROM userdetail WHERE id = '$id' AND username = '$username'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $storedPassword = $row["pass"];
                    
                        if ($currentPassword !== $storedPassword) {
                            echo "<p style='margin-top: 10px; color: red;'>Current password is incorrect.</p>";
                        } elseif ($newPassword !== $confirmPassword) {
                            echo "<p style='margin-top: 10px; color: red;'>New password and confirm password do not match.</p>";
                        } else {
                            $sql = "UPDATE userdetail SET pass = '$newPassword' WHERE id = '$id' AND username = '$username'";
                    
                            if (mysqli_query($conn, $sql)) {
                                echo "Password has been updated successfully.";
                            } else {
                                echo "<p style='margin-top: 10px; color: red;'>Error updating password: </p>" . mysqli_error($conn);
                            }
                        }
                    }
                    
                    $sql = "SELECT * FROM userdetail WHERE username = '$username'";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];

                        echo '<form method="post">
                            <table>
                                <tr>
                                    <td><input type="hidden" name="id" value="' . $id . '"></td>
                                </tr>
                                <tr>
                                    <td><label>Current password:</label></td>
                                    <td><input type="password" name="current_password" required></td>
                                </tr>
                                <tr>
                                    <td><label>New password:</label></td>
                                    <td><input type="password" name="new_password" required></td>
                                </tr>
                                <tr>
                                    <td><label>Confirm new password:</label></td>
                                    <td><input type="password" name="confirm_password" required></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" value="Update Password"></td>
                                </tr>
                                </table>
                            </form>';
                            }
                        mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php include("footer.inc") ?>