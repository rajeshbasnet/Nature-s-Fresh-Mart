<?php


if (isset($_POST['saveProfile'])) {

    if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['userEmail']) && !empty($_POST['phone_number']) && !empty($_POST['userAddress'])) {
        if (!(preg_match('~[0-9]~', $_POST['first_name']))) {
            if (!(preg_match('~[0-9]~', $_POST['last_name']))) {

                $userId = $_POST['user_id'];
                $firstName = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
                $lastName = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
                $userEmail = trim(htmlspecialchars($_POST['userEmail']));
                $userPhone = trim(htmlspecialchars($_POST['phone_number']));
                $userAddress = filter_var($_POST['userAddress'], FILTER_SANITIZE_STRING);
                $userPass = "";
                $profile = "";
                $random_image_name = "";


                if(!empty($_POST['user_pass'])) {

                    if (preg_match('/[A-Z]/', $_POST['user_pass']) and preg_match('/[a-z]/', $_POST['user_pass']) and (1 === preg_match('~[0-9]~', $_POST['user_pass'])) and strlen($_POST['user_pass']) >= 6) {

                        $userPass = md5($_POST['user_pass']);

                    } else $passerror = "<p style='border-width:1px !important' class='text-danger border border-danger text-center mt-4'><i class='fas fa-times-circle'></i>&nbsp;&nbsp;ERROR: ERROR: PASSWORD MUST BE 6 CHARS LONG, MUST CONTAIN AT LEAST ONE UPPERCASE, ONE LOWERCASE LETTER AND NUMBER</p>";

                }

                if(!empty($_FILES['profile_img']['name'])) {
                    $profile = $_FILES['profile_img'];

                    $image_name = "profile-img";

                    $temp_path = $profile['tmp_name'];

                    $actual_path = 'C:\xampp\htdocs\website\project\panels\customer-panel\profile\profile-img\\'. $image_name.'.jpg';

                    if(!empty($profile['name'])) {
                        move_uploaded_file($temp_path, $actual_path);
                    }
                }

                $query = "UPDATE USERS SET FIRST_NAME = '$firstName', LAST_NAME = '$lastName', ADDRESS = '$userAddress', EMAIL = '$userEmail', PHONE_NUMBER = '$userPhone'";


                if(!empty($userPass)) {
                    $query .= ", PASSWORD = '$userPass";
                }

                if(!empty($profile['name'])) {
                    $query .= ", PROFILE_IMG = '$image_name.jpg'";
                }

                $query .= " WHERE USERS.USER_ID = $userId";

                $results = oci_parse($connection, $query);
                $ups = oci_execute($results);
                oci_error();

                if ($ups) {
                    echo "<p style='border-width:2px; font-size: 1.1rem; font-weight : bold;' class='text-success border border-success w-50 mx-auto mt-4 p-2 text-center'><i class='fas fa-check-circle'></i>&nbsp;&nbsp;&nbsp;SUCCESS: PROFILE SUCCESSFULLY UPDATE</p>";?>

                    <script>
                        setTimeout(() =>{
                            window.location.href ='/website/project/panels/customer-panel/profile/customer-profile.php';
                        },2000)
                    </script>

                <?php } else {
                    echo "<p style='border-width:2px !important;font-size: 1.1rem; font-weight : bold;' class='text-danger border border-danger w-50 mx-auto text-center p-2 mt-4'><i class='fas fa-times-circle'></i>&nbsp;&nbsp;ERROR: ERROR: COULD NOT EXECUTE QUERY</p>";
                }

            } else $lnameerror = "<p style='border-width:1px !important' class='text-danger border border-danger text-center mt-4'><i class='fas fa-times-circle'></i>&nbsp;&nbsp;ERROR: LASTNAME CANNOT CONTAIN NUMBERS</p>";

        } else $fnameerror = "<p style='border-width:1px !important' class='text-danger border border-danger text-center mt-4'><i class='fas fa-times-circle'></i>&nbsp;&nbsp;ERROR: FIRSTNAME CANNOT CONTAIN NUMBERS</p>";
    } else {
        echo "<p style='border-width:2px !important; font-size: 1.1rem; font-weight : bold;' class='text-danger border p-2 border-danger w-50 mx-auto text-center mt-4'><i class='fas fa-times-circle'></i>&nbsp;&nbsp;ERROR: NON OF THE FIELD[S] CAN BE LEFT EMPTY</p>";
    }
}
