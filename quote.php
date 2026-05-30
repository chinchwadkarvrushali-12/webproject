<?php
session_start();

// ================= FORM SUBMIT ================= //
if(isset($_POST['submit'])){

    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $mobile  = $_POST['mobile'];
    $service = $_POST['service'];
    $message = $_POST['message'];

    // Your Hostinger Email
    $to_email = "info@parsolution.com";

    $subject = "New Get A Quote Enquiry - PAR Solutions";

    $body = "
    New Quote Request

    Name: $name
    Email: $email
    Mobile: $mobile
    Service: $service
    Message: $message
    ";

    // IMPORTANT: Use domain email in From (Hostinger requirement)
    $headers  = "From: info@parsolution.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if(mail($to_email, $subject, $body, $headers)){
        $msg = "Message Sent Successfully!";
    } else {
        $msg = "Message Failed to Send!";
    }
}
?>
