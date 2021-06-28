<?php

function fetch_email_from_users($email, $users, $connnection) {
    $query = "SELECT EMAIL FROM USERS, ". $users. " WHERE USERS.USER_ID = ". $users .".USER_ID AND USERS.EMAIL = '$email'";
    $result = oci_parse($connnection, $query);
    oci_execute($result);

    return $result;
}


function count_emails_from_users($email, $users, $connection) {

    $result = fetch_email_from_users($email, $users, $connection);
    $count = 0;

    while($row = oci_fetch_assoc($result)) {
        $count++;
    }

    return $count;
}


function fetch_phonenum_from_users($phonenum, $users, $connnection) {
    $query = "SELECT EMAIL FROM USERS, ". $users. " WHERE USERS.USER_ID = ". $users .".USER_ID AND USERS.PHONE_NUMBER = '$phonenum'";
    $result = oci_parse($connnection, $query);
    oci_execute($result);

    return $result;
}


function count_phonenum_from_users($email, $users, $connection) {

    $result = fetch_phonenum_from_users($email, $users, $connection);
    $count = 0;

    while($row = oci_fetch_assoc($result)) {
        $count++;
    }

    return $count;
}


function check_login($user, $email, $password, $connection) {

    $query = "SELECT * FROM USERS, $user WHERE USERS.USER_ID = $user.USER_ID AND USERS.EMAIL = '$email' AND USERS.PASSWORD = '$password' AND USERS.STATUS = 1";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    $count = 0;
    $user_id = "";

    while($row = oci_fetch_assoc($result)) {
        $user_id = $row['USER_ID'];
        $count++;
    }

    if($count === 1) {
        return array("result" => true, "id" => $user_id);
    }else {
        return array("result" => false, "id" => $user_id);
    }

}