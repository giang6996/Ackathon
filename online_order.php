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
    background-color: #fff;
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

body{
  font-family: 'Open Sans', sans-serif;
}

.profile-wrapper {
  margin: 20px;
  display: flex;
}
  
.profile-sidebar {
  flex-basis:20%;
  padding-top: 60px;
  padding-left: 4%;
}
  
.profile-sidebar ul {
  list-style-type: none;
  padding: 20;
}
  
.profile-sidebar li {
  margin-bottom: 15px;
}
  
.profile-sidebar a {
  color: #ff4500;
  text-decoration: none;
  font-size: 18px;
}
  
.profile-sidebar a:hover {
  text-decoration: none;
  color: black;
}
  
.profile-content {
  flex-basis: 75%;
}
  
.profile-header {
  border-bottom: 1px solid #ccc;
  margin-bottom: 30px;
}
  
.profile-header h1 {
  font-size: 24px;
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

<div class="tbl">
<?php
require_once("dbcontroller.php");
$db_handle = new DBController();

$username = "$username";

$sql = "SELECT o.username, o.name, o.quantity, o.price, o.version, o.status, pl.link
        FROM orders_test o
        JOIN product_links pl ON o.name = pl.name
        WHERE o.username = '$username' AND o.version = 'online'";
$result = $db_handle->runQuery($sql);

if ($result) {
    ?>
    <div class="profile-wrapper">
        <div class="profile-sidebar">
          <ul>
            <li><a href="regular_order.php">NORMAL_ORDER</a></li>
            <li><a href="online_order.php">ONLINE_ORDER</a></li>
          </ul>
        </div>
        <div class="profile-content">
          <div class="profile-header">
            <h1>ONLINE ORDER</h1>
          </div>
        <div class="profile-info">
            <div class="tbl">
                <table class="tbl-cart">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result as $order) {
                            $name = $order['name'];
                            $quantity = $order['quantity'];
                            $price = $order['price'];
                            $status = $order['status'];
                            $link = $order['link'];
                            ?>
                            <tr>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><a href='<?php echo $link; ?>'>E-book</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    <?php
} else {?>
    <div class="profile-wrapper">
        <div class="profile-sidebar">
          <ul>
            <li><a href="regular_order.php">NORMAL_ORDER</a></li>
            <li><a href="online_order.php">ONLINE_ORDER</a></li>
          </ul>
        </div>
        <div class="profile-content">
          <div class="profile-header">
            <h1>NORMAL ORDER</h1>
          </div>
        <div class="profile-info">
            <div class="tbl">
                <table class="tbl-cart">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>No order</td>
                                <td></td>
                                <td></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
<?php
}
?>
</div>

<?php include("footer.inc"); ?>