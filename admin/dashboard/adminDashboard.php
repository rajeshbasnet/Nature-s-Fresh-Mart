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
                $query="SELECT email, password, trader_id, first_name, shop_name  FROM users, trader, shop where $user_id = trader.user_id AND trader.trader_id = shop.shop_id";

                //store the result of the query in a variable called $result
                $result=mysqli_query($connection, $query);
            ?>

            <table>
                <tr>
                    <th>Trader ID</th>
                    <th>Name</th>
                    <th>Shop</th>
                    <th>Login</th>
                </tr>
                <?php
                    while ($row=mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>".$row['trader_id']."</td>";
                        echo "<td>".$row['first_name']."</td>";
                        echo "<td>".$row['shop_name']."</td>";
                        echo '<td><a href="../../form/signin/signin.php?loginID='. $row['email'].'&pass='. $row['password'].'"><i class="fas fa-sign-in-alt" style="color:red;"></i></a></td>';
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

