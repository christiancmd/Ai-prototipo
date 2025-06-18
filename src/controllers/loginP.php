<?php
session_start();

include "conection.php"; // Incluir la conexion a la base de datos
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    // echo json_encode(["status" => "debug", "data" => $_POST]);
    //exit;/*

    $password = isset($_POST["Password"]) ? trim($_POST["Password"]) : null;
    $id_card_number = intval(isset($_POST["UserCard"])) ? trim($_POST["UserCard"]) : null;
    if ($conection->connect_error) {
        echo json_encode(["status" => "error", "message" => "failed connection"]);
    }

    if (empty($password) || empty($id_card_number)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
        exit;
    }

    if ($password !== 'admin') {

        $check_login = mysqli_query($conection, "SELECT * FROM doctor WHERE id_card_number = '$id_card_number' AND password = '$password'");

        if (mysqli_num_rows(result: $check_login) > 0) { // Si existe el usuario

            $query = $conection->prepare(query: "SELECT * FROM doctor WHERE id_card_number = ? AND Password = ?"); // Preparamos la consulta
            $query->bind_param("is", $id_card_number, $password); // Vinculamos los parametros
            $query->execute(); //ejecutamos la consulta
            $result = $query->get_result(); // Obtenemos el resultado



            while ($row = $result->fetch_assoc()) { // Obtenemos los datos del usuario
                ///Depuracion


                if ($row["Id"]) {
                    $_SESSION['id'] = $row["Id"];
                    $_SESSION['id_card_number'] = $row["Id_card_number"];
                    $_SESSION['name_doctor'] = $row["Name"];
                    $_SESSION['last_doctor'] = $row["Last_name"];
                    $_SESSION['contact'] = $row["Contact"];


                    echo json_encode(["status" => "success", "message" => 1]);
                    exit;
                }
            }
        } else {
            echo json_encode(["status" => "error", "message" => 'error. no se encontro el doctor']);
            exit;
        }
    }

    if ($password === 'admin') {

        $id_card_number = intval($id_card_number);
        $check_login = mysqli_query($conection, "SELECT * FROM admin WHERE Id_card_number = $id_card_number AND Password = '$password'");


        if (mysqli_num_rows($check_login) > 0) { // Si existe el usuario

            $query = $conection->prepare(query: "SELECT * FROM admin WHERE Id_card_number = ? AND Password = ?"); // Preparamos la consulta
            $query->bind_param("is", $id_card_number, $password); // Vinculamos los parametros
            $query->execute(); //ejecutamos la consulta
            $result = $query->get_result(); // Obtenemos el resultado



            while ($row = $result->fetch_assoc()) { // Obtenemos los datos del usuario
                ///Depuracion


                if ($row["Id"]) {
                    $_SESSION['id'] = $row["Id"];
                    $_SESSION['id_card_number'] = $row["Id_card_number"];
                    header('Content-Type: application/json');

                    echo json_encode(["status" => "success", "message" => 2]);
                    exit;
                }
            }
        } else {
            echo json_encode(["status" => "error", "message" => 'error. no se encontro el admin', "data" => $id_card_number . ' ' . $password]);
            exit;
        }



    }


}
