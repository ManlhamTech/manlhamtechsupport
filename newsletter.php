<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if(isset($_POST['subscriberEmail']) && !empty($_POST['subscriberEmail'])) {
    $subscriberEmail = filter_var($_POST['subscriberEmail'], FILTER_SANITIZE_EMAIL);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'YOUR_BREVO_EMAIL';
        $mail->Password   = 'YOUR_BREVO_API_KEY_OR_PASSWORD';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('info@yourdomain.com', 'Your Company Name');
        $mail->addAddress($subscriberEmail);

        $mail->isHTML(true);
        $mail->Subject = 'Welcome to Our Newsletter!';
        $mail->Body    = '<h2>Thank you for subscribing!</h2><p>You will now receive updates and news directly to your inbox.</p>';
        $mail->AltBody = 'Thank you for subscribing! You will now receive updates and news directly to your inbox.';

        $mail->send();
        echo 'Welcome email sent successfully!';
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Please provide a valid email.';
}
?>
