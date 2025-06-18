<?php
declare(strict_types=1);
include "conection.php"; // Incluir la conexion a la base de datos
session_start();

$id_card_number_doctor = $_SESSION['id_card_number'];

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $id_card = isset($_POST["IdCardNumber"]) ? trim($_POST["IdCardNumber"]) : null;
    $new_pass = isset($_POST["NewPassword"]) ? trim($_POST["NewPassword"]) : null;
    $confirm_pass = isset($_POST["ConfirmPassword"]) ? trim($_POST["ConfirmPassword"]) : null;

    if ($conection->connect_error) {
        echo json_encode(["status" => "error", "message" => "failed connection"]);
    }

    if (empty($id_card) || empty($new_pass) || empty($confirm_pass)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
        exit;
    }

    if ($new_pass !== $confirm_pass) {
        echo json_encode(["status" => "error", "message" => "La Contraseña y su verificacion no coinciden!"]);
        exit;
    }

    $check_query = "SELECT * FROM doctor WHERE Id_card_number = $id_card";
    $check_id_pass = mysqli_query($conection, $check_query);

    if (mysqli_num_rows($check_id_pass) > 0) {
        $data_doctor = mysqli_fetch_assoc($check_id_pass);

        $update_query = "UPDATE doctor SET Password = ? WHERE Id_card_number = ?";
        $stmt = $conection->prepare($update_query);
        $stmt->bind_param("ii", $new_pass, $id_card_number_doctor);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Datos actualizados"]);
            header("Location: ../view/settings.php");

        }
        $stmt->close();

    }
}

$conection->close();