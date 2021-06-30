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

                        $query2 = "UPDATE users SET password = '$userPass',  first_name = '$firstName', last_name = '$lastName', address = '$userAddress', email = '$userEmail', phone_number = '$userPhone', profile_img= '$userImg' WHERE user_id = '$userId'";

                        $results = oci_parse($connection, $query2);
                        $ups = oci_execute($results);
                        oci_error();
                        // TODO : Button position
                        if($ups){
                            echo "<p style='border-width:2px' class='text-success border border-success mt-4 w-50 mx-auto text-center'><i class='fas fa-check-circle></i>&nbsp;&nbsp;&nbsp;Profile successfully updated</p>";
                        }else{
                            echo "<p style='border-width:2px !important' class='text-danger border border-danger w-50 mx-auto text-center mt-4'><i class='fas fa-times-circle'></i>&nbsp;&nbsp;ERROR: ERROR: COULD NOT EXECUTE QUERY</p>";
                        }
                  } else $passerror = "<p style='border-width:2px !important' class='text-danger border border-danger w-50 mx-auto text-center mt-4'><i class='fas fa-times-circle'></i>&nbsp;&nbsp;ERROR: ERROR: PASSWORD MUST BE 6 CHARS LONG, MUST CONTAIN AT LEAST ONE UPPERCASE, ONE LOWERCASE LETTER AND NUMBER</p>";
                  
                }else $lnameerror = "<p style='border-width:2px !important' class='text-danger border border-danger w-50 mx-auto text-center mt-4'><i class='fas fa-times-circle'></i>&nbsp;&nbsp;ERROR: LASTNAME CANNOT CONTAIN NUMBERS</p>";
                
            } else $fnameerror = "<p style='border-width:2px !important' class='text-danger border border-danger w-50 mx-auto text-center mt-4'><i class='fas fa-times-circle'></i>&nbsp;&nbsp;ERROR: FIRSTNAME CANNOT CONTAIN NUMBERS</p>";
        } else{
            echo "<p style='border-width:2px !important' class='text-danger border border-danger w-50 mx-auto text-center mt-4'><i class='fas fa-times-circle'></i>&nbsp;&nbsp;ERROR: NON OF THE FIELD[S] CAN BE LEFT EMPTY</p>";
        }
    }
?>