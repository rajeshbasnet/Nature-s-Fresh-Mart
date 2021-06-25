<?php

    // include '../../Connection.php';

    if (isset($_POST['saveProfile'])) {
        if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['userEmail']) && !empty($_POST['phone_number']) && !empty($_POST['userAddress']) && !empty($_POST['profile_img']) && !empty($_POST['user_pass'])) {
            if (!(preg_match('~[0-9]~', $_POST['first_name']))) {
                if (!(preg_match('~[0-9]~', $_POST['last_name']))) {
                    if (preg_match('/[A-Z]/', $_POST['user_pass']) and preg_match('/[a-z]/', $_POST['user_pass']) and (1 === preg_match('~[0-9]~', $_POST['user_pass'])) and strlen($_POST['user_pass'])>=6) {
                        $userId = $_POST['user_id'];
                        $firstName = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
                        $lastName = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
                        $encryptedPass = md5($_POST['user_pass']);
                        $userEmail = $_POST['userEmail'];
                        $userPhone = $_POST['phone_number'];
                        $userAddress = filter_var($_POST['userAddress'], FILTER_SANITIZE_STRING);
                        $userImg = $_POST['profile_img'];
                        $userPass = $_POST['user_pass'];

                        $query2 = "UPDATE ECOMMERCE.users SET password = '$userPass',  first_name = '$firstName', last_name = '$lastName', address = '$userAddress', email = '$userEmail', phone_number = '$userPhone', profile_img= '$userImg' WHERE user_id = '$userId'";

                        $results = oci_parse($connection, $query2);
                        $ups = oci_execute($results);
                        oci_error();
                        // TODO : Button position
                        if($ups){
                            echo "<button type='button' class='btn btn-outline-success btn-lg mt-4' style='white-space: normal;' disabled><i class='fas fa-check-circle' style='color:green;'></i>&nbsp;&nbsp;&nbsp;Profile successfully updated</button>";
                        }else{
                            echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: Could not execute query</button>";
                        }
                  } else $passerror = "<button type='button' class='btn btn-outline-danger btn-lg btn-block  mt-4' style='white-space: normal;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;Password must be 6 characters long and must contain at least one uppercase letter, one lowercase letter and a number</button>";
                }else $lnameerror = "<button type='button' class='btn btn-outline-danger btn-lg btn-block  mt-4' style='white-space: normal;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;Last name cannot contain numbers</button>";
            } else $fnameerror = "<button type='button' class='btn btn-outline-danger btn-lg btn-block  mt-4' style='white-space: normal;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;First name cannot contain numbers</button>";
        } else{
            echo "<button type='button' class='btn btn-outline-danger btn-lg mt-4' style='white-space: normal; margin-left: 20%;' disabled><i class='fas fa-times-circle' style='color:red;'></i>&nbsp;&nbsp;&nbsp;ERROR: NON OF THE FIELD[S] CAN BE LEFT EMPTY</button>";
        }
    }
?>
