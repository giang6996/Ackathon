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

        session_start();

        $card = $numcre = $excre = $cvv = '';
        $carderr = $numcreerr = $excreerr = $cvverr = '';
        $errnum = 0;
        $id = $_SESSION["id"];
        $cardtype = 0;

        $_SESSION["card"] = '';
            $_SESSION["namecre"] = '';
            $_SESSION["numcre"] = '';
            $_SESSION["excre"] = '';
            $_SESSION["cvv"] = '';

        if ($_SERVER['REQUEST_METHOD'] == "POST"){

            $_SESSION["card"] = test_input($_POST['card']);
            $_SESSION["namecre"] = test_input($_POST['namecre']);
            $_SESSION["numcre"] = test_input($_POST['numcre']);
            $_SESSION["excre"] = test_input($_POST['excre']);
            $_SESSION["cvv"] = test_input($_POST['cvv']);

            if (empty($_POST['card']) || strlen($_POST['card']) == 0){
                $carderr = " Error: Please choose your card";
                $errnum += 1;
            } else {
                $card = $_POST['card'];
                if ($card == "Visa"){
                    $cardtype = 0;
                } elseif ($card == "Mastercard") {
                    $cardtype += 1;
                } elseif ($card == "American Express") {
                    $cardtype += 2;
                }
            }


            if (empty($_POST['numcre']) || strlen($_POST['numcre']) == 0){
                $numcreerr = " Error: Please insert your credit card number";
                $errnum += 1;
            } else {
                $numcre = test_input($_POST['numcre']);
                $numcre = preg_replace('/\s+/', '', $numcre);
                $numcre1 = substr($numcre, 0, 1);
                $numcre2 = substr($numcre, 0, 2);
                if(is_numeric($numcre) == false){
                    $numcreerr = " Error: Number only, no space!";
                    $errnum += 1;
                }

                if ($cardtype == 0) {
                    if (strlen($numcre) != 16 ) {
                        $numcreerr = " Error: Visa cards have 16 digits";
                        $errnum += 1;
                    } elseif ($numcre1 != "4") {
                        $numcreerr = " Error: Visa cards start with a 4";
                        $errnum += 1;
                    }
                }
                if ($cardtype == 1){
                    if (strlen($numcre) != 16 ){
                        $numcreerr = " Error: MasterCard have 16 digits";
                        $errnum += 1;
                    } elseif ((int)$numcre2 < 51 || (int)$numcre2 > 54) {
                        $numcreerr = " Error: MasterCard cards start with a 54";
                        $errnum += 1;
                    }
                }
                if ($cardtype == 2){
                    if (strlen($numcre) != 15 ){
                        $numcreerr = " Error: American Express has 15 digits ";
                        $errnum += 1;
                    } elseif ((int)$numcre2 != 34 && (int)$numcre2 != 37) {
                        $numcreerr = " Error: American Express starts with 34 or 37";
                        $errnum += 1;
                    }

                }
            }

            if (empty($_POST['excre']) || strlen($_POST['excre']) == 0){
                $excreerr = " Error: Please enter card expire date";
                $errnum += 1;
            } else {
                $excre = test_input($_POST['excre']);
                if (preg_match("/^(0[1-9]|1[0-2])-[0-9]{2}$/",$excre) == 0){
                    $excreerr = " Error: Invalid date format(MM-YY)";
                    $errnum += 1;
                }
            }


            if (empty($_POST['cvv']) || strlen($_POST['cvv']) == 0){
                $cvverr = " Error: Please insert your card cvv";
                $errnum += 1;
            } else {
                $cvv = test_input($_POST['cvv']);
                $cvv = preg_replace('/\s+/', '', $cvv);
                if(is_numeric($cvv) == false){
                    $cvverr = " Error: Number only, no space!";
                    $errnum += 1;
                }
            }
            if ($errnum == 0){

                $update = "UPDATE userdetail SET cardname = '".$card."', cardnum = '".$numcre."', cardex = '".$excre."', cvv = '".$cvv."' WHERE id = '".$id."' ";

                mysqli_query($conn, $update);

                session_destroy();

                header("Location: index.php"); 

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
                    <div id="form-align">
                        <div class= "form-element">
                            <label for="card">Which type of card do you want to use?</label>
                            <br>
                            <select name="card" id="card">
                                <option name="type_1" value="visa" <?php if ($_SESSION['card'] == "visa") { echo ' selected'; } ?>>Visa</option>
                                <option name="type_2" value="mastercard" <?php if ($_SESSION['card'] == "mastercard") { echo ' selected'; } ?>>Mastercard</option>
                                <option name="type_3" value="american-express" <?php if ($_SESSION['card'] == "american-express") { echo ' selected'; } ?>>American Express</option>
                            </select>
                            <span class="error"> <?php echo trim($carderr,"");?></span>
                        </div>
                        <div class= "form-element">
                            <p>Card Number</p>
                            <input type="text_pay" class="inputbox_enquiry" name="numcre" id="numcre" placeholder="Enter your card number" value = "<?php echo $_SESSION["numcre"];?>">
                            <span class="error"> <?php echo trim($numcreerr,"");?></span>
                        </div>
                        <div class= "form-element">
                            <p class="expcvv_text">Expiry</p>
                            <input type="text" class="inputbox_enquiry" name="excre" id="excre" placeholder="MM-YY" value = "<?php echo $_SESSION["excre"];?>">
                            <span class="error"> <?php echo trim($excreerr,"");?></span>
                        </div>
                        <div class= "form-element">
                            <p class="expcvv_text">CVV</p>
                            <input type="text" class="inputbox_enquiry" name="cvv" id="cvv" placeholder="Enter your card verification value" value = "<?php echo $_SESSION["cvv"];?>">
                            <span class="error"> <?php echo trim($cvverr,"");?></span>
                        </div>
                        <input type="submit" value="Sign up" class="submit">
                    </div>
                </form>
            </div>
        </div>
        <br>
        <hr>

    </main>

    <?php include("footer.inc") ?>


</body>

</html>