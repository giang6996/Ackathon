<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta name="description" content="features" />
    <meta name="keywords" content="features" />
    <meta charset="utf-8">
    <link href="styles/style2.css" rel="stylesheet">
    <link href="styles/style_sign_up.css" rel="stylesheet">
</head>

<body>
    <?php
        session_start();
        require_once("function.php");
        include("sanitize.php");

        require_once("db.php");

        $_SESSION["uname"] = '';
        $_SESSION["upass"] = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $username = sanitise_input($_POST["login_username"]);
            $user_pass = $_POST["login_password"];

            $_SESSION["uname"] = $username;
            $_SESSION["upass"] = $user_pass;

            $user_query_sql = "SELECT * FROM userdetail WHERE username = '$username' AND pass = '$user_pass';";
            $result = $conn->query($user_query_sql);

            if ($result->num_rows > 0) {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit;
            } else {
                $error_message = "Error: Wrong password or Username";
            }
        }
    ?>

    <div class="login-card">

        <div class="login-header">
            <div class="log">Login</div>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-login">
                <label class="login-label" for="login_username">Username:</label>
                <input name="login_username" id="login_username" type="text" placeholder="Enter username" value = "<?php echo $_SESSION["uname"]; ?>" required>
            </div>
            <div class="form-login">
                <label class="login-label" for="login_password">Password:</label>
                <input name="login_password" id="login_password" type="password" placeholder="Enter password" value = "<?php echo $_SESSION["upass"]; ?>" required>
            </div>
            <?php if (isset($error_message)) { ?>
                <div class="error"><?php echo $error_message; ?></div>
            <?php } ?>
            <div class="form-login">
                <input value="Login" type="submit" class="login_button" id="login">
                <input value ="Don't have an Account? Sign up here!" type="button" class="login_button" id="sign_up" onclick="location.href='signup.php'">
            </div>
        </form>


    </div>
    <br>
    <hr>

    <?php include("footer.inc") ?>
</body>

</html>