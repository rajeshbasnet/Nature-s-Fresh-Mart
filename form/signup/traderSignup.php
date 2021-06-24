<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>

    <!-- Font awesome CDN -->
    <script
      src="https://kit.fontawesome.com/962cfbd2be.js"
      crossorigin="anonymous"
    ></script>

    <link rel="stylesheet" href="signup.css">

    <title>SIGN UP</title>
  </head>
  <body>

    <div class="custom-container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-6 mx-auto column-first my-5">
         <!--Create Account for Trader-->
         <form action="" method = "POST" class="trader-account" onsubmit="">
          <fieldset>
            <h4 class="text-center">Create your trader Account</h4>
            <div class="icon-container d-flex justify-content-center align-items-center my-4">
              <i class="fab fa-facebook-f mx-3"></i>
              <i class="fab fa-google mx-3"></i>
              <i class="fab fa-linkedin-in mx-3"></i>
            </div>

            <?php
                if (isset($_POST['traderSubmit'])) {
                    if(!empty($_POST['traderFirstname']) and !empty($_POST['traderLastname']) and !empty($_POST['traderEmail']) and !empty($_POST['traderAddress']) and !empty($_POST['traderPhone']) and !empty($_POST['traderProduct'])){
                        $traderAdd = filter_var($_POST['traderAddress'], FILTER_SANITIZE_STRING);
                        if ((preg_match('~[0-9]~', $_POST['traderFirstname'])) or (preg_match('~[0-9]~', $_POST['traderLastname']))) {
                            $nameerror = "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal;' disabled><i class='fas fa-times-circle' style='color:red;'></i>First name and last name cannot contain numbers</button>";
                        } else{
                            $traderFirstName = filter_var($_POST['traderFirstname'], FILTER_SANITIZE_STRING);
                            $traderLastName = filter_var($_POST['traderLastname'], FILTER_SANITIZE_STRING);

                            if (filter_var(trim($_POST['traderEmail']), FILTER_VALIDATE_EMAIL)) {
                                $traderEmail = filter_var($_POST['traderEmail'], FILTER_SANITIZE_EMAIL);
                                echo "<button type='button' class='btn btn-outline-success btn-lg' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>We have received your request, you will receive a reply in your email within the next 24 hours</button>";
                            } else $emailerror = "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%' disabled><i class='fas fa-times-circle' style='color:red;'></i>Please enter a valid email</button>";
                        }
                        $traderProduct = filter_var($_POST['traderProduct'], FILTER_SANITIZE_STRING);
                    } else echo "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%' disabled><i class='fas fa-times-circle' style='color:red;'></i>Non of the field should be empty</button>";
                }
            ?>

            <div class="input-field w-75 mx-auto my-5">
              <!--name field-->
              <div class="username-field position-relative my-3 d-flex">
                <input type="text" name="traderFirstname" class="form-control mr-1" placeholder="Firstname"  value="<?php if(isset($_POST['traderFirstname'])) echo $_POST['traderFirstname'];?>" required/>
                <i class="fas fa-user custom-icon position-absolute"></i>
                <input type="text" name="traderLastname" class="form-control ml-1" placeholder="Lastname"  value="<?php if(isset($_POST['traderLastname'])) echo $_POST['traderLastname'];?>" required>
              </div>
              <?php if (isset($nameerror)) { echo "$nameerror"; } ?>

              <!--Address field-->
              <div class="address-field position-relative my-3">
                <input type="text" name="traderAddress" class="form-control" value="<?php if(isset($_POST['traderAddress'])) echo $_POST['traderAddress'];?>" placeholder="Address" required>
                <i class="fas fa-address-card custom-icon position-absolute"></i>
              </div>

              <!--Email field-->
              <div class="email-field position-relative my-3">
                <input type="email" name="traderEmail" class="form-control" placeholder="Email" value="<?php if(isset($_POST['traderEmail'])) echo $_POST['traderEmail'];?>"/>
                <i class="fas fa-envelope custom-icon position-absolute"></i>
              </div>
              <?php if (isset($emailerror)) { echo "$emailerror"; } ?>

              <!--Contact field-->
              <div class="contact-field position-relative my-3">
                <input type="number" name="traderPhone" class="form-control" placeholder="Phone Number" value="<?php if(isset($_POST['traderPhone'])) echo $_POST['traderPhone'];?>"/>
                <i class="fas fa-phone custom-icon position-absolute"></i>
              </div>

              <!--Shop field-->
              <div class="shop-field position-relative my-3">
                <input type="text" name="traderProduct" class="form-control" value="<?php if(isset($_POST['traderProduct'])) echo $_POST['traderProduct'];?>" placeholder="Product Type ( Eg. FishMonger, Greengrocer etc... )"/>
                <i class="fab fa-product-hunt custom-icon position-absolute"></i>
              </div>

              <p class="text-center">Already have an account ? <a class="signin" href="#">Click here...</ac></p>

              <div class="btn-container text-center my-4">
                <button type="button" class="btn btn-md btn-primary text-uppercase"><input type="submit" name = "traderSubmit" value="SIGN UP"></button>
              </div>

            </fieldset>
            </form>
        </div>
      </div>
    </div>



    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>
