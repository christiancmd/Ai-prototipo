<?php
require_once "../../config.php";
$conection = new mysqli(hostname: $DB_HOST, username: $DB_USER, password: $DB_PASS, database: $DB_NAME); //Insertar los datos en la base de datos
$conection->set_charset("utf8"); //tipo de codificacion utf8
//Conexion a la base de datos 

if ($conection->connect_errno) { //verifica si hay error en la conexion
    echo "Fallo al conectar a MySQL: (" . $conection->connect_errno . ") " . $conection->connect_error;
}



/*
$conection = new mysqli(hostname: "localhost", username: "root", password: "", database: "nutrimore_guide_db");
$conection->set_charset("utf8");

if ($conection->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $conection->connect_errno . ") " . $conection->connect_error;
}

*/