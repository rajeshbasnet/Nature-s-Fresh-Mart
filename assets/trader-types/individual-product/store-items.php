<?php

$connection = getConnection();

include_once "../functions.php";

if (isset($_POST['formSubmit'])) {

    $product_id = htmlspecialchars($_GET['search']);
    $product_quantity = $_POST['product_quantity'] ??= 1;
    $product_price = $_POST['product-price'] ??= "";
    $product_name = $_POST['product-name'] ??= "";
    $product_image = $_POST['product-image'] ??= "";

    if (isset($_SESSION['user'])) {
        $count_cart_items = 0;
        $customer_id = get_user_type_id($_SESSION['user'], $connection, "CUSTOMERS");
        $basket_id = get_basket_id_from_baskets($customer_id, $connection);
        insert_into_basket_products($basket_id, $product_id, $product_quantity, $connection);
        $result = fetch_cart_items_from_baskets($basket_id, $connection);

        while($rows = oci_fetch_assoc($result)) {
            $count_cart_items++;
        }

        $_SESSION['count'] = $count_cart_items;

    } else {
        if (count($_COOKIE) > 0) {
            foreach ($_COOKIE as $key => $item) {
                if ($key == "PHPSESSID") {
                    continue;

                } else {
                    $encodedItem = json_decode($item, true);

                    //If item is already stored before
                    if ($key == $product_id) {
                        $quantity = $encodedItem['quantity'];
                        $product_quantity = $quantity + $product_quantity;
                    }
                }
            }
        }

        $product_price = $product_quantity * $product_price;

        $prod_info = array('id' => $product_id, 'name' => $product_name, "price" => $product_price, 'quantity' => $product_quantity, 'image' => $product_image, 'type' => $trader_type);
        $prod_info = json_encode($prod_info, true);
        setcookie($product_id, $prod_info, time() + (86400 * 30), '/website/project/');

    }
    header("Refresh: 0; url='/website/project/assets/trader-types/individual-product/individual-product.php?search=$product_id&type=$trader_type'");

}


