<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <link rel="stylesheet" href="./icofont/icofont.min.css">
  <link href="styles/style2.css" rel="stylesheet">
  <title>Document</title>
</head>
<?php
$username = $_SESSION['username'];

if (isset($_GET['logout'])) {
    session_unset();
    header("Location: login_form.php");
    exit;
}
?>

<body>
  <div class="header">

    <nav class="navbar_header">

        <img src="styles/images/book_logo.jpg" alt="" class="logo_header">
        <img src="images/SBlogo.png" alt="" style="margin-left: 20px; width: 100px;">   

      <ul class="navbar_header_ul">
        <li class="menu_list"><a href="index.php">Home</a></li>
        <li class="menu_list"><a href="product.php">Product</a></li>
        <li class="menu_list"><a href="feature.php">Feature</a></li>
        <li class="menu_list"><a href="#">Powerpoint</a></li>
        <li class="menu_list">
        <a href="cart.php?show_cart=1" class="checkout-button">Cart (<?php echo $total_quantity; ?>)</a>
        <span>
          <form method="POST" action="cart.php">
          <input type="hidden" name="total_quantity" value="<?php echo htmlspecialchars($total_quantity); ?>">
          <input type="hidden" name="total_price" value="<?php echo htmlspecialchars($total_price); ?>">
          <div class="checkoutproduct">
          </form>
        </span>  
        </li>
      </ul>

      
      <div class="profile_dropdown">
        <div onclick="toggle()" class="profile_dropdown_btn">
          <div class="profile_img"></div>
          <span class="user_name"><?php echo $username; ?></span>
        </div>

        <ul class="profile_dropdown_list">

          <li class="profile_dropdown_list_item">
            <a href="User information.php">Edit Profile</a>
          </li>

          <li class="profile_dropdown_list_item">
            <a href="regular_order.php">Order</a>
          </li>

          <li class="profile_dropdown_list_item">
            <a href="?logout=true">Log out</a>
          </li>

        </ul>

      </div>

    </nav>  

  </div>

  <script>
    let profileDropdownList = document.querySelector(".profile_dropdown_list");
    let btn = document.querySelector(".profile_dropdown_btn");

    let classList = profileDropdownList.classList;

    const toggle = () => classList.toggle("active");

    window.addEventListener("click", function (e) {
      if (!btn.contains(e.target)) classList.remove("active");
    });
  </script>
</body>

</html>