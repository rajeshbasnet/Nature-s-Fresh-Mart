<!DOCTYPE html>
<html>
<head>
    <title>payment Success</title>
        <!--Bootstrap CDN Link-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />

    <!--External CSS Link-->
    <link rel="stylesheet" href="displayProducts.css" />

    <!-- Font awesome CDN -->
    <script src="https://kit.fontawesome.com/962cfbd2be.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
include 'Connection.php';

    //from paypal.php url
    $basketID = $_GET['basketID'];
    $collectionID = $_GET['collectionID'];
    $userID = $_GET['userID'];
    $cartTotal = $_GET['cartTotal'];

    //check if connection was successful
    if ($connection) {
        //insert into order after payment success
        //chalena bhane "FROM dual" haldine
        $query1 = "INSERT INTO orders (order_id, fk_basket_id, fk_collection_slot_id, payment_date)
                VALUES (null, '$basketID', '$collectionID', sysdate)";
        $qp1 = oci_parse($connection, $query1);

        if (oci_execute($qp1)) {
            echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>&nbsp;&nbsp;&nbsp;Orders table ma insert bhayo</button>";
        }else{
            echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
        }

        //making invoice and sending it to customer via mail
        $query2 = "SELECT order_id, email, customers.user_id, orders.payment_date,  first_name, last_name, product_name, item_price, basket_products.quantity
            FROM customers, users, products, basket_products, orders, baskets WHERE
            products.product_id = basket_products.fk_product_id AND basket_products.fk_basket_id = baskets.basket_id AND baskets.fk_customer_id = customers.customer_id AND
            customers.user_id = users.user_id AND users.user_id = 16 AND baskets.basket_id = orders.fk_basket_id";
        $qp2 = oci_parse($connection, $query2);

        if (oci_execute($qp2)) {
            include 'Customerinvoice.php';
            // ob_start();
            // include "Customerinvoice.php";
            // $msg = ob_get_clean();
            // $header = "From: tsaugat18@tbc.edu.np";
            // $header .= "MIME-Version: 1.0\r\n";
            // $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            // send email to customer
            // mail(".$row['EMAIL'].","Nature's Fresh Mart - INVOICE",$msg, $header);
            echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>&nbsp;&nbsp;&nbsp;customer lai mail gayo</button>";
        }else{
            echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
        }
    }else{
        echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: check db connection</button>";
    }

?>

</body>
</html>
<?php

