<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $service = $_POST['service'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {

        // SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;

        // YOUR HOSTINGER EMAIL
        $mail->Username   = 'info@parsolutions.in';

        // YOUR EMAIL PASSWORD
        $mail->Password   = 'YOUR_EMAIL_PASSWORD';

        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // FROM
        $mail->setFrom('info@parsolutions.in', 'PAR Solutions');

        // TO
        $mail->addAddress('info@parsolutions.in');

        // REPLY TO USER
        $mail->addReplyTo($email, $name);

        // EMAIL CONTENT
        $mail->isHTML(true);

        $mail->Subject = "New Website Inquiry";

        $mail->Body = "
        <h2>New Inquiry Received</h2>

        <b>Name:</b> $name <br><br>

        <b>Email:</b> $email <br><br>

        <b>Mobile:</b> $mobile <br><br>

        <b>Service:</b> $service <br><br>

        <b>Message:</b><br> $message
        ";

        $mail->send();

        echo "
        <script>
            alert('Message Sent Successfully');
            window.location.href='index.php';
        </script>
        ";

    } catch (Exception $e) {

        echo "
        <script>
            alert('Message Failed: {$mail->ErrorInfo}');
            window.history.back();
        </script>
        ";
    }
}
?>