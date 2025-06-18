<?php
declare(strict_types=1);
include "conection.php"; // Incluir la conexion a la base de datos
session_start();

$id_card_number_doctor = $_SESSION['id_card_number'];

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $newContact = isset($_POST["Contact"]) ? trim($_POST["Contact"]) : null;
    $pass = isset($_POST["Password"]) ? trim($_POST["Password"]) : null;

    // Validación básica
    if (empty($newContact) || empty($pass)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
        exit;
    }

    if ($conection->connect_error) {
        echo json_encode(["status" => "error", "message" => "failed connection"]);
    }

    $check_query = "SELECT * FROM doctor WHERE Id_card_number = $id_card_number_doctor and Password = $pass";
    $check_id_card = mysqli_query($conection, $check_query);

    if (mysqli_num_rows($check_id_card) > 0) {
        $update_query = "UPDATE doctor SET Contact = ? WHERE Id_card_number = ?";
        $stmt = $conection->prepare($update_query);
        $stmt->bind_param("si", $newContact, $id_card_number_doctor);

        if ($stmt->execute()) {
            $_SESSION['contact'] = $newContact;

            echo json_encode(["status" => "success", "message" => "Datos actualizados"]);
            header("Location: ../view/settings.php");
        }
        $stmt->close();
    }

}

$conection->close();