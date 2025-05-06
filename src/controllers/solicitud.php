<?php
header(header: 'Content-Type: application/json');//Permisos
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// Recibir la entrada JSON y decodificarla
$inputJSON = file_get_contents(filename: 'php://input'); 
$input = json_decode(json: $inputJSON, associative: TRUE);

//var_dump($input);

if ($input === null) {
    // Manejar el error de decodificación JSON
    echo json_encode(value: ['error' => 'Error al decodificar JSON']);
    exit;
}
// Aquí puedes manejar los datos como desees. Por ejemplo, guardarlos en un archivo:
$file = "foodGuide.json"; //Nombre del archivo a crear con los datos recibidos
file_put_contents(filename: $file, data: json_encode(value: $input));

echo "Datos recibidos y guardados en foodGuide.json";

echo "solicitud.php está funcionando";
?>