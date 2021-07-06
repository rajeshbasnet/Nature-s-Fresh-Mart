<?php 

$receiver = "bhansaligaurav1@gmail.com";
$subject = "Testing";
$body = "This is test mail";
$header = "From: bgaurav18@tbc.edu.np";

if(mail($receiver, $subject, $body, $header)) {
    echo 'Email successfully send to '.$receiver;
}else{
    echo "Problem";
}