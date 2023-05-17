<?php include("check_login_test.php")?>
<?php include("cart_handler.php")?>
<?php include("header.inc"); ?>
<HTML>
<HEAD>
<TITLE>Simple PHP Shopping Cart</TITLE>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link href="styles/style_for_produc.css" rel="stylesheet">
</HEAD>
<style>
@media (max-width: 1024px) {
  .products-container {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 768px) {
  .products-container {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 480px) {
  .products-container {
    grid-template-columns: 1fr;
  }
}
</style>
<BODY>

<div id="product-grid">
	
		<form method="post" action="product.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">

		<div class="products-container">
			<?php
			$product_array = $db_handle->runQuery("SELECT * FROM product_test ORDER BY id ASC");
			if (!empty($product_array)) { 
				foreach($product_array as $key=>$value){
			?>
			<div class="product">
			<img class="product-image" src="<?=$product_array[$key]["img"]?>" alt="<?=$product_array[$key]["name"]?>">
			<div class="product-details">
				<p class="product-name"><?php echo $product_array[$key]["name"]; ?></p>
				<div class="product-description"><?php echo $product_array[$key]["desc"]; ?></div>
				<p class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></p>
				
				<form method="post" action="product.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
				<input type="hidden" name="product_id" value="<?php echo $product_array[$key]["id"]; ?>">
				<input type="hidden" name="version" value="regular">
				<input class="quantity-input" type="text" name="quantity" value="1" size="2" />
				<input class="button_product" type="submit" value="Add to Cart"/>
				</form>

				<form method="post" action="product.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
				<input type="hidden" name="product_id" value="<?php echo $product_array[$key]["id"]; ?>">
				<input type="hidden" name="version" value="online">
				<input class="quantity-input" type="hidden" name="quantity" value="1" size="2" />
				<input class="button_product2" type="submit" value="Add to Cart (E-book)"/>
				</form>
			</div>
			</div>
		<?php } ?>
		</div>

		</form>

		<?php
			}
		?>
</div>
</BODY>
</HTML>

<?php include("footer.inc"); ?>