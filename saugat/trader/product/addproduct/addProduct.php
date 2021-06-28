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
  <link rel="stylesheet" href="addproduct.css" />

  <!-- Font awesome CDN -->
    <script src="https://kit.fontawesome.com/962cfbd2be.js" crossorigin="anonymous"></script>

</head>

<!--Trader Panel-->
<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <?php include '../../trader-side-panel.php' ?>

        <!--Add Products Container Column-->
        <div class="col-xl-10 mx-auto p-0">

          <?php include '../../user_profile_header.php'; ?>
          <?php include 'insertProduct.php'; ?>

          <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <fieldset>

              <!--Title-->
              <h4 class="addproduct-title my-4">Add Products</h4>

              <div class="input-field__container d-flex">

                <!--Left Input Field Column-->
                <div class="column-left w-100 mr-3">
                  <div class="product-name">
                    <label for="product-name" class="form-label">Product Name</label>
                    <input type="text" id="product-name" class="form-control" name="product-name"
                      placeholder="E.g. Whole Grain Sliced Bread" />
                  </div>

                  <br />

                  <div class="product-price">
                    <label for="product-price" class="form-label">Product Price</label>
                    <input type="number" id="product-price" class="form-control" name="product-price"
                      placeholder="E.g. 35" />
                  </div>
                  <?php if (isset($pnameerror)){ echo $pnameerror;} ?>

                  <br />

                  <div class="product-quantity">
                    <label for="product-quantity" class="form-label">Quantity in stock</label>
                    <input type="number" class="form-control" id="product-quantity" name="product-quantity"
                      placeholder="Total number of available product" />
                  </div>

                  <br />

                  <div class="product-availability">
                    <label for="form-label" class="product-availability">Product Availability</label>
                    <select name="product-availability" id="product-availability" class="form-control">
                      <option value="1">Yes (Default)</option>
                      <option value="0">No</option>
                    </select>
                  </div>

                  <br />

                  <div class="min-order">
                    <label for="min-order" class="form-label">Minimum Order</label>
                    <input type="number" class="form-control" id="min-order" name="min-order" />
                  </div>

                  <br />

                  <div class="max-order">
                    <label for="max-order" class="form-label">Maximum Order</label>
                    <input type="number" class="form-control" id="max-order" name="max-order" />
                  </div>
                </div>

                <div class="column-right w-100 ml-3">
                  <div class="product-desc">
                    <label for="product-desc">Product Description</label>
                    <textarea name="product-desc" id="product-desc" rows="5" class="form-control"
                      placeholder="Description about product"></textarea>
                  </div>

                  <br />

                  <div class="product-allergy__info">
                    <label for="product-allergy__info" class="form-label">Allergy Information</label>
                    <textarea rows="5" class="form-control" id="product-allergy__info"
                      name="product-allergy__info"></textarea>
                  </div>

                  <div style="margin-top: 30px;" class="offer_code">
                    <label for="fk_offer_id" class="form-label">Offer code</label>
                    <input type="number" class="form-control" id="fk_offer_id" name="fk_offer_id" />
                  </div>

                  <br />

                  <div class="img-select">
                    <input type="file" name="product-img" id="product-img" />
                  </div>
                </div>

              </div>

              <!--Button Field Container-->
              <div class="btn-container mt-4 mb-3 d-flex">
                <button type="submit" name="insertP" class="btn btn-primary w-100 mr-2">ADD PRODUCT</button>
                <button type="reset" class="btn btn-danger w-100 ml-2">CLEAR ALL</button>
              </div>
            </fieldset>
          </form>


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
