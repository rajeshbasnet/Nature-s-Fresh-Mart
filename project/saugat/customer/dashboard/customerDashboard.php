<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Dashboard</title>

    <!--Bootstrap CDN Link-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />

    <!--External CSS Link-->
    <link rel="stylesheet" href="dashboard.css" />

    <!-- Font awesome CDN -->
    <script src="https://kit.fontawesome.com/962cfbd2be.js" crossorigin="anonymous"></script>

</head>

<!--Trader Panel-->
<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <?php include '../customer-side-panel.php' ?>

        <!--display Products Container Column-->
        <div class="col-xl-10 mx-auto p-0">
            <?php include '../user_profile_header.php'; ?>
            <?php

                //run query to select all records from prodsucts table
                $query="SELECT payment_date, invoice_id, product_name, product_image, item_price, allergy_info, product_info
                        FROM ECOMMERCE.product, payment, invoice , basket_products, basket, orders
                        WHERE product.product_id = basket_products.fk_product_id AND
                        basket_products.fk_basket_id = basket.basket_id AND
                        basket.basket_id = orders.fk_basket_id AND
                        orders.order_id = payment.fk_order_id and
                        payment.transaction_id = invoice.fk_transaction_id AND
                        invoice.fk_user_id = 16";

                $result=oci_parse($connection, $query);
                oci_execute($result);
            ?>

            <table>
                <tr>
                    <th>Purchase Date</th>
                    <th>Invoice ID</th>
                    <th>Product name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Product Info</th>
                    <th>Allergy info</th>
                </tr>
                <?php
                    while ($row = oci_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>".$row['PAYMENT_DATE']."</td>";
                        echo "<td>".$row['INVOICE_ID']."</td>";
                        echo "<td>".$row['PRODUCT_NAME']."</td>";
                        echo '<td><img class = "productImages" src="./images/' . $row['PRODUCT_IMAGE'] .'.jpg' .'" /></td>';
                        echo "<td>".$row['ITEM_PRICE']."</td>";
                        echo "<td class='desc'>".$row['PRODUCT_INFO']."</td>";
                        echo "<td class='desc'>".$row['ALLERGY_INFO']."</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
      </div>
    </div>
    </div>
  </main>

  <!--JS Bootstrap Bundle-->
  <!--JQuery CDN link-->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <!--Font Awesome CDN Link-->
  <script src="https://kit.fontawesome.com/962cfbd2be.js"></script>
</body>

</html>

