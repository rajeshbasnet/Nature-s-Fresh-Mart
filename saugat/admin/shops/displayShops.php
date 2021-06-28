
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Display Products</title>

    <!--Bootstrap CDN Link-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />

    <!--External CSS Link-->
    <link rel="stylesheet" href="displayShops.css" />

    <!-- Font awesome CDN -->
    <script src="https://kit.fontawesome.com/962cfbd2be.js" crossorigin="anonymous"></script>

</head>

<!--Trader Panel-->
<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <?php include '../admin-side-panel.php' ?>

        <!--display Products Container Column-->
        <div class="col-xl-10 mx-auto p-0">
            <?php include '../user_profile_header.php'; ?>
            <?php

                //run query to select all records from prodsucts table
                $query="SELECT * FROM  ECOMMERCE.trader,  where fk_shop_id = 80";

                //store the result of the query in a variable called $result
                $result=oci_parse($connection, $query);
                oci_execute($result);
            ?>

            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Quantity in stock</th>
                    <th>Allergy info</th>
                    <th>Availability</th>
                    <th>Max order</th>
                    <th>Min order</th>
                    <th>offer id</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                <?php
                    while (($row = oci_fetch_assoc($result))){
                        echo "<tr>";
                            echo "<td>".$row['PRODUCT_NAME']."</td>";
                            echo '<td  class = "productImages"><img width = "100px" height="100px"  src="./images/' . $row['PRODUCT_IMAGE'] .'.jpg' .'" /></td>';
                            echo "<td>".$row['ITEM_PRICE']."</td>";
                            echo "<td style = 'width:200px;'>".$row['PRODUCT_INFO']."</td>";
                            echo "<td>".$row['QUANTITY_IN_STOCK']."</td>";
                            echo "<td>".$row['ALLERGY_INFO']."</td>";
                            echo "<td>".$row['AVAILABLILITY']."</td>";
                            echo "<td>".$row['MAX_ORDER']."</td>";
                            echo "<td>".$row['MIN_ORDER']."</td>";
                            echo "<td>".$row['FK_OFFER_ID']."</td>";
                            echo '<td><a href="../updateproduct/updateProduct.php?updateID='. $row['PRODUCT_ID'].'"><i class="fas fa-pencil-alt fa-2x" style="color:blue;"></i></a></td>';
                            echo '<td><a href="deleteProduct.php?uID='. $row['PRODUCT_ID'].'"><i class="fas fa-times-circle fa-2x" style="color:red;"></i></a></td>';
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

