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

    $query = "DELETE FROM patient WHERE Id_card_number = $id_patient AND Fk_Doctor = $Id_doctor";

    if ($conection->query($query) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Paciente eliminado correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error deleting patient: " . $conection->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}