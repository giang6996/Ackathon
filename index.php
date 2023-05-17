<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Assignment 2">
    <meta name="keywords" content="HTML5, CSS">
    <title>The Booktown</title>

    <link href="styles/style_index.css" rel="stylesheet">

</head>
<body>
    <?php include("check_login_test.php")?>
    <?php include("cart_handler.php")?>
    <?php include("header.inc") ?>
    <body>
    <section class="hero">
    <div class="hero-content">
      <h2>Discover the Joy of Reading</h2>
      <p>Immerse yourself in captivating stories and expand your imagination.</p>
      <a href="product.php" class="cta-button">Browse Books</a>
    </div>
  </section>

  <section class="features">
    <div class="feature">
      <img src="images/ExtensiveCollection.png">
      <h3>Extensive Collection</h3>
      <p>Explore our vast collection of books across various genres.</p>
    </div>
    <div class="feature">
      <img src="images/EasyNavigation.jpg" style="width: 300px;">
      <h3>E-Book</h3>
      <p>Find your next read effortlessly with our user-friendly interface.</p>
    </div>
    <div class="feature">
      <img src="images/quickorder.png" style="width: 300px;">
      <h3>Quick Order</h3>
      <p>Make informed decisions with insights from our community of readers.</p>
    </div>
  </section>

  <section class="author-spotlight">
    <h2>Author Spotlight</h2>
    <div class="author-card">
      <img src="images/FredericBastiat.jpg">
      <div class="author-info">
        <h3>Frederic Bastiat</h3>
        <p>Discover the fascinating works of FredericBastiat and explore their creative process.</p>
        <a href="product.php" class="cta-button">Read More</a>
      </div>
    </div>
  </section>

  <section class="newsletter">
    <h2>Stay Connected</h2>
    <p>Subscribe to our newsletter for the latest book releases, news, and exclusive offers.</p>
    <form>
      <input type="email" placeholder="Enter your email address" required>
      <button type="submit">Subscribe</button>
    </form>
  </section>

  <footer>
    <p>&copy; 2023 Book World. All rights reserved.</p>
  </footer>
</body>
<?php include("footer.inc") ?>

</body>
</html>