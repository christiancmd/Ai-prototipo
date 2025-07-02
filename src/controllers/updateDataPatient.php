<?php
session_start();
include "conection.php"; // Incluir la conexion a la base de datos
header('Content-Type: application/json');
$Id_doctor = $_SESSION['id'] ?? null; // Obtener el id del doctor de la sesion

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    if ($conection->connect_error) {
        echo json_encode(["status" => "error", "message" => "failed connection"]);
        exit;
    }



    // Lista de campos requeridos
    $fill_Requierments = [
        'name-data-update',
        'last-name-data-update',
        'id-data-update',
        'email-data-update',
        'number-data-update',
        'born-data-update',
        'weight-data-update',
        'height-data-update',
        'activity-data-update',
        'pathology-data-update'
    ];

    // Validación de campos vacíos
    foreach ($fill_Requierments as $camp) {
        if (!isset($_POST[$camp]) || trim($_POST[$camp]) === '') {
            echo json_encode(["status" => "error", "message" => "Falta el campo: $camp"]);
            exit;
        }
    }

    $id_card_number = isset($_POST["id-data-update"]) ? intval(trim($_POST["id-data-update"])) : 0;
    $number = isset($_POST["number-data-update"]) ? intval(trim($_POST["number-data-update"])) : 0;
    $weight = isset($_POST["weight-data-update"]) ? floatval(trim($_POST["weight-data-update"])) : 0.0;
    $height = isset($_POST["height-data-update"]) ? floatval(trim($_POST["height-data-update"])) : 0.0;

    $name = isset($_POST["name-data-update"]) ? trim($_POST["name-data-update"]) : null;
    $last_name = isset($_POST["last-name-data-update"]) ? trim($_POST["last-name-data-update"]) : null;
    $email = isset($_POST["email-data-update"]) ? trim($_POST["email-data-update"]) : null;
    $age = isset($_POST["born-data-update"]) ? trim($_POST["born-data-update"]) : null;
    $activity = isset($_POST["activity-data-update"]) ? trim($_POST["activity-data-update"]) : "Sedentario";
    $reason = isset($_POST["reason-data-update"]) ? trim($_POST["reason-data-update"]) : "Sin motivo";
    $pathology = isset($_POST["pathology-data-update"]) ? trim($_POST["pathology-data-update"]) : "Sin patologia";

    $pathology = $pathology === "Elegir Patologia" ? "Sin patologia" : $pathology;


    // Obtener el ID real del paciente
    $stmt_get_id = $conection->prepare("SELECT Id FROM patient WHERE Id_card_number = ?");
    $stmt_get_id->bind_param("i", $id_card_number);
    $stmt_get_id->execute();
    $result = $stmt_get_id->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "Paciente no encontrado"]);
        exit;
    }

    $row = $result->fetch_assoc();
    $real_patient_id = $row['Id'];

    // Actualizar datos en la tabla patient
    $stmt_patient = $conection->prepare("
UPDATE patient 
SET 
    Id_card_number = ?, 
    Name = ?, 
    Last_name = ?, 
    Age = ?, 
    Email = ?, 
    Contact = ?
WHERE Id = ?
");

    if (!$stmt_patient) {
        echo json_encode(["status" => "error", "message" => "Error preparando la consulta de paciente"]);
        exit;
    }

    $stmt_patient->bind_param(
        "isssssi",
        $id_card_number,
        $name,
        $last_name,
        $age,
        $email,
        $number,
        $real_patient_id // Asumiendo que Id = Id_card_number
    );

    if (!$stmt_patient->execute()) {
        echo json_encode(["status" => "error", "message" => "Error al actualizar datos del paciente"]);
        exit;
    }

    // Actualizar el último estado del paciente en status_patient
    $stmt_status = $conection->prepare("
UPDATE status_patient
SET 
    Weigth = ?, 
    Tall = ?, 
    Activity = ?, 
    Pathology = ?, 
    Reason = ?
WHERE Id = (
    SELECT Id FROM (
        SELECT Id FROM status_patient 
        WHERE FK_Patient = ? 
        ORDER BY Id DESC 
        LIMIT 1
    ) AS latest
)
");

    if (!$stmt_status) {
        echo json_encode(["status" => "error", "message" => "Error preparando la consulta de estado"]);
        exit;
    }

    $stmt_status->bind_param(
        "iisssi",
        $weight,
        $height,
        $activity,
        $pathology,
        $reason,
        $id_card_number // FK_Patient = Id del paciente
    );

    if (!$stmt_status->execute()) {
        echo json_encode(["status" => "error", "message" => "Error al actualizar estado del paciente"]);
        exit;
    }

    echo json_encode(["status" => "success", "message" => "Datos del paciente actualizados correctamente"]);

    //echo json_encode(["status" => "success", "message" => "El paciente procesado es $name $last_name"]);


} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}