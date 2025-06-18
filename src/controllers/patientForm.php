<?php

declare(strict_types=1);

require_once("../logic/calcForm.php");
require_once("../service/aiPrototype.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar los datos del formulario aquí

    $name_patient = $_POST['name-data'];//Dato del pacient
    $last_name_patient = $_POST['last-name-data'];//Dato del pacient
    $email_patient = $_POST['email-data'];//Dato del pacient
    $id_card_number = intval($_POST['id-data']);//Dato del pacient
    $number_patient = intval(value: $_POST['number-data']);//Dato del pacient
    $age_patient = intval($_POST['born-data']);//Dato del pacient

    $genre_patient = $_POST['gender-data'];
    $weight_patient = $_POST['weight-data'];
    $height_patient = $_POST['height-data'];
    $activity_patient = $_POST['activity-data'];
    $reason_patient = $_POST['reason-data'];
    $pathology_patient = isset($_POST['pathology-data']) ? $_POST['pathology-data'] : '';
    $pathology_patient = $pathology_patient === 'Elegir Patologia' ? 'Sin patologia' : $pathology_patient;

    $data_patient = [
        'name' => $name_patient,
        'last_name' => $last_name_patient,
        'id_card_number' => $id_card_number,
        'email' => $email_patient,
        'number' => $number_patient,
        'age' => $age_patient,
        'genre' => $genre_patient,
        'weight' => $weight_patient,
        'height' => $height_patient,
        'activity' => $activity_patient,
        'reason' => $reason_patient,
        'pathology' => $pathology_patient,
    ];

    $medic_data = calc_nutrients($data_patient);

    $data_patient['nutrients_data'] = [
        'imc' => $medic_data['imc'],
        'tmb' => $medic_data['tmb'],
        'naf' => $medic_data['naf'],
        'rct' => $medic_data['rct'],
        'rct_obj' => $medic_data['rct_obj'],
    ];

    /*  $prompt_ai = get_ai_response($data_patient);

      $data_patient['prompt'] = [
          'prompt' => $prompt_ai
      ];
  */


    $json_patient = json_encode($data_patient, JSON_PRETTY_PRINT);

    header('Content-Type: application/json');
    file_put_contents('patient.json', $json_patient);


    get_ai_response($data_patient);


    header("location: ../view/dietGuide.php");
    exit;
    // Redirigir a la página deseada

}
