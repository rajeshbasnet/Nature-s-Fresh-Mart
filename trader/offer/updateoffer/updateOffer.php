
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Update Products</title>

  <!--Bootstrap CDN Link-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />

  <!--External CSS Link-->
  <link rel="stylesheet" href="updateoffer.css" />
  <!-- Font awesome CDN -->
    <script src="https://kit.fontawesome.com/962cfbd2be.js" crossorigin="anonymous"></script>

</head>

<!--Trader Panel-->

<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <?php include '../../trader-side-panel.php'; ?>

        <!--Add Products Container Column-->
        <div class="col-xl-10 mx-auto p-0">

          <?php include '../../user_profile_header.php'; ?>

          <?php
            include '../../Connection.php';

            include "update.php";
            $id = $_GET['updateID'];
            $query = "SELECT * FROM ECOMMERCE.offer WHERE offer_id = '$id'";
            $productInfo = oci_parse($connection, $query);
            oci_execute($productInfo);
            while($info = oci_fetch_assoc($productInfo)){
          ?>

            <form action="" method="POST">
              <fieldset>

                <!--Title-->
                <h4 class="addproduct-title my-4">Update Products</h4>

                <div class="input-field__container d-flex">

                  <input type="hidden" name="offer_id" value="<?php echo $info['OFFER_ID'];?>">

                  <!--Left Input Field Column-->
                  <div class="column-left w-100 mr-3">
                    <div class="product-name offer_disc">
                      <label for="offer_disc" class="form-label">Offer amount</label>
                      <input type="text" id="offer_disc" class="form-control" name="offer_disc"
                        placeholder="E.g. 10" value="<?php echo $info['PERCENTAGE'];?>" required/>
                    </div>

                    <br />

                    <div class="product-price offer_desc">
                      <label for="offer_desc" class="form-label">Offer description</label>
                      <input type="text" id="offer_desc" class="form-control" name="offer_desc"
                        placeholder="E.g.TIHAR OFFER" value="<?php echo $info['DESCRIPTION'];?>"  required/>
                    </div>
                  </div>

                </div>

                <!--Button Field Container-->
                <div class="btn-container mt-4 mb-3 d-flex">
                  <button type="submit" class="btn btn-primary w-100 mr-2" name="btnOffer">Save Changes</button>
                  <button class="btn btn-danger w-100 ml-2">Reset All Values</button>
                </div>
              </fieldset>
            </form>

          <?php
          }
          ?>
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
