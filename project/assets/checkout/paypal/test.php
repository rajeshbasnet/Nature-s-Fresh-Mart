<?php

include 'Connection.php';

    //from paypal.php url
    // $basketID = $_GET['basketID'];
    // $collectionID = $_GET['collectionID'];
    // $userID = $_GET['userID'];

    //check if connection was successful
    if ($connection) {
        //making invoice and sending it to trader via mail
        $query3 = "SELECT DISTINCT traders.user_id FROM ORDERS, BASKETS, BASKET_PRODUCTS, PRODUCTS, users, traders, shops
            WHERE orders.order_id = (SELECT MAX(order_id) FROM orders)
            AND ORDERS.FK_BASKET_ID = BASKETS.BASKET_ID AND BASKET_PRODUCTS.FK_BASKET_ID = BASKETS.BASKET_ID
            AND BASKET_PRODUCTS.FK_PRODUCT_ID = PRODUCTS.PRODUCT_ID AND PRODUCTS.fk_shop_id = shops.shop_id
            AND shops.fk_trader_id = traders.trader_id AND traders.user_id = users.user_id";
        $qp3 = oci_parse($connection, $query3);

        if (oci_execute($qp3)) {
            while (($row = oci_fetch_assoc($qp3))){
              foreach ($row as $traderid) {
                $query4 = "SELECT email, first_name, last_name, product_name, item_price, basket_products.quantity, baskets.total_sum FROM ORDERS, BASKETS, BASKET_PRODUCTS, PRODUCTS, users, traders, shops
                  WHERE orders.order_id = (SELECT MAX(order_id) FROM orders) AND ORDERS.FK_BASKET_ID = BASKETS.BASKET_ID
                  AND BASKET_PRODUCTS.FK_BASKET_ID = BASKETS.BASKET_ID AND BASKET_PRODUCTS.FK_PRODUCT_ID = PRODUCTS.PRODUCT_ID AND PRODUCTS.fk_shop_id = shops.shop_id
                  AND shops.fk_trader_id = traders.trader_id AND traders.user_id = users.user_id AND users.user_id = '$traderid'";
                $qp4 = oci_parse($connection, $query4);
                // oci_execute($qp4);

                if (oci_execute($qp4)) {
                  while ($trInfo = oci_fetch_assoc($qp4)){
                    echo $trInfo["EMAIL"].'<br>';
                    echo $trInfo["FIRST_NAME"].'<br>';
                    echo $trInfo["LAST_NAME"].'<br>';
                    echo $trInfo["PRODUCT_NAME"].'<br>';
                    echo $trInfo["ITEM_PRICE"].'<br>';
                    echo $trInfo["TOTAL_SUM"].'<br>';
                  }
                }
              }
            }
            echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>&nbsp;&nbsp;&nbsp;Orders table ma insert bhayo</button>";
        }else{
            echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
        }

    }else{
        echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: check db connection</button>";
    }

?>
