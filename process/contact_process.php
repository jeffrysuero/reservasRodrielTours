<?php

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
use Dotenv\Dotenv;

// Carga el archivo .env desde el directorio padre
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
// Asegúrate de que la respuesta es JSON
header('Content-Type: application/json');

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$response = array();

// Validate form data
if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0; // Disable debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = $_ENV['MAIL_HOST']; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $_ENV['MAIL_USERNAME']; // SMTP username
        $mail->Password = $_ENV['MAIL_PASSWORD']; // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable implicit TLS encryption
        $mail->Port = 465; // TCP port to connect to

        // Recipients
        $mail->setFrom('info@rodrieltours.com', 'Rodirel Tours'); // Your sending email and name
        $mail->addAddress('info@rodrieltours.com'); // Add the recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = "<h1>$subject</h1><p>$message</p><p>From: $name ($email)</p>";
        $mail->AltBody = "$message\n\nFrom: $name ($email)";

        // Send the email
        $mail->send();
        $response['success'] = true;
        $response['message'] = 'Correo enviado correctamente';
    } catch (Exception $e) {
        $response['success'] = false;
        $response['message'] = 'No se pudo enviar el correo. Error: ' . $mail->ErrorInfo;
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Todos los campos son requeridos.';
}

echo json_encode($response);

