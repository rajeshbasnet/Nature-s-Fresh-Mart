<?php

session_start();

include_once "../trader-types/functions.php";

//Connection
include_once "../../connection/connect.php";
$connection = getConnection();

if (isset($_SESSION['user'])) {
    $count_cart_items = 0;
    $basket_id = $_GET['basket_id'] ??= "";
    $product_id = $_GET['product_id'] ??= "";
    remove_from_basket($basket_id, $product_id, $connection);

    $_SESSION['count'] = $_SESSION['count'] - 1;
    header("Location: /website/project/assets/addtocart/addtocart.php");

} else {
    $key = $_GET['key'] ??= "";
    setcookie($key, "", time() - (86400 * 30), '/website/project/');
    header("Refresh:0 url='/website/project/assets/addtocart/addtocart.php'");
}

