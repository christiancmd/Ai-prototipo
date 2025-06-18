<?php
// Establece el encabezado para indicar que la respuesta será JSON
header("Content-Type: application/json");
session_start();
$Id_doctor = $_SESSION['id'] ?? null; // Obtener el id del doctor de la sesion

require "conection.php";

if (!$conection) {
    $response = ["status" => "error", "message" => "Error al conectar con la base de datos."];
    echo json_encode($response);
    exit();
}

// Obtiene el cuerpo de la solicitud POST (que debería ser JSON)
$input = file_get_contents("php://input");
$data = json_decode($input, true); // true para decodificar como array asociativo

// Inicializa una variable para la respuesta JSON
$response = [];

// --- Validar si los datos JSON se recibieron y decodificaron correctamente ---
if (json_last_error() !== JSON_ERROR_NONE || !$data) {
    $response = ["status" => "error", "message" => "Datos JSON inválidos o vacíos."];
    echo json_encode($response);
    exit(); // Termina la ejecución aquí si hay un error de JSON
}

// --- Extraer y sanear los datos recibidos ---
// Usar el operador de fusión de null (??) para un código más limpio en PHP 7.0+
// O el operador ternario clásico para versiones anteriores
$name = $data['name'] ?? '';
$last_name = $data['last_name'] ?? '';
$id_card_number = isset($data['id_card_number']) ? intval($data['id_card_number']) : 0;
$email = $data['email'] ?? '';
$number = isset($data['number']) ? intval($data['number']) : 0;
$age = isset($data['age']) ? intval($data['age']) : 0;
$genre = $data['genre'] ?? '';
$weight = isset($data['weight']) ? floatval($data['weight']) : 0.0;
$height = isset($data['height']) ? floatval($data['height']) : 0.0;
$activity = $data['activity'] ?? "Sedentario"; // Corregido: $data['activity'] en lugar de $data['$activity']
$pathology = $data['pathology'] ?? "Sin patologia";
$reason = $data['reason'] ?? '';

date_default_timezone_set(timezoneId: 'America/Caracas'); ///Ejemplo de zona horaria
$date = date(format: 'Y-m-d');

$query = "INSERT INTO patient (Id_card_number, Name, Last_name, Age, Genre, Email, Contact, date_registration ,Fk_Doctor)
            VALUES($id_card_number, '$name', '$last_name', $age, '$genre', '$email', '$number', '$date' , $Id_doctor)";

$check_id_number = mysqli_query($conection, "SELECT * FROM patient WHERE Id_card_number = $id_card_number");
if (mysqli_num_rows($check_id_number) > 0) {
    $response = ["status" => "error", "message" => "El número de identificación ya está registrado."];
    echo json_encode($response);
    mysqli_close($conection);
    exit();
}

$check_email = mysqli_query($conection, "SELECT * FROM patient WHERE Email = '$email'");
if (mysqli_num_rows($check_email) > 0) {
    $response = ["status" => "error", "message" => "El correo electrónico ya está registrado."];
    echo json_encode($response);
    mysqli_close($conection);
    exit();
}


$result = $conection->query($query);

if (!$result) {
    $response = ["status" => "error", "message" => "Error al insertar el paciente: " . mysqli_error($conection)];
    echo json_encode($response);
    mysqli_close($conection);
    exit();
}

$user_id = $conection->insert_id; // Obtener el ID del paciente recién insertado

$query_status = "INSERT INTO status_patient (Tall, Weigth, Activity, Pathology , Reason, FK_Patient) 
                 VALUES ($height, $weight, '$activity', '$pathology', '$reason' , $user_id)";

$result_status = $conection->query($query_status);

if (!$result_status) {
    $response = ["status" => "error", "message" => "Error al insertar el estado del paciente: " . $conection->error];
    echo json_encode($response);
    $conection->close();
    exit();
}

$response = ["status" => "success", "message" => "Paciente y estado insertados correctamente", "Data" => $data, "number" => $number];
echo json_encode($response);

$conection->close();






