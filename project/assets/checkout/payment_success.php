<?php session_start(); ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>payment Success</title>
        <!--Bootstrap CDN Link-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>

        <!--External CSS Link-->
        <link rel="stylesheet" href="displayProducts.css"/>

        <!-- Font awesome CDN -->
        <script src="https://kit.fontawesome.com/962cfbd2be.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <?php
    include '../../connection/connect.php';
    $connection = getConnection();


    include_once "../trader-types/functions.php";

    //GET from paypal.php url
    $collection_id = $_GET['collection_slot_id'];
    $user_id = $_SESSION['user'];
    $customer_id = get_user_type_id($user_id, $connection, "CUSTOMERS");
    $basket_id = get_basket_id_from_baskets($customer_id, $connection);
    $total_sum = fetch_total_sum_from_baskets($basket_id, $connection);

    //check if connection was successful

    if (isset($_SESSION['user'])) {

        //insert into order after payment success
        $query1 = "INSERT INTO orders (order_id, fk_basket_id, fk_collection_slot_id, payment_date)
                VALUES (null, '$basket_id', $collection_id, sysdate)";
        $qp1 = oci_parse($connection, $query1);

        if (oci_execute($qp1)) {
            echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>&nbsp;&nbsp;&nbsp;Orders table ma insert bhayo</button>";
        } else {
            echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
        }

        //making invoice and sending it to customer via mail
        $query2 = "SELECT order_id, email, customers.user_id, orders.payment_date,  first_name, last_name, product_name, item_price, basket_products.quantity
            FROM customers, users, products, basket_products, orders, baskets WHERE
            products.product_id = basket_products.fk_product_id AND basket_products.fk_basket_id = baskets.basket_id AND baskets.fk_customer_id = customers.customer_id AND
            customers.user_id = users.user_id AND baskets.basket_id = orders.fk_basket_id AND users.user_id = $user_id";
        $qp2 = oci_parse($connection, $query2);
        oci_execute($qp2);
        include 'Customerinvoice.php';
        // if (oci_execute($qp2)) {
        // include 'Customerinvoice.php';
        // ob_start();
        // include "Customerinvoice.php";
        // $msg = ob_get_clean();
        // $header = "From: tsaugat18@tbc.edu.np";
        // $header .= "MIME-Version: 1.0\r\n";
        // $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // send email to customer
        // mail(".$row['EMAIL'].","Nature's Fresh Mart - INVOICE",$msg, $header);
        //     echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>&nbsp;&nbsp;&nbsp;customer lai mail gayo</button>";
        // }else{
        //     echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
        // }

        //making invoice and sending it to trader via mail
        $query3 = "SELECT DISTINCT traders.user_id, email FROM ORDERS, BASKETS, BASKET_PRODUCTS, PRODUCTS, users, traders, shops
                WHERE orders.order_id = (SELECT MAX(order_id) FROM orders)
                AND ORDERS.FK_BASKET_ID = BASKETS.BASKET_ID AND BASKET_PRODUCTS.FK_BASKET_ID = BASKETS.BASKET_ID
                AND BASKET_PRODUCTS.FK_PRODUCT_ID = PRODUCTS.PRODUCT_ID AND PRODUCTS.fk_shop_id = shops.shop_id
                AND shops.fk_trader_id = traders.trader_id AND traders.user_id = users.user_id";
        $qp3 = oci_parse($connection, $query3);

        // if (oci_execute($qp3)) {
        //     while (($row = oci_fetch_assoc($qp3))){
        //       foreach ($row as $traderid) {
        //         $query4 = "SELECT email, first_name, last_name, product_name, item_price, basket_products.quantity, baskets.total_sum FROM ORDERS, BASKETS, BASKET_PRODUCTS, PRODUCTS, users, traders, shops
        //           WHERE orders.order_id = (SELECT MAX(order_id) FROM orders) AND ORDERS.FK_BASKET_ID = BASKETS.BASKET_ID
        //           AND BASKET_PRODUCTS.FK_BASKET_ID = BASKETS.BASKET_ID AND BASKET_PRODUCTS.FK_PRODUCT_ID = PRODUCTS.PRODUCT_ID AND PRODUCTS.fk_shop_id = shops.shop_id
        //           AND shops.fk_trader_id = traders.trader_id AND traders.user_id = users.user_id AND users.user_id = '$traderid'";
        //         $qp4 = oci_parse($connection, $query4);
        //         // oci_execute($qp4);

        //         if (oci_execute($qp4)) {
        //             ob_start();
        //             include "invoice.php";
        //             $msg = ob_get_clean();
        //             $header = "From: tsaugat18@tbc.edu.np";
        //             $header .= "MIME-Version: 1.0\r\n";
        //             $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        //             // send email to customer
        //             mail(".$row['email'].","Nature's Fresh Mart - INVOICE",$msg, $header);
        //             while ($trInfo = oci_fetch_assoc($qp4)){
        //                 echo $trInfo["EMAIL"].'<br>';
        //                 echo $trInfo["FIRST_NAME"].'<br>';
        //                 echo $trInfo["LAST_NAME"].'<br>';
        //                 echo $trInfo["PRODUCT_NAME"].'<br>';
        //                 echo $trInfo["ITEM_PRICE"].'<br>';
        //                 echo $trInfo["TOTAL_SUM"].'<br>';
        //             }
        //         }
        //       }
        //     }
        //     echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>&nbsp;&nbsp;&nbsp;Orders table ma insert bhayo</button>";
        // }else{
        //     echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
        // }
    } else {
        header('Location: /website/project/homepage.php');
    }

    ?>

    </body>
    </html>
<?php

