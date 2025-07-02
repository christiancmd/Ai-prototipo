<?php
session_start();

include "conection.php"; // Incluir la conexion a la base de datos
header('Content-Type: application/json');
$Id_doctor = $_SESSION['id'] ?? null; // Obtener el id del doctor de la sesion

if ($_SERVER["REQUEST_METHOD"] === 'POST') {


    if ($conection->connect_error) {
        echo json_encode(["status" => "error", "message" => "failed connection"]);
    }

    // Lista de campos requeridos
    $fill_Requierments = [
        'name-data',
        'last-name-data',
        'id-data',
        'email-data',
        'number-data',
        'born-data',
        'gender-data',
        'weight-data',
        'height-data',
        'activity-data',
        'pathology-data'
    ];

    // Validación de campos vacíos
    foreach ($fill_Requierments as $camp) {
        if (!isset($_POST[$camp]) || trim($_POST[$camp]) === '') {
            echo json_encode(["status" => "error", "message" => "Falta el campo: $camp"]);
            exit;
        }
    }


    $id_card_number = isset($_POST["id-data"]) ? intval(trim($_POST["id-data"])) : 0;
    $number = isset($_POST["number-data"]) ? intval(trim($_POST["number-data"])) : 0;
    $weight = isset($_POST["weight-data"]) ? floatval(trim($_POST["weight-data"])) : 0.0;
    $height = isset($_POST["height-data"]) ? floatval(trim($_POST["height-data"])) : 0.0;

    $name = isset($_POST["name-data"]) ? trim($_POST["name-data"]) : null;
    $last_name = isset($_POST["last-name-data"]) ? trim($_POST["last-name-data"]) : null;
    $email = isset($_POST["email-data"]) ? trim($_POST["email-data"]) : null;
    $age = isset($_POST["born-data"]) ? trim($_POST["born-data"]) : null;
    $genre = isset($_POST["gender-data"]) ? trim($_POST["gender-data"]) : null;
    $activity = isset($_POST["activity-data"]) ? trim($_POST["activity-data"]) : "Sedentario";
    $reason = isset($_POST["reason-data"]) ? trim($_POST["reason-data"]) : "Sin motivo";
    $pathology = isset($_POST["pathology-data"]) ? trim($_POST["pathology-data"]) : "Sin patologia";

    $pathology = $pathology === "Elegir Patologia" ? "Sin patologia" : $pathology;

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
        $response = ["status" => "error", "message" => "Error al insertar el paciente: "];
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



    echo json_encode(["status" => "success", "message" => "Datos recibidos correctamente", "Id-doctor" => $user_id]);
    exit;

}