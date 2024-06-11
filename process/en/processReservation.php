<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../getDistance.php';
require __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

// Carga el archivo .env desde el directorio padre
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar y sanitizar los datos
    $name = htmlspecialchars($_POST['name']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $phone = htmlspecialchars($_POST['phone']);
    $numVuelo = isset($_POST['numVuelo']) ? htmlspecialchars($_POST['numVuelo']) : '';
    $destination = htmlspecialchars($_POST['destination']);
    $origin = htmlspecialchars($_POST['origin']);
    $date1 = htmlspecialchars($_POST['date1']);
    $suitcases = htmlspecialchars($_POST['suitcases']);
    $adults = htmlspecialchars($_POST['adults']);
    $children = htmlspecialchars($_POST['children']);
    $infants = isset($_POST['infants']) ? htmlspecialchars($_POST['infants']) : '';
    $hour = htmlspecialchars($_POST['hour']);
    $email = htmlspecialchars($_POST['email']);
    $total = 0;
    $distance = getDistanceAndTime($destination, $origin, "K");
    $kl = $distance;
    $page = 'Rodriel Tours';

    if (empty($name) || empty($lastname) || empty($phone) || empty($destination) || empty($origin) || empty($date1) || empty($hour) || empty($suitcases) || empty($adults) || empty($email)) {
        $response['status'] = 'error';
        $response['message'] = 'Todos los campos obligatorios deben ser completados.';
        echo json_encode($response);
        exit;
    }

    // Configurar conexión a la base de datos
    $servername = $_ENV['DB_HOST'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $dbname = $_ENV['DB_DATABASE'];

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        $response['success'] = false;
        $response['message'] = "Conexión fallida: " . $conn->connect_error;
        echo json_encode($response);
        exit();
    } else {
        // Puedes usar un log en PHP para depuración
        error_log("Conexión a la base de datos exitosa");
    }


    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        $letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numeroServicio = mt_rand(100000, 999999);
        $letraAleatoria = $letras[rand(0, strlen($letras) - 1)];
        $numeroServicioConLetra = $numeroServicio . $letraAleatoria;

        // Insertar en la tabla clients
        $stmt1 = $conn->prepare("INSERT INTO clients (name, lastName, phone,email) VALUES (?, ?, ?, ?)");
        if (!$stmt1) {
            throw new Exception("Error en la preparación de la declaración (clients): " . $conn->error);
        }
        $stmt1->bind_param("ssss", $name, $lastname, $phone, $email);

        if (!$stmt1->execute()) {
            throw new Exception("Error al insertar en clients: " . $stmt1->error);
        }

        // Obtener el ID del cliente insertado
        $clientId = $conn->insert_id;

        // Insertar en la tabla reservations
        $stmt2 = $conn->prepare("INSERT INTO reservations (total_cost, min_KM, suitcases, numPeople, numServcice, arrivalDate, hour, clientId, airport, hotel, num_air, numChildren, numInfant, Datellegada, page) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt2) {
            throw new Exception("Error en la preparación de la declaración (reservations): " . $conn->error);
        }
        $stmt2->bind_param("dsiisssisssiiss", $total, $kl, $suitcases, $adults, $numeroServicioConLetra, $date1, $hour, $clientId, $destination, $origin, $numVuelo, $children, $infants, $date1, $page);

        if (!$stmt2->execute()) {
            throw new Exception("Error al insertar en reservations: " . $stmt2->error);
        }

        // Confirmar la transacción
        $conn->commit();

        /*config send email reservation*/
        if (!empty($email)) {
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
                $mail->setFrom('info@rodrieltours.com', 'Rodriel Tours'); // Your sending email and name
                $mail->addAddress($email); // Add the recipient
                $mail->addAddress('info@rodrieltours.com');
                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Reservation';
                $mail->AddEmbeddedImage('../../images/logor.png', 'logo', 'logor.png');
                $mail->Body = "
                <h1>Reservation Confirmation</h1>
                <p><img src='cid:logo' alt='Rodriel Tours' style='width:150px;'></p>
                <p>We are pleased to inform you that we have received your reservation. Below are the details:</p>
                <ul>
                    <li><strong>First Name:</strong> " . htmlspecialchars($name) . "</li>
                    <li><strong>Last Name:</strong> " . htmlspecialchars($lastname) . "</li>
                    <li><strong>Phone:</strong> " . htmlspecialchars($phone) . "</li>
                    <li><strong>Origin:</strong> " . htmlspecialchars($origin) . "</li>
                    <li><strong>Destination:</strong> " . htmlspecialchars($destination) . "</li>
                    <li><strong>Reservation Number:</strong> " . htmlspecialchars($numeroServicioConLetra) . "</li>
                    <li><strong>Reservation Date:</strong> " . htmlspecialchars($date1) . "</li>
                    <li><strong>Time:</strong> " . htmlspecialchars($hour) . "</li>
                    <li><strong>Flight Number:</strong> " . htmlspecialchars($numVuelo) . "</li>
                    <li><strong>Suitcases:</strong> " . htmlspecialchars($suitcases) . "</li>
                    <li><strong>Adults:</strong> " . htmlspecialchars($adults) . "</li>
                    <li><strong>Children:</strong> " . htmlspecialchars($children) . "</li>
                </ul>
                <p>If you need to make any changes or have any additional questions, please do not hesitate to contact us. We are here to ensure your experience is as pleasant as possible.</p>
                <p>We appreciate your preference.</p>
                <p>Best regards,</p>
                <p><strong>Company:</strong> rodrieltours<br>
                <strong>Phone:</strong> 809-645-1945<br>
                <strong>Email:</strong> info@rodrieltours.com</p>";

                // $mail->AltBody = "$message\n\nFrom: $name ($email)";


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
        /*end config send email reservation*/

        $response['success'] = true;
        $response['message'] = "Datos insertados correctamente";
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollback();

        $response['success'] = false;
        $response['message'] = $e->getMessage();
    } finally {
        // Cerrar las declaraciones si fueron inicializadas
        if (isset($stmt1) && $stmt1 !== false) {
            $stmt1->close();
        }
        if (isset($stmt2) && $stmt2 !== false) {
            $stmt2->close();
        }
        // Cerrar la conexión
        $conn->close();
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Método de solicitud no válido.';
    echo json_encode($response);
}

echo json_encode($response);
