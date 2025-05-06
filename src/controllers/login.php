<?php

session_start();

include "conection.php";

$id_card_number = intval($_POST['UserCard']);
$password = $_POST['Password'];

$check_login = mysqli_query($conection, "SELECT * FROM doctor WHERE id_card_number = '$id_card_number' AND password = '$password'");

if (mysqli_num_rows($check_login) > 0) {
    
    $query = $conection->prepare(query: "SELECT * FROM doctor WHERE id_card_number = ? AND Password = ?");
    $query->bind_param("is", $id_card_number, $password);
    $query->execute();
    $result = $query->get_result();

    while ($row = $result->fetch_assoc()) {
        ///Depuracion
        header("location: ../view/home.php");
        //var_dump(value: $row);
    }

}else{
    echo "<script>alert('Usuario no encontrado') </script>";
    echo "<script>window.location = '../../index.php'</script>";
    exit();
}
/* */

