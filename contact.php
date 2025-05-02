<?php
// Collect form data
$name = $_POST['fullname'];
$email = $_POST['email'];
$message = $_POST['message'];

// Your email address
$to = "tanishkamaru02@gmail.com"; // <-- Change this to your actual email
$subject = "New Message from Contact Form";

// Email body
$body = "You have received a new message from your website:\n\n";
$body .= "Name: $name\n";
$body .= "Email: $email\n";
$body .= "Message:\n$message\n";

// Send the email
$success = mail($to, $subject, $body);

// Simple feedback
if ($success) {
    echo "Message sent successfully!";
} else {
    echo "Sorry, something went wrong. Please try again later.";
}
?>
