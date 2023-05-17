<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Assignment 2">
    <meta name="keywords" content="HTML5, CSS">
    <title>The Booktown</title>

    <link href="styles/style_feature.css" rel="stylesheet">
</head>
<style>
.feature {
  background-color: #f5f5f5;
  padding: 40px 0;
}

.container {
  max-width: 960px;
  margin: 0 auto;
  padding: 0 20px;
  justify-content: center;
}

.feature-item {
  text-align: left;
  margin-bottom: 40px;
  width: 100%;
  max-width: 1200px;
}

.feature-item img {
  width: 200px;
  height: 200px;
  object-fit: cover;
  border-radius: 50%;
}

.feature-item h3 {
  font-size: 24px;
  margin-top: 20px;
  margin-bottom: 10px;
}

.feature-item p {
  font-size: 18px;
}

</style>
<body>
    <?php include("check_login_test.php")?>
    <?php include("cart_handler.php")?>
    <?php include("header.inc") ?>
    <section class="feature">
    <div class="container">
        <div class="feature-item">
        <h3>Feature 1: Registration and Login</h3>
        <p>Our registration and login system incorporates rigorous validation checks to ensure accurate user input and match the required format. This enhances the user experience by providing clear error messages and maintains data integrity by verifying the entered information against the database during login.</p>
        </div>
        
        <div class="feature-item">
        <h3>Feature 2: Product</h3>
        <p> In the product section, our system retrieves products directly from the database. This means that if you wish to add or edit products, you can easily access the database to make the necessary changes. The products are categorized into two main types: online products and regular products.<br><br>
            When browsing the products, you will notice that each product is clearly labeled with its corresponding version—either "Online" or "Regular." <br><br>
            When you find a product you like, you can add it to your cart. At this point, you can specify the desired quantity of the product. As you add items to your cart, the system automatically calculates and updates the total price based on the quantity and individual product prices. This enables you to keep track of your expenses and make adjustments as needed.<br>
            To review and manage the items in your cart, simply click on the "Cart" button. This will provide you with an overview of the selected products, their quantities, and the total price. You can modify the quantities or remove items from the cart if desired.</p>
        </div>
        
        <div class="feature-item">
        <h3>Feature 3: Cart</h3>
        <p>After selecting the desired books by online or offline genre, users will access the Cart to check the products they will buy. Once confirmed, click the check out button and all order information and username (helps to format the order) will be inserted into the database.</p>
        </div>

        <div class="feature-item">
        <h3>Feature 4: Order</h3>
        <p>The order section will be divided into 2 main parts: normal order and online order. Here will display your entire order depending on its version (regular or online). Especially in the online section, the book they buy will display an "E-book" link that leads to the pdf page containing the book.</p>
        </div>

        <div class="feature-item">
        <h3>Feature 5: Edit Order and other feature</h3>
        <p>When you click on the box containing your name in the upper right corner, there will be 3 options for you, the first option is Edit Profile, here you will be able to edit your profile information at the time of registration; The 2nd option is the Order I explained above and the 3rd option is Log out, you will log out of the current account and log out.<br><br>
*Note: you are only allowed to log in to the website if you are already logged in (register if you do not have an account), payment will be made using your Visa, mastercard or American Express account that you provided in the registration section. order money</p>
        </div>
    </div>
    </section>
    <?php include("footer.inc") ?>
</body>
</html>