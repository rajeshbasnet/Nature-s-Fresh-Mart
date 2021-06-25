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
  <link rel="stylesheet" href="updateproduct.css" />
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

          <div class="user-profile-header">
            <img src="pexels-pixabay-220453.jpg" alt="profile" width="40px" height="40px">
          </div>

          <?php
            include 'update.php';
            $id = $_GET['updateID'];

            $query = "SELECT * FROM ECOMMERCE.product WHERE product_id = '$id'";
            $productInfo = oci_parse($connection, $query);
            oci_execute($productInfo);
            while($info = oci_fetch_assoc($productInfo)){
          ?>

            <form action="" method="POST">
              <fieldset>

                <!--Title-->
                <h4 class="addproduct-title my-4">Update Products</h4>

                <div class="input-field__container d-flex">

                  <input type="hidden" name="up_product-id" value="<?php echo $info['PRODUCT_ID'];?>">

                  <!--Left Input Field Column-->
                  <div class="column-left w-100 mr-3">
                    <div class="product-name">
                      <label for="product-name" class="form-label">Product Name</label>
                      <input type="text" id="up_product-name" class="form-control" name="up_product-name"
                        placeholder="E.g. Whole Grain Sliced Bread" value="<?php echo $info['PRODUCT_NAME'];?>" required/>
                    </div>

                    <br />

                    <div class="product-price">
                      <label for="product-price" class="form-label">Product Price</label>
                      <input type="text" id="up_product-price" class="form-control" name="up_product-price"
                        placeholder="E.g. 35" value="<?php echo $info['ITEM_PRICE'];?>"  required/>
                    </div>

                    <br />

                    <div class="product-quantity">
                      <label for="product-quantity" class="form-label">Quantity in Stock</label>
                      <input type="text" class="form-control" id="up_product-quantity" name="up_product-quantity"
                        placeholder="Total number of available product" value="<?php echo $info['QUANTITY_IN_STOCK'];?>" required/>
                    </div>

                    <br />

                    <div class="product-availability">
                      <label for="form-label" class="product-availability">Product Availability</label>
                      <select name="up_product-availability" id="up_product-availability" class="form-control">
                        <option value="1">Yes (Default)</option>
                        <option value="0">No</option>
                      </select>
                    </div>

                    <br />

                    <div class="min-order">
                      <label for="min-order" class="form-label">Minimum Order</label>
                      <input type="text" class="form-control" id="up_min-order" name="up_min-order" value="<?php echo $info['MIN_ORDER'];?>"  required/>
                    </div>

                    <br />

                    <div class="max-order">
                      <label for="max-order" class="form-label">Maximum Order</label>
                      <input type="text" class="form-control" id="up_max-order" name="up_max-order" value="<?php echo $info['MAX_ORDER'];?>" required/>
                    </div>
                  </div>

                  <div class="column-right w-100 ml-3">
                    <div class="product-desc">
                      <label for="product-desc">Product Description</label>
                      <textarea name="up_product-desc" id="product-desc" rows="5" class="form-control"
                        placeholder="Description about product"  required><?php echo $info['PRODUCT_INFO'];?></textarea>
                    </div>

                    <br />

                    <div class="product-allergy__info">
                      <label for="product-allergy__info" class="form-label">Allergy Information</label>
                      <textarea rows="5" class="form-control" id="product-allergy__info"
                        name="up_product-allergy__info"><?php echo $info['ALLERGY_INFO'];?></textarea>
                    </div>

                    <div style="margin-top: 30px;" class="offer_code">
                      <label for="fk_offer_id" class="form-label">Offer code</label>
                      <input type="number" class="form-control" id="up_fk_offer_id" name="up_fk_offer_id" value="<?php echo $info['FK_OFFER_ID'];?>"/>
                    </div>

                    <br />

                    <div class="img-select">
                      <p>Previously uloaded image</p>
                      <input type="text" name="" value="<?php echo $info['PRODUCT_IMAGE'];?>" disabled>
                      <input type="file" name="up_product-img" id="product-img" />
                    </div>
                  </div>

                </div>

                <!--Button Field Container-->
                <div class="btn-container mt-4 mb-3 d-flex">
                  <button type="submit" class="btn btn-primary w-100 mr-2" name="btnUpdate">Save Changes</button>
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
