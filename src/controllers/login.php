<?php

session_start(); // Iniciar la sesión

include "conection.php"; // Incluir la conexion a la base de datos

$id_card_number = intval($_POST['UserCard']); //Obtenemos la cedula
$password = $_POST['Password']; //Obtenemos la contraseña

// Verificamos si existe el usuario
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
            header("location: ../view/home.php"); // Redirigimos a la pagina de inicio
        }


    }

} else { // Si no existe el usuario

    echo "<script>alert('Usuario no encontrado') </script>";
    echo "<script>window.location = '../../index.php'</script>";


    exit();
}
/* */

