<?php

//Fetch functions
function fetch_all_products_of_trader($trader_type, $connection) {
    $query = "SELECT * FROM PRODUCTS, SHOPS, TRADERS
                  WHERE PRODUCTS.FK_SHOP_ID = SHOPS.SHOP_ID
                  AND SHOPS.FK_TRADER_ID = TRADERS.TRADER_ID
                  AND TRADERS.TRADER_TYPE = '$trader_type' AND PRODUCTS.STATUS = 1";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    return $result;
}


function fetch_individual_products($product_id, $connection) {
    //Select individual product from all products
    $query = "SELECT * FROM PRODUCTS WHERE PRODUCT_ID = $product_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    return $result;
}

function fetch_reviews_from_products($product_id, $connection) {
    $query = "SELECT * FROM REVIEWS WHERE REVIEWS.FK1_PRODUCT_ID = $product_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    return $result;
}

function fetch_offers_from_products($offer_id, $connection) {
    $query = "SELECT * FROM OFFERS WHERE OFFER_ID = $offer_id";
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

function fetch_offerid_and_productprice_from_product_id($product_id, $connection) {
    $query = "SELECT ITEM_PRICE, FK_OFFER_ID FROM PRODUCTS WHERE PRODUCT_ID = $product_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    $offer_id = "";
    $product_price = "";

    while($rows = oci_fetch_assoc($result)) {
        $offer_id = $rows['FK_OFFER_ID'];
        $product_price = $rows['ITEM_PRICE'];
    }

    return array('offer_id' => $offer_id, 'product_price' => $product_price);
}


function fetch_all_reviews_and_rating($product_id, $connection) {
    $query = "SELECT * FROM REVIEWS, USERS, CUSTOMERS
    WHERE REVIEWS.FK2_USER_ID = USERS.USER_ID AND USERS.USER_ID = CUSTOMERS.USER_ID
    AND FK1_PRODUCT_ID = $product_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    return $result;
}


function get_user_type_id($id, $connection, $user_type) {

    $user_type = strtoupper($user_type);
    $user_type_id = "";

    $query = "SELECT * FROM USERS, $user_type WHERE USERS.USER_ID = $user_type.USER_ID AND USERS.USER_ID = $id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    while($rows = oci_fetch_assoc($result)) {
        $user_type_id = $rows['CUSTOMER_ID'];
    }

    return $user_type_id;

}

function insert_into_basket($customer_id, $connection) {

        $query = "INSERT INTO BASKETS (BASKET_ID, TOTAL_SUM, FK_CUSTOMER_ID) VALUES(null, null, $customer_id)";
        $result = oci_parse($connection, $query);
        oci_execute($result);

}

//basket id


function check_customers_from_basket($customer_id, $connection) {

    $count = 0;
    $query = "SELECT FK_CUSTOMER_ID FROM BASKETS WHERE BASKETS.FK_CUSTOMER_ID = $customer_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    while($rows = oci_fetch_assoc($result)) {
        $count++;
    }

    return $count;
}

function get_basket_id_from_baskets($customer_id, $connection) {

    $basket_id = "";

    $query = "SELECT BASKET_ID FROM BASKETS WHERE BASKETS.FK_CUSTOMER_ID = $customer_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    while($rows = oci_fetch_assoc($result)) {
        $basket_id = $rows['BASKET_ID'];
    }

    return $basket_id;
}

function insert_into_basket_products($basket_id, $product_id, $quantity, $connection) {

    $getQuantity = fetch_quantity_from_basket_products($product_id, $basket_id, $connection);

    if(empty($getQuantity)) {
        $query = "INSERT INTO BASKET_PRODUCTS(FK_PRODUCT_ID, FK_BASKET_ID, QUANTITY) VALUES($product_id, $basket_id, $quantity)";

    }else {
        $quantity = intval($getQuantity) + $quantity;
        $query = "UPDATE BASKET_PRODUCTS SET QUANTITY = $quantity WHERE FK_BASKET_ID = $basket_id AND FK_PRODUCT_ID = $product_id";
    }
    $result = oci_parse($connection, $query);
    oci_execute($result);
}


