<?php
header(header: 'Content-Type: application/json');
// Recibir la entrada JSON y decodificarla
$inputJSON = file_get_contents(filename: 'php://input');
$input = json_decode(json: $inputJSON, associative: TRUE);

var_dump($input);
/*
if (json_last_error() === JSON_ERROR_NONE) {
    // Manipular los datos según sea necesario
    // Ejemplo: acceder a los datos en el array
    // echo $dietGuide['some_key'];

    // Enviar una respuesta de vuelta al cliente
    echo json_encode(value: ['status' => 'success', 'data' => $dietGuide]);
} else {
    // Manejar el error de JSON
    echo json_encode(value: ['status' => 'error', 'message' => 'Invalid JSON input']);
}
*/
// Aquí puedes manejar los datos como desees. Por ejemplo, guardarlos en un archivo:
$file = 'foodGuide.json';
file_put_contents(filename: $file, data: json_encode(value: $input));
print_r(value: '-------------------------');

echo "Datos recibidos y guardados en arrayData.json";
?>