<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("mail.log", "/tmp/mail.log");
ini_set("mail.add_x_header", TRUE);



    $name = "QUALIBRAIN";
    $email = "eduardo.neves@qualidoc.com.br";
    $message = "teste";
    $from = 'From: pricing.cocktpi.com.br';
    $to = 'neves1610@gmail.com';
    $subject = 'Customer Inquiry';
    $body = "From: $name\n E-Mail: $email\n Message:\n $message";

    
        if (mail ($to, $subject, $body, $from)) {
            echo '<p>Your message has been sent!</p>';
        } else {
            echo '<p>Something went wrong, go back and try again!</p>';
        }
    



?> 
