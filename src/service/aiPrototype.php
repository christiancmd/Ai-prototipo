<?php

require_once("../../config.php");

function process_curl($url, $prompt)
{
  $data = [
    "contents" => [
      [
        "parts" => [
          [
            "text" => $prompt // Si la API necesita "data", úsalo en lugar de "text"
          ]
        ]
      ]
    ]
  ];

  $data_json = json_encode($data);

  $option = array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => '',
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $data_json,
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
    ),
  );

  $curl = curl_init();

  curl_setopt_array($curl, $option);

  $response = curl_exec($curl);

  if (curl_errno($curl)) {
    $message = "Error en cURL" . curl_error($curl);
  } else {
    $response_associative = json_decode($response, true);

    if (isset($response_associative['error'])) {
      $message = "Error de la API: " . $response_associative['error']['message'];
    } elseif (!empty($response_associative['candidates'])) {
      foreach ($response_associative['candidates'] as $candidato) {
        if (!empty($candidato['content']['parts']) && isset($candidato['content']['parts'][0]['text'])) {
          $message = $candidato['content']['parts'][0]['text'];

          // --- START: Added code to clean the message ---
          // Remove leading and trailing markdown code block syntax
          $message = preg_replace('/^```json\s*\n/', '', $message);
          $message = preg_replace('/\n```$/', '', $message);
          // --- END: Added code to clean the message ---

          break;
        }
      }
    } else {
      $message = "Error: La API no devolvió candidatos.";
    }
  }

  curl_close($curl);

  return $message;

}

function request_ai($prompt)
{
  global $apiKey;
  $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-001:generateContent?key=' . $apiKey;

  $message_gemini = process_curl($url, $prompt);

  file_put_contents("result.json", $message_gemini); // Guarda la respuesta limpia en un archivo JSON para depuración





}


function get_ai_response($data)
{
  extract($data);


  $prompt = '
  Como nutricionista profesional, genera una lista de intercambio de alimentos personalizada con los datos:
  - Objetivo: ' . $reason . '
  - Datos del paciente: ' . $age . 'años,  ' . $weight . 'kg, ' . $height . 'cm, ' . $genre . '
  - Observación clave: ' . $pathology . '
  - rct objetivo: ' . $rct_obj . 'kcal
  El formato de salida debe ser un objeto JSON:
  -"listaDeIntercambio": Un array de objetos, donde cada objeto representa una categoría de alimento (lácteos, grasas, vegetales, proteínas, almidones, frutas). Dentro de cada categoría, habrá un array de objetos, y cada objeto contendrá el alimento y su cantidad específica (ej. `{"Alimento": "Cantidad"}`). 
  -Recuerda que los alimentos se basan firmementa con el objetivo y la observacion/patologia (Nada de pan, melon ni granos, leche que perjudique las afecciones). que no se exceda que mas de 5 alimentos por grupo.
  -"Alimentos_no_permitidos": Un array de objetos, donde cada objeto incluye una pauta ("Evitar") y una lista de alimentos a evitar.

  **Excluye** cualquier texto adicional, introducciones, explicaciones, suplementos, saltos de linea (\n), deportes específicos o identificadores. Solo necesito el objeto JSON puro.

  ejemplo de la estructura esperada para las categorías de alimentos:
  {
    "listaDeIntercambio": [
      {
        "lacteos": [
          { "Leche descremada": "240ml" },
          {  "Yogur natural descremado": "170g" }
        ]
      },
      {
        "grasas": [
          { "Aguacate": "1/4 unidad pequeña" },
          { "Aceite de oliva": "1 cucharadita" }
        ]
      }
    ],
    "Alimentos_no_permitidos": [
      {
        "pautas": "Evitar o limitar",
        "alimentos": [
          "Bebidas azucaradas",
          "Alimentos fritos"
        ]
      }
    ]
  }
';

  request_ai($prompt);

}

