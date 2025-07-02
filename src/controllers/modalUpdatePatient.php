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

    $data = json_decode(file_get_contents("php://input"), true);
    $id_patient = isset($data["id"]) ? intval(trim($data["id"])) : 0;

    if ($id_patient <= 0) {
        echo json_encode(["status" => "error", "message" => "ID Invalido"]);
        exit;
    }

    $query = "SELECT 
    patient.Id,
    patient.Id_card_number,
    patient.Name,
    patient.Last_name,
    patient.Age,
    patient.Genre,
    patient.Email,
    patient.Contact,
    status_patient.Tall,
    status_patient.Weigth,
    status_patient.Activity,
    status_patient.Pathology,
    status_patient.Reason
FROM 
    patient
JOIN 
    status_patient
ON 
    patient.Id = status_patient.FK_Patient
WHERE 
    patient.Id_card_number = $id_patient;";

    $result = mysqli_query($conection, $query);

    // Verificar resultados
    if (mysqli_num_rows($result) > 0) {
        $data = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        // Enviar respuesta como JSON
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'message' => 'Datos encontrados',
            'data' => $data
        ]);
        exit;

    } else {
        echo json_encode(['message' => 'No se encontraron datos para ese paciente']);
    }

    //echo json_encode(["status" => "success", "message" => "Paciente Ingresado $id_patient"]);


} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}