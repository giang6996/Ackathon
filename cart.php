<!DOCTYPE html>
<html>
<head>
  <style>
.tbl{
    height: 530px;
}    
.tbl-cart {
    border-collapse: collapse;
    width: 70%;
    margin: 0 auto;
    background-color: #fff;
    margin-top: 60px;
    margin-bottom: 200px;
}

.tbl-cart th {
    background-color: #f2f2f2;
    text-align: left;
    padding: 10px;
}

.tbl-cart td {
    border-bottom: 1px solid #ddd;
    padding: 10px;
}

.tbl-cart td img {
    width: 20px;
    height: 20px;
}

.tbl-cart strong {
    font-weight: bold;
}

.no-records {
    text-align: center;
    padding: 20px;
    background-color: #f2f2f2;
}

.bottom_button{
    margin: 0 auto;
    text-align: center;
}

.homepage-link {
  display: inline-block;
  padding: 10px 20px;
  background-color: #333;
  color: #fff;
  text-decoration: none;
  text-transform: uppercase;
  border-radius: 5px;
  text-align: center;
}

.homepage-link:hover {
  background-color: #555;
}


</style>

</head>
<body>

</body>
</html>
<?php include("check_login_test.php")?>
<?php include("cart_handler.php")?>
<?php include("header.inc"); ?>
<?php require_once("db.php");?>
<?php
    require_once("dbcontroller.php");
    $db_handle = new DBController();
    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "remove":
                if(!empty($_SESSION["cartitem"])) {
                    foreach($_SESSION["cartitem"] as $key => $item) {
                        if($_GET["code"] == $item["code"] && $_GET["version"] == $item["version"]) {
                            unset($_SESSION["cartitem"][$key]);
                            break;
                        }
                    }
                    if(empty($_SESSION["cartitem"])) {
                        unset($_SESSION["cartitem"]);
                    }
                }
                break;
        }
    }
    if (!empty($_GET["action"]) && $_GET["action"] == "checkout") {
    if (!empty($_SESSION["cartitem"])) {
        foreach ($_SESSION["cartitem"] as $item) {
            $name = $item["name"];
            $quantity = $item["quantity"];
            $price = $item["price"];
            $version = $item["version"];

            $safe_name = mysqli_real_escape_string($conn, $name);
            $safe_quantity = intval($quantity);
            $safe_price = floatval($price);
            $safe_version = mysqli_real_escape_string($conn, $version);

            $query = "INSERT INTO orders_test (username, name, version, quantity, price) VALUES ('$username', '$safe_name', '$version', $safe_quantity, $safe_price)";
            $result = mysqli_query($conn, $query);

            if ($result) {
                unset($_SESSION["cartitem"]);
            }
        }
    }
}
?>



<?php
if (!empty($_SESSION["cartitem"])) {
    
?>
<div class="tbl">
<table class="tbl-cart">
    <tbody>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Version</th>
            <th>Price</th>
            <th>Total</th>
        </tr>

        <?php
        $total_quantity = 0;
        $total_price = 0;

        foreach ($_SESSION["cartitem"] as $item) {
            $item_price = $item["quantity"] * $item["price"];
            ?>

            <tr>
                <td><?php echo $item["name"]; ?></td>
                <td><?php echo $item["quantity"]; ?></td>
                <td><?php echo $item["version"]; ?></td>
                <td><?php echo "$" . $item["price"]; ?></td>
                <td><?php echo "$" . number_format($item_price, 2); ?></td>
                <td><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>&version=<?php echo $item["version"]; ?>"><img src="images/icon-delete.png" alt="Remove Item" /></a></td>

            </tr>

            <?php
            $total_quantity += $item["quantity"];
            $total_price += ($item["price"] * $item["quantity"]);
            }
            ?>

        <tr>
            <td><strong>Total:</strong></td>
            <td><strong><?php echo $total_quantity; ?></strong></td>
            <td><strong></strong></td>
            <td><strong><?php echo "$" . number_format($total_price, 2); ?></strong></td>
        </tr>
    </tbody>
</table>
</div>
<?php
} else {
?>
<div class="tbl">
<div class="no-records">Your Cart is Empty</div>
</div>
<?php
}
?>

<div class="bottom_button">
    <a href="index.php" class="homepage-link">Back to product page</a>
    <a href="cart.php?action=checkout" class="homepage-link">Check Out</a>
</div>


<?php include("footer.inc"); ?>