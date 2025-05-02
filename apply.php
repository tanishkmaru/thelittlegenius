<?php
// Show all errors (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

echo "PHP is working!";

// 🔁 Replace this with your email
$to = "tlgeniusblr@gmail.com";

// Create uploads folder if not exists
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize form inputs
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $qualification = htmlspecialchars($_POST["qualification"]);
    $experience = htmlspecialchars($_POST["experience"]);
    $message = htmlspecialchars($_POST["message"]);

    // Handle file
    $file = $_FILES["resume"];
    $fileName = basename($file["name"]);
    $fileTmp = $file["tmp_name"];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($fileType !== "pdf") {
        echo "Only PDF files are allowed.";
        exit;
    }

    $uniqueName = uniqid() . "_" . $fileName;
    $targetFile = $uploadDir . $uniqueName;

    if (move_uploaded_file($fileTmp, $targetFile)) {
        // Create mail instance
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Gmail SMTP
            $mail->SMTPAuth = true;
            $mail->Username = ''; // 🔁 your Gmail
            $mail->Password = '';   // 🔁 Gmail App Password
            $mail->SMTPSecure = '';
            $mail->Port = ;

            // Recipients
            $mail->setFrom('');
            $mail->addAddress($to);

            // Attachments
            $mail->addAttachment($targetFile); // PDF file

            // Content
            $mail->isHTML(false); // Plain text email
            $mail->Subject = 'New Application - The Little Genius';
            $mail->Body    = "New Teacher Application:\n\n"
                           . "Name: $name\n"
                           . "Email: $email\n"
                           . "Phone: $phone\n"
                           . "Qualification: $qualification\n"
                           . "Experience: $experience years\n"
                           . "Message: $message\n";

            $mail->send();
            header("Location: thankyou.html");
            exit;

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error uploading resume.";
    }
}
?>
