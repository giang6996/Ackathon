<?php
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
		case "add":
			if (!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM product_test WHERE code='" . $_GET["code"] . "'");
                $itemArray = array(
                    $productByCode[0]["code"] . '-' . $_POST["version"] => array(
                        'name' => $productByCode[0]["name"],
                        'code' => $productByCode[0]["code"],
                        'quantity' => $_POST["quantity"],
                        'price' => $productByCode[0]["price"],
                        'img' => $productByCode[0]["img"],
                        'version' => $_POST["version"]
                    )
                );

                if (empty($_SESSION["cartitem"])) {
                    $_SESSION["cartitem"] = array();
                }

                if (isset($_SESSION["cartitem"][$productByCode[0]["code"] . '-' . $_POST["version"]])) {
                    $_SESSION["cartitem"][$productByCode[0]["code"] . '-' . $_POST["version"]]["quantity"] += $_POST["quantity"];
                } else {
                    $_SESSION["cartitem"] = array_merge($_SESSION["cartitem"], $itemArray);
                }
            }
            break;
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
		case "empty":
			unset($_SESSION["cartitem"]);
			break;
	}
}

?>
<?php
$total_quantity = isset($_SESSION["cartitem"]) ? array_sum(array_column($_SESSION["cartitem"], "quantity")) : 0;
?>