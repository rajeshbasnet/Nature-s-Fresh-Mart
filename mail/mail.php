<?php 

$receiver = "rajeshkhapataribasnet123@gmail.com";
$subject = "Testing";
$body = "This is test mail";
$header = "From: brajesh18@tbc.edu.np";

if(mail($receiver, $subject, $body, $header)) {
    echo 'Email successfully send to '.$receiver;
}else{
    echo "Problem";
}