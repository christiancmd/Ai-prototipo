<?php

/*Conexion a la base de datos */
$conection = new mysqli(hostname: "localhost", username: "root", password: "", database: "nutrimore_guide_db");
$conection->set_charset("utf8");

if ($conection->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $conection->connect_errno . ") " . $conection->connect_error;}

// if ($conection) {
//     echo "Conexión exitosa";
// } else {
//     echo "Error en la conexión";
// }
