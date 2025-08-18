<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure PHPMailer is installed via Composer

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '94a098002@smtp-brevo.com'; // your SMTP login
        $mail->Password   = '**********sdqgny';        // your SMTP key or password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender & recipient
        $mail->setFrom('admin@manlham-tech', 'Manlham Tech Support');
        $mail->addAddress($email); // send to subscriber

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to Manlham Tech Newsletter';
        $mail->Body    = "Hello,<br><br>Thank you for subscribing to our newsletter!<br><br>– Manlham Tech Support";

        $mail->send();
        echo "Thank you for subscribing!";
    } catch (Exception $e) {
        error_log($mail->ErrorInfo);
        echo "Failed to send email. Please try again later.";
    }
} else {
    echo "Invalid request.";
}
?>
