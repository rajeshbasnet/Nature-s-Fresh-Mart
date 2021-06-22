<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Products</title>

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
        <?php include '../trader-side-panel.php' ?>

        <!--display Products Container Column-->
        <div class="col-xl-10 mx-auto p-0">
            <?php include '../user_profile_header.php'; ?>
            <?php

                //run query to select all records from prodsucts table
                $query="SELECT * FROM product where fk_trader_id = '$trader_id'";

                //store the result of the query in a variable called $result
                $result=mysqli_query($connection, $query);
            ?>

            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Allergy info</th>
                    <th>Availability</th>
                    <th>Max order</th>
                    <th>Min order</th>
                    <th>offer id</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                <?php
                    while ($row=mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>".$row['product_name']."</td>";
                        echo '<td><img class = "productImages" src="./images/' . $row['product_image'] .'.jpg' .'" /></td>';
                        echo "<td>".$row['item_price']."</td>";
                        echo "<td>".$row['product_info']."</td>";
                        echo "<td>".$row['allergy_info']."</td>";
                        echo "<td>".$row['availablility']."</td>";
                        echo "<td>".$row['max_order']."</td>";
                        echo "<td>".$row['min_order']."</td>";
                        echo "<td>".$row['fk_offer_id']."</td>";
                        echo '<td><a href="../updateproduct/updateProduct.php?updateID='. $row['product_id'].'"><i class="fas fa-times-circle" style="color:red;"></i></a></td>';
                        echo '<td><a href="deleteProduct.php?uID='. $row['product_id'].'"><i class="fas fa-pencil-alt" style="color:blue;></i></a></td>';
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

