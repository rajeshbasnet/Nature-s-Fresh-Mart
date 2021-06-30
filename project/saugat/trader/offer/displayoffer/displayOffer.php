<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Display Offer</title>

    <!--Bootstrap CDN Link-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />

    <!--External CSS Link-->
    <link rel="stylesheet" href="displayOffer.css" />

    <!-- Font awesome CDN -->
    <script src="https://kit.fontawesome.com/962cfbd2be.js" crossorigin="anonymous"></script>

</head>

<!--Trader Panel-->
<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <?php include '../../trader-side-panel.php'; ?>

        <!--display Products Container Column-->
        <div class="col-xl-10 mx-auto p-0">
            <?php include '../../user_profile_header.php'; ?>
            <?php

                //run query to select all records from table
                $query="SELECT * FROM offer where fk_trader_id = 30";

                //store the result of the query in a variable called $result
                $result=oci_parse($connection, $query);
                oci_execute($result);
            ?>

            <table>
                <tr>
                    <th>Offer id</th>
                    <th>Offer amount</th>
                    <th>Offer description</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                <?php
                    while (($row = oci_fetch_assoc($result))){
                        echo "<tr>";
                            echo "<td>".$row['OFFER_ID']."</td>";
                            echo "<td>".$row['PERCENTAGE']."</td>";
                            echo "<td>".$row['DESCRIPTION']."</td>";
                            echo '<td><a href="../updateoffer/updateOffer.php?updateID='. $row['OFFER_ID'].'"><i class="fas fa-pencil-alt fa-2x" style="color:blue;"></i></a></td>';
                            echo '<td><a href="deleteOffer.php?uID='. $row['OFFER_ID'].'"><i class="fas fa-times-circle fa-2x" style="color:red;"></i></a></td>';
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

