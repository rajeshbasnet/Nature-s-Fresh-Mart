<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <!--Bootstrap CDN Link-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />

    <!--External CSS Link-->
    <link rel="stylesheet" href="profile.css" />
    <!-- Font awesome CDN -->
    <script src="https://kit.fontawesome.com/962cfbd2be.js" crossorigin="anonymous"></script>
</head>

<!--Trader Panel-->

<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <?php include '../admin-side-panel.php' ?>

                <!--Add Products Container Column-->
                <div class="col-xl-10 mx-auto p-0">
                    <?php
                        include '../Connection.php';
                        include '../user_profile_header.php';
                        include 'updateProfile.php';
                    ?>
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <fieldset>
                            <!--Title-->
                            <h4 class="addproduct-title my-4">Your Profile</h4>

                            <div class="input-field__container d-flex">

                                <!--Left Input Field Column-->
                                <div class="column-left w-100 mr-3">

                                    <?php
                                        $query = "SELECT * FROM users WHERE user_id = 15";
                                        $profile = oci_parse($connection, $query);
                                        oci_execute($profile);
                                    ?>

                                    <br>
                                    <?php
                                        while ($row=oci_fetch_assoc($profile)){
                                            echo "<input type='hidden' name='user_id' value='".$row['USER_ID']."'>";

                                            echo "<div class='img-select'>";
                                                echo "<input type='file' name='profile_img' id='profile_img' />";
                                                echo "<p>Previous image:</p>";
                                                echo "<input type='text' value='".$row['PROFILE_IMG']."' disabled>";
                                            echo "</div>";
                                        echo "</div>";

                                        echo "<div class='column-right w-100 ml-3'>";
                                            echo "<div class='Username first_name mb-4'>";
                                                echo "<label for='first_name' class='form-label'>First name</label>";
                                                echo "<input type='text' class='form-control' id='first_name' name='first_name'  value='".$row['FIRST_NAME']."'>";
                                            echo "</div>";
                                            if (isset($fnameerror)) {
                                                echo $fnameerror;
                                            }

                                            echo "<div class='Username last_name mb-4'>";
                                                echo "<label for='last_name' class='form-label'>Last name</label>";
                                                echo "<input type='text' class='form-control' id='last_name' name='last_name'  value='".$row['LAST_NAME']."'>";
                                            echo "</div>";

                                            if (isset($lnameerror)) {
                                                echo $lnameerror;
                                            }


                                            echo "<div class='email my-4'>";
                                                echo "<label for='userEmail' class='form-label'>Email</label>";
                                                echo "<input type='email' class='form-control' id='userEmail' name='userEmail'  value='".$row['EMAIL']."'>";
                                            echo "</div>";

                                            echo "<div class='email upassword my-4'>";
                                                echo "<label for='user_pass' class='form-label'>Password</label>";
                                                echo "<input type='password' class='form-control' id='user_pass' name='user_pass'  value='".$row['PASSWORD']."'>";
                                            echo "</div>";

                                            if (isset($passerror)) {
                                                echo $passerror;
                                            }


                                            echo "<div class='phone-number my-4'>";
                                                echo "<label for='phone-number' class='form-label'>Phone number</label>";
                                                echo "<input type='number' class='form-control' id='phone-number' name='phone_number'  value='".$row['PHONE_NUMBER']."'>";
                                            echo "</div>";


                                            echo "<div class='address my-4'>";
                                                echo "<label for='address' class='form-label'>Address</label>";
                                                echo "<input type='text' class='form-control' id='address' name='userAddress'  value='".$row['ADDRESS']."'>";
                                            echo "</div>";

                                            echo "<div class='btn-container my-4'>";
                                                echo "<button type='submit' name='saveProfile' class='btn w-100'>Save Changes</button>";
                                            echo "</div>";
                                        echo "</div>";
                                        }
                                    ?>

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
