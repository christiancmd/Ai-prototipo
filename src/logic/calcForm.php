<?php

declare(strict_types=1);

function calc_imc($w, $h): float|int
{
    if ($h == 0) {
        return 0;
    }
    $h = round($h / 100, 2);
    return round($w / $h ** 2, 2);
}

function calc_nutrients($data)
{
    $weigth = $data['weight']; //Peso en kg
    $heigth = $data['height']; //Altura en cm
    $activity = $data['activity']; //Nivel de actividad fisica
    $reason = $data['reason']; //Razon de visita
    $age = $data['age']; //Edad en años
    $genre = $data['genre']; //Genero del paciente

    //Calcular la tasa metabolica basal (TMB) -> Formula otorgada por el nutricionista
    if ($genre == "Masculino") {
        $tmb_man = (10 * $weigth) + (6.25 * $heigth) - (5 * $age) + 5;
    } else if ($genre == "Femenino") {
        $tmb_womman = (10 * $weigth) + (6.25 * $heigth) - (5 * $age) - 161;
    } else {
        echo "Error: Genero no valido";
    }

    $tmb_data = $tmb_man ?? $tmb_womman;

    //Calcular el nivel de actividad fisica (NAF)  -> Formula otorgada por el nutricionista
    match (true) {
        $activity == "Sedentario" => $naf_data = 1.05,
        $activity == "Ligera" => $naf_data = 1.3,
        $activity == "Moderada" => $naf_data = 1.6,
        $activity == "Intensa" => $naf_data = 1.9,
        default => $naf_data = 1.05, //Valor minimo y por defecto
    };

    //Calcular el requerimiento calorico total (RCT)  -> Formula otorgada por el nutricionista
    $rct_data = round($tmb_data * $naf_data, 2);

    //Defenir el objetivo  -> Formula otorgada por el nutricionista
    match (true) {
        $reason == "Subir de Peso" => round($rct_obj = $rct_data + (($rct_data * 10) / 100), 2),
        $reason == "Bajar de Peso" => round($rct_obj = $rct_data - (($rct_data * 10) / 100), 2),
        default => $rct_obj = $rct_data, //Valor por defecto
    };

    $imc_base = calc_imc($weigth, $heigth);//calcular imc

    match (true) {
        $imc_base >= 0 && $imc_base < 18.5 => $imc_data = "Infrapeso",
        $imc_base >= 18.5 && $imc_base <= 24.9 => $imc_data = "Normopeso",
        $imc_base >= 25 && $imc_base <= 29.9 => $imc_data = "Sobrepeso",
        $imc_base >= 30 => $imc_data = "Obesidad",
        default => $imc_data = "Valor nulo",
    };

    $medic_patient = [ //Creamos un objeto con los datos medicos del paciente'
        'imc' => $imc_data,
        'tmb' => $tmb_data,
        'naf' => $naf_data,
        'rct' => $rct_data,
        'rct_obj' => $rct_obj,
    ];

    return $medic_patient;
}