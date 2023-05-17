<!DOCTYPE html>
<html lang="en">

<head>
    <title>Enquiry </title>
    <meta name="description" content="features" />
    <meta name="keywords" content="features" />
    <meta charset="utf-8">
    <link href="styles/style2.css" rel="stylesheet">
    <link href="styles/style_sign_up.css" rel="stylesheet">
</head>

<body>
    <?php
        require_once("db.php");
        include ("sanitize.php");
            $fnameerr = $lnameerr = $usernameerr = $emailerr = $phoneerr = $passerr = $cfpasserr= $stradderr = $ftownerr = $posterr = '';
            $fname = $lname = $username = $email = $phonenum = $pass = $cfpass = $stradd = $town = $post =  '';
            $id = rand();
            $errnum = 0;

            session_start();
            date_default_timezone_set('Australia/Melbourne');
                $_SESSION["fname"] = '';
                $_SESSION["lname"] = '';
                $_SESSION["email"] = '';
                $_SESSION["phonenum"] = '';
                $_SESSION["pass"] = '';
                $_SESSION["cfpass"] = '';
                $_SESSION["street"] = '';
                $_SESSION["town"] = '';
                $_SESSION["Pcode"] = '';
                $_SESSION["id"] = '';

            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                $_SESSION["loginid"] = '';
                $_SESSION["fname"] = test_input($_POST['fname']);
                $_SESSION["lname"] = test_input($_POST['lname']);
                $_SESSION["username"] = test_input($_POST['username']);
                $_SESSION["email"] = test_input($_POST['email']);
                $_SESSION["phonenum"] = test_input($_POST['phonenum']);
                $_SESSION["pass"] = test_input($_POST['pass']);
                $_SESSION["cfpass"] = test_input($_POST['cfpass']);
                $_SESSION["street"] = test_input($_POST['street']);
                $_SESSION["town"] = test_input($_POST['town']);
                $_SESSION["Pcode"] = test_input($_POST['Pcode']);
                $_SESSION["id"] = $id;

                $user_query_sql = "SELECT * FROM userdetail WHERE username = '".$_SESSION["username"]."';";
                $result = mysqli_query($conn, $user_query_sql);
                if ($result->num_rows > 0) {
                    $usernameerr = "Error: Username already existed";
                    $errnum += 1;
                }



                if (empty($_POST['fname']) || strlen($_POST['fname']) == 0){
                    $fnameerr = " Error: Please insert your first name";
                    $errnum += 1;
                } else {
                    $fname = test_input($_POST['fname']);
                    if (strlen($_POST['fname']) > 25){
                        $fnameerr = " Error: Maximum 25 word only";
                        $errnum += 1;
                        echo $fname;
                    }
                }

                if (empty($_POST['lname']) || strlen($_POST['lname']) == 0){
                    $lnameerr = " Error: Please insert your last name";
                    $errnum += 1;
                } else {
                    $lname = test_input($_POST['lname']);
                    if (strlen($_POST['lname']) > 25){
                        $lnameerr = " Error: Maximum 25 word only";
                        $errnum += 1;
                        echo $lname;
                    }
                }

                if (empty($_POST['username']) || strlen($_POST['username']) == 0){
                    $usernameerr = " Error: Please insert your user name";
                    $errnum += 1;
                } else {
                    $username = test_input($_POST['username']);
                    if (strlen($_POST['username']) > 8){
                        $usernameerr = " Error: Maximum 8 characters only";
                        $errnum += 1;
                        echo $username;
                    }
                }

                if (empty($_POST['email']) || strlen($_POST['email']) == 0){
                    $emailerr = " Error: Please insert your email";
                    $errnum += 1;
                } else {
                    $email = test_input($_POST['email']);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $emailerr = " Error: Invalid Email";
                        $errnum += 1;
                    }
                }

                if (empty($_POST['phonenum']) || strlen($_POST['phonenum']) == 0){
                    $phoneerr = " Error: Please insert your phone number";
                    $errnum += 1;
                } else {
                    $phonenum = test_input($_POST['phonenum']);
                    if(is_numeric($phonenum) == false){
                        $phoneerr = " Error: Number only, no space!";
                        $errnum += 1;
                    } elseif (strlen($_POST['phonenum']) > 10){
                        $phoneerr = " Error: Maximum 10 number only!";
                        $errnum += 1;
                    } else {
                        $phonenum = test_input($_POST['phonenum']);
                    }
                }

                if (empty($_POST['pass']) || strlen($_POST['pass']) == 0){
                    $passerr = " Error: Please insert your password";
                    $errnum += 1;
                } else {
                    $pass = test_input($_POST['pass']);
                    if(!(preg_match('#[0-9]#', $pass))||!(preg_match('#[A-Z]#', $pass))|| strlen($pass) < 8){
                        $passerr = "Error: Password should be at least 8 characters in length and should include at least one upper case letter and one number.";
                        $errnum += 1;
                    }else{
                        $pass = test_input($_POST['pass']);
                    }
                }

                if (empty($_POST['cfpass']) || strlen($_POST['cfpass']) == 0){
                    $cfpasserr = " Error: Please insert your password";
                    $errnum += 1;
                } else {
                    $cfpass = test_input($_POST['cfpass']);
                    if($cfpass != $pass){
                        $cfpasserr = "Error: Different password";
                        $errnum += 1;
                    }
                }

                if (empty($_POST['street']) || strlen($_POST['street']) == 0){
                    $stradderr = " Error: Please insert your street address";
                    $errnum += 1;
                } else {
                    $street = test_input($_POST['street']);
                    if (strlen($stradd) > 40){
                        $stradderr = " Error: Maximum 40 characters only!";
                        $errnum += 1;
                    }
                }
                if (empty($_POST['town']) || strlen($_POST['town']) == 0){
                    $ftownerr = " Error: Please insert your town address";
                    $errnum += 1;
                } else {
                    $town = test_input($_POST['town']);
                    if (strlen($ftown) > 20){
                        $ftownerr = " Error: Maximum 20 characters only!";
                        $errnum += 1;
                    }
                }

                if (empty($_POST['Pcode']) || strlen($_POST['Pcode']) == 0){
                    $posterr = " Error: Please insert your post number";
                    $errnum += 1;
                } else {
                    $post = test_input($_POST['Pcode']);
                    $post = preg_replace('/\s+/', '', $post);
                    if(is_numeric($post) == false){
                        $posterr = " Error: Number only, no space!";
                        $errnum += 1;
                    } elseif (strlen($post) != 4){
                        $posterr = " Error: Maximum 4 number only!";
                        $errnum += 1;
                    }
                }


                if ($errnum == 0){
                    $date = date('m/d/Y h:i:s a', time());

                    $insert = "INSERT INTO userdetail (id, fname, lname, username, email, phonenum, pass, cfpass, street, town, post)
                    VALUES ( '$id', '$fname', '$lname', '$username', '$email', '$phonenum', '$pass', '$cfpass', '$street', '$town', '$post')";

                    mysqli_query($conn, $insert);

                    header("Location: cart_info.php");

                    echo "<script>window.close();</script>";
                }

            }
    ?>
    <main class="main_enquiry">
        <div id="title">
            <h2>Sign up</h2>
        </div>

        <div class="form">
            <div id="form_content">
                <form id="form_order" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="left">
                    <h2 class="pre">User information</h2> <br>
                    <!------------------------------Personal Info-------------------------------->
                        <div class="form-element">
                            <label class="name" for="fname">First name <br>
                            <input class="input" type="text" placeholder="Enter your first name" name="fname" id="fname" value = "<?php echo $_SESSION["fname"]; ?>" ></label>
                            <span class="error"> <?php echo trim($fnameerr,"");?></span><br>
                        </div>
                        <div class="form-element">
                            <label class="name" for="lname">Last name <br>
                            <input class="input" type="text" placeholder="Enter your last name" name="lname" id="lname" value = "<?php echo $_SESSION["lname"]; ?>" ></label>
                            <span class="error"> <?php echo trim($lnameerr,"");?></span><br>
                        </div>
                        <div class="form-element">
                            <label class="name" for="username">User name (8 characters only)<br>
                            <input class="input" type="text" placeholder="Enter your username" name="username" id="username" value = "<?php echo $_SESSION["username"]; ?>" > </label>
                            <span class="error"> <?php echo trim($usernameerr,"");?></span><br>
                        </div>
                        <div class="form-element">
                            <label class="name" for="email">Email address<br>
                            <input class="input" type="text" placeholder="Enter your email address" name="email" id="email" value = "<?php echo $_SESSION["email"]; ?>" > </label>
                            <span class="error"> <?php echo trim($emailerr,"");?></span><br>
                        </div>
                        <div class="form-element">
                            <label class="name" for="phonenum">Phone number<br>
                            <input class="input" type="text" placeholder="Enter your phone number" name="phonenum" id="phonenum" value = "<?php echo $_SESSION["phonenum"]; ?>" ></label>
                            <span class="error"> <?php echo trim($phoneerr,"");?></span><br>
                        </div>
                        <div class="form-element">
                            <label class="password" for="pass">Password<br>
                            <input class="input" type="password" placeholder="Enter your password" name="pass" id="pass" value = "<?php echo $_SESSION["pass"]; ?>" ></label>
                            <span class="error"> <?php echo trim($passerr,"");?></span><br>
                        </div>
                        <div class="form-element">
                            <label class="cfpassword" for="cfpass">Confirm password<br>
                            <input class="input" type="password" placeholder="Confirm your password" name="cfpass" id="cfpass" value = "<?php echo $_SESSION["cfpass"]; ?>" ></label>
                            <span class="error"> <?php echo trim($cfpasserr,"");?></span><br>
                        </div>
                        <br>

                            <h2 class="address">Please enter your address in this form</h2>
                            <br>
                            <div class="form-element">
                                <label class="name" for="street">Street address <br> <input class="input" type="text" placeholder="Enter your Street address" name="street" id="street" value = "<?php echo $_SESSION["street"]; ?>" ></label>
                                <span class="error"> <?php echo trim($stradderr,"");?></span><br>
                            </div>

                            <div class="form-element">
                                <label class="name" for="town">Suburb/town <br> <input class="input" type="text" placeholder="Enter your Suburb/town" name="town" id="town" value = "<?php echo $_SESSION["town"]; ?>" ></label>
                                <span class="error"> <?php echo trim($ftownerr ,"");?></span><br>
                            </div>

                            <div class="form-element">
                                <label class="name" for="Pcode">Postcode <br> <input class="input" type="text" placeholder="Enter your postcode" name="Pcode" id="Pcode" value = "<?php echo $_SESSION["Pcode"]; ?>" ></label>
                                <span class="error"> <?php echo trim($posterr,"");?></span><br>
                            </div>
                            <br>
                            <div id="term_label">
                                <label>Make sure that you have read <a href = "/">Term & Regulation</a>.
                                    <input type="checkbox" name="check2" value="readall"><br>
                                </label>
                            </div>
                            <input type="submit" value="Next page" class="submit">
                        </div>
                    </div>
                </form>
            </div> <!-- Form Content -->
        </div>


        <br>
        <hr>

    </main>

    <?php include("footer.inc") ?>

</body>

</html>