<?php
//Activar los tipos estrictos
declare(strict_types=1);

//Función para renderizar plantillas con los datos que se les pase
function render_template(string $template, string $ubication = null, array $style = [], array $data = []): void
{
  extract(array: $style);
  extract(array: $data);

  //  echo $template . " - " . $style;

  require("$template.php");

  //Ubication es una variable que se mandara al template
}

function calc_nutrients($data)
{
  $weigth = $data['weight'];
  $heigth = $data['height'];
  $activity = $data['activity'];
  $reason = $data['reason'];
  $age = $data['age'];
  $genre = $data['genre'];

  //Calcular la tasa metabolica basal (TMB)

  if ($genre == "Masculino") {
    $tmb_man = (10 * $weigth) + (6.25 * $heigth) - (5 * $age) + 5;
  } else if ($genre == "Femenino") {
    $tmb_womman = (10 * $weigth) + (6.25 * $heigth) - (5 * $age) - 161;
  } else {
    echo "Error: Genero no valido";
  }

  $tmb_data = $tmb_man ?? $tmb_womman;

  //Calcular el nivel de actividad fisica (NAF)

  match (true) {
    $activity == "Sedentario" => $naf_data = 1.05,
    $activity == "Ligera" => $naf_data = 1.3,
    $activity == "Moderada" => $naf_data = 1.6,
    $activity == "Intensa" => $naf_data = 1.9,
    default => $naf_data = 1.05, //Valor minimo y por defecto
  };

  //Calcular el requerimiento calorico total (RCT)

  $rct_data = round($tmb_data * $naf_data, 2);

  //Defenir el objetivo

  match (true) {
    $reason == "Subir de Peso" => round($rct_obj = $rct_data + (($rct_data * 10) / 100), 2),
    $reason == "Bajar de Peso" => round($rct_obj = $rct_data - (($rct_data * 10) / 100), 2),
    default => $rct_obj = $rct_data, //Valor por defecto
  };

  $medic_patient = [
    'tmb' => $tmb_data,
    'naf' => $naf_data,
    'rct' => $rct_data,
    'rct_obj' => $rct_obj,
  ];

  return $medic_patient;
}