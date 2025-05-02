<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Show errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

// Receiver email
$to = "tlgeniusblr@gmail.com";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize inputs
    function clean($data) {
        return htmlspecialchars(trim($data));
    }

    $data = array_map('clean', $_POST);

    $mail = new PHPMailer(true);

    try {
        // SMTP config
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tlgeniusblr@gmail.com';
        $mail->Password = 'asjy crsw obmg rdvh'; // App password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('tlgeniusblr@gmail.com', 'Online Registration');
        $mail->addAddress($to);

        // Email content
        $mail->isHTML(false);
        $mail->Subject = 'New Child Registration Submission';
        $mail->Body = "New Registration Details:\n\n" .
                      "Child Name: {$data['cname']}\n" .
                      "Nickname: {$data['nickname']}\n" .
                      "Gender: {$data['gender']}\n" .
                      "DOB: {$data['dob']}\n" .
                      "Home Phone: {$data['homephone']}\n" .
                      "Email: {$data['email']}\n" .
                      "Address: {$data['address']}\n" .
                      "Town/State/Pincode: {$data['town']}\n\n" .
                      "Father Name: {$data['fname']}\n" .
                      "Father Occupation: {$data['father_occu']}\n" .
                      "Father Mobile: {$data['father_mobile']}\n" .
                      "Mother Name: {$data['mname']}\n" .
                      "Mother Occupation: {$data['mother_occu']}\n" .
                      "Mother Mobile: {$data['mother_mobile']}\n" .
                      "Father Education: {$data['father_edu']}\n" .
                      "Mother Education: {$data['mother_edu']}\n" .
                      "Mother Tongue: {$data['mother_tongue']}\n" .
                      "Child's Special Problems/Fears: {$data['reason']}\n";

        $mail->send();
        header("Location: thankyou.html");
        exit;

    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