function fetch_quantity_from_basket_products($product_id, $basket_id, $connection) {

    $quantity = "";
    $query = "SELECT * FROM BASKET_PRODUCTS WHERE FK_BASKET_ID = $basket_id AND FK_PRODUCT_ID = $product_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    while($rows = oci_fetch_assoc($result)) {
        if(isset($rows['QUANTITY'])) {
            $quantity = $rows['QUANTITY'];
        };
    }

    return $quantity;

}


function fetch_cart_items_from_baskets($basket_id, $connection) {
    $query = "SELECT * FROM BASKETS, BASKET_PRODUCTS, PRODUCTS WHERE BASKET_PRODUCTS.FK_BASKET_ID= BASKETS.BASKET_ID AND BASKET_PRODUCTS.FK_PRODUCT_ID = PRODUCTS.PRODUCT_ID AND BASKET_ID = $basket_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    return $result;
}

function fetch_all_from_basket_produts($basket_id, $connection) {

    $query = "SELECT * FROM BASKET_PRODUCTS WHERE BASKET_PRODUCTS.FK_BASKET_ID = $basket_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    return $result;
}

function fetch_trader_type_from_product($product_id, $connection) {
    $trader_type = "";
    $query = "SELECT TRADER_TYPE FROM TRADERS, SHOPS, PRODUCTS WHERE PRODUCTS.FK_SHOP_ID = SHOPS.SHOP_ID AND SHOPS.FK_TRADER_ID = TRADERS.TRADER_ID AND PRODUCTS.PRODUCT_ID = $product_id";
    $result = oci_parse($connection,$query);
    oci_execute($result);

    while($rows = oci_fetch_assoc($result)) {
        $trader_type = $rows['TRADER_TYPE'];
    }

    return $trader_type;

}


function remove_from_basket($basket_id, $product_id, $connection) {
    $query = "DELETE FROM BASKET_PRODUCTS WHERE BASKET_PRODUCTS.FK_BASKET_ID = $basket_id AND BASKET_PRODUCTS.FK_PRODUCT_ID = $product_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);
}

function fetch_total_sum_from_baskets($basket_id, $connection) {
    $query = "SELECT * FROM BASKETS WHERE BASKETS.BASKET_ID = $basket_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    $total_sum = 0;

    while($rows = oci_fetch_assoc($result)) {
        $total_sum = $rows['TOTAL_SUM'];
    }

    return $total_sum;
}



function update_total_sum_from_baskets($basket_id, $customer_id, $total_sum, $connection) {
    $query = "UPDATE BASKETS SET TOTAL_SUM = $total_sum WHERE BASKETS.BASKET_ID = $basket_id AND FK_CUSTOMER_ID = $customer_id";
    $result = oci_parse($connection,$query);
    oci_execute($result);
}


function get_profile_image_of_customer($user_id, $connection) {
    $query = "SELECT PROFILE_IMG FROM USERS WHERE USER_ID = $user_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    $profile_img = "";

    while($rows = oci_fetch_assoc($result)) {
        $profile_img = $rows['PROFILE_IMG'];
    }

    return $profile_img;
}


function count_basket_products($basket_id, $connection) {
    $query = "SELECT COUNT(*) FROM BASKET_PRODUCTS WHERE FK_BASKET_ID = $basket_id";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    $count = 0;

    while($rows=oci_fetch_assoc($result)) {
        $count = $count + $rows['COUNT(*)'];
    }

    return $count;
 }

function get_all_collection_slots($collection_slot_id, $connection){
    $query = "SELECT COLLECTION_DAY, COLLECTION_TIME FROM COLLECTION_SLOTS WHERE COLLECTION_SLOT_ID = $collection_slot_id";
    $result = oci_parse($connection,$query);
    oci_execute($result);

    while($rows = oci_fetch_assoc($result)) {
        $collection_day = $rows['COLLECTION_DAY'];
        $collection_time = $rows['COLLECTION_TIME'];
    }

    return $collection_day."&nbsp;&nbsp;&nbsp;(".$collection_time.")";
}