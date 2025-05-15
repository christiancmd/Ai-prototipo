<?php

declare(strict_types=1);

require_once("../templates/functions.php");

$name_patient = $_POST['name-data'];//Dato del pacient
$last_name_patient = $_POST['last-name-data'];//Dato del pacient
$email_patient = $_POST['email-data'];//Dato del pacient
$id_card_number = intval($_POST['id-data']);//Dato del pacient
$number_patient = intval(value: $_POST['number-data']);//Dato del pacient
$age_patient = intval($_POST['born-data']);//Dato del pacient

$radio1_patient = isset($_POST['gender1']) ? $_POST['gender1'] : null;
$radio2_patient = isset($_POST['gender2']) ? $_POST['gender2'] : null;

$genre_patient = $radio1_patient ?? $radio2_patient;//Dato del pacient
$weight_patient = $_POST['weight-data'];
$height_patient = $_POST['height-data'];
$activity_patient = $_POST['activity-data'];
$reason_patient = $_POST['reason-data'];

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
];

$medic_data = calc_nutrients($data_patient);

$data_patient['nutrients_data'] = [
    'tmb' => $medic_data['tmb'],
    'naf' => $medic_data['naf'],
    'rct' => $medic_data['rct'],
    'rct_obj' => $medic_data['rct_obj'],
];

var_dump($data_patient);


