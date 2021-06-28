<?php


function fetch_all_products_of_trader($trader_type, $connection) {
    $query = "SELECT * FROM RAJES.PRODUCTS, RAJES.SHOPS, RAJES.TRADERS
                  WHERE RAJES.PRODUCTS.FK_SHOP_ID = RAJES.SHOPS.SHOP_ID 
                  AND RAJES.SHOPS.FK_TRADER_ID = RAJES.TRADERS.TRADER_ID
                  AND RAJES.TRADERS.TRADER_TYPE = '$trader_type'";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    return $result;
}


function fetch_individual_products($product_id, $connection) {
    //Select individual product from all products
    $query = "SELECT * FROM RAJES.PRODUCTS WHERE PRODUCT_ID = $product_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    return $result;
}

function fetch_reviews_from_products($product_id, $connection) {
    $query = "SELECT * FROM RAJES.REVIEWS WHERE REVIEWS.FK1_PRODUCT_ID = $product_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    return $result;
}

function fetch_offers_from_products($offer_id, $connection) {
    $query = "SELECT * FROM RAJES.OFFERS WHERE OFFER_ID = $offer_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    return $result;
}

function fetch_discouted_price_from_products($offer_id, $product_price, $connection) {

    $result = fetch_offers_from_products($offer_id, $connection);
    $price = [];

    while($rows = oci_fetch_assoc($result)) {
        $price['offer_percentage'] = $rows['PERCENTAGE'];
        $price['description'] = $rows['DESCRIPTION'];
    }

    $discount = ($product_price * $price['offer_percentage']) / 100;
    $discount = number_format($discount, 2, '.');
    $totalPriceAfterDiscount = $product_price - $discount;
    $totalPriceAfterDiscount = number_format($totalPriceAfterDiscount, 2, '.');

    return array("offer_percentage" => $price['offer_percentage'], "offer_description" => $price['description'], "discount" => $discount,
        "total_price_after_discount" => $totalPriceAfterDiscount);
}

function fetch_all_reviews_and_rating($product_id, $connection) {
    $query = "SELECT * FROM RAJES.REVIEWS, RAJES.USERS, RAJES.CUSTOMERS
    WHERE REVIEWS.FK2_USER_ID = USERS.USER_ID AND USERS.USER_ID = CUSTOMERS.USER_ID
    AND FK1_PRODUCT_ID = $product_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    return $result;
}