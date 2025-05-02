<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Show errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

// Destination email
$to = "tlgeniusblr@gmail.com";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Clean form input
    function clean($data) {
        return htmlspecialchars(trim($data));
    }

    $data = array_map('clean', $_POST);

    $mail = new PHPMailer(true);

    try {
        // SMTP Setup
        $mail->isSMTP();
        $mail->Host = '';
        $mail->SMTPAuth = ;
        $mail->Username = ''; // your Gmail
        $mail->Password = '';   // Gmail App Password
        $mail->SMTPSecure = '';
        $mail->Port = 587;

        // Email setup
        $mail->setFrom('tlgeniusblr@gmail.com', 'Admission Enquiry');
        $mail->addAddress($to);

        // Email content
        $mail->isHTML(false);
        $mail->Subject = 'New Admission Enquiry';
        $mail->Body = "New Enquiry Details:\n\n" .
                      "Child Name: {$data['cname']}\n" .
                      "Parent/Guardian Name: {$data['fname']}\n" .
                      "Gender: {$data['gender']}\n" .
                      "Age: {$data['dob']}\n" .
                      "Phone: {$data['homephone']}\n" .
                      "Email: {$data['email']}\n" .
                      "Address: {$data['address']}\n" .
                      "Message: {$data['reason']}\n";

        $mail->send();
        header("Location: thankyou.html");
        exit;

    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
