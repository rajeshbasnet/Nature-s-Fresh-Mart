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
          <!--Create account for Customer-->
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="customer-account">
            <fieldset>
              <h4 class="text-center font-rubik">Register for a customer account</h4>
              <div class="icon-container d-flex justify-content-center align-items-center my-4">
                <i class="fab fa-facebook-f mx-3"></i>
                <i class="fab fa-google mx-3"></i>
                <i class="fab fa-linkedin-in mx-3"></i>
              </div>

              <?php
                  if (isset($_POST['customerSubmit'])) {
                      $customerAdd = filter_var($_POST['custAddress'], FILTER_SANITIZE_STRING);
                      if(!empty($_POST['custFirstname']) and !empty($_POST['custLastname']) and !empty($_POST['custEmail']) and !empty($_POST['custAddress']) and !empty($_POST['custPhone']) and !empty($_POST['custPassword'])){
                          if ((preg_match('~[0-9]~', $_POST['custFirstname'])) or (preg_match('~[0-9]~', $_POST['custLastname']))) {
                              $nameerror = "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal;' disabled><i class='fas fa-times-circle' style='color:red;'></i>First name and last name cannot contain numbers</button>";
                          } else{
                              $customerFirstName = filter_var($_POST['custFirstname'], FILTER_SANITIZE_STRING);
                              $customerLastName = filter_var($_POST['custLastname'], FILTER_SANITIZE_STRING);

                              if (filter_var(trim($_POST['custEmail']), FILTER_VALIDATE_EMAIL)) {
                              $custEmail = filter_var($_POST['custEmail'], FILTER_SANITIZE_EMAIL);
                                  if (preg_match('/[A-Z]/', $_POST['custPassword']) and preg_match('/[a-z]/', $_POST['custPassword']) and (1 === preg_match('~[0-9]~', $_POST['custPassword'])) and strlen($_POST['custPassword'])>=6) {
                                      $userPassword = filter_var($_POST['custPassword'],FILTER_SANITIZE_STRING);
                                      $encryptedPass = md5($userPassword);
                                      echo "<button type='button' class='btn btn-outline-success btn-lg' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>Your account was successfully created. To verify your email, please click the verfication link in your email</button>";
                                  } else $passerror = "<button type='button' class='btn btn-outline-danger btn-lg btn-block' style='white-space: normal;' disabled><i class='fas fa-times-circle' style='color:red;'></i>Password must be 6 characters long and must contain at least one uppercase letter, one lowercase letter and a number</button>";
                              } else echo "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>Please enter a valid email</button>";
                          }
                      } else echo "<button type='button' class='btn btn-outline-danger btn-lg' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>Non of the field should be empty</button>";
                  }
              ?>

              <!--Username field-->
              <div class="input-field w-75 mx-auto my-4">
                <div class="username-field position-relative my-3 d-flex">
                  <input type="text" name="custFirstname" class="form-control mr-1" placeholder="Firstname" value="<?php if(isset($_POST['custFirstname'])) echo $_POST['custFirstname'];?>">
                  <i class="fas fa-user custom-icon position-absolute"></i>
                  <input type="text" name="custLastname"  class="form-control ml-1" placeholder="Lastname" value="<?php if(isset($_POST['custLastname'])) echo $_POST['custLastname'];?>">
                </div>
                <?php if (isset($nameerror)) { echo "$nameerror"; } ?>

                <!--Address field-->
                <div class="address-field position-relative my-3">
                  <input type="text" name="custAddress" class="form-control"  value="<?php if(isset($_POST['custAddress'])) echo $_POST['custAddress'];?>" placeholder="Address">
                  <i class="fas fa-address-card custom-icon position-absolute"></i>
                </div>

                <!--Email field-->
                <div class="email-field position-relative my-3">
                  <input type="email" name="custEmail" class="form-control" placeholder="Email" value="<?php if(isset($_POST['custEmail'])) echo $_POST['custEmail'];?>"/>
                  <i class="fas fa-envelope custom-icon position-absolute"></i>
                </div>

                <!--Contact field-->
                <div class="contact-field position-relative my-3">
                  <input type="number" name="custPhone" class="form-control" placeholder="Phone Number" value="<?php if(isset($_POST['custPhone'])) echo $_POST['custPhone'];?>"/>
                  <i class="fas fa-phone custom-icon position-absolute"></i>
                </div>

                <!--Password field-->
                <div class="password-field position-relative my-3">
                  <input type="password" name="custPassword" class="form-control" placeholder="Password" value="<?php if(isset($_POST['custPassword'])) echo $_POST['custPassword'];?>"/>
                  <i class="fas fa-lock custom-icon position-absolute"></i>
                </div>
                <?php if (isset($passerror)) { echo "$passerror"; } ?>

                <p class="text-center">Already have an account ? <a class="signin" href="../signin/signin.html">Click here...</a></p>

                <div class="btn-container text-center my-4">
                  <button class="btn btn-md btn-primary text-uppercase"><input type="submit" name = "customerSubmit" value="SIGN UP"></button>
                </div>
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
