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


function render_modal(string $modal, string $ubication = null, array $style = [], array $data = []): void
{
  extract(array: $style);
  extract(array: $data);

  //  echo $template . " - " . $style;

  require("modal/$modal.php");

  //Ubication es una variable que se mandara al template -> modal
}


function send_total_patient($conn, $id_doctor, $reg_per_page, $pag_actual): array
{
  $offset = ($pag_actual - 1) * $reg_per_page;

  $query = "SELECT patient.Id_card_number as id,
                    patient.Name as name,
                    patient.Last_name as last_name,
                    patient.Genre as genre,
                    patient.Age as age,
                    patient.Date_registration as date,
                    patient.Contact as contact
                  
        
            From
                    doctor
            Join
                    patient ON patient.FK_Doctor = doctor.Id
            Where
                    doctor.Id = $id_doctor
            Order by
                    patient.Date_registration DESC
            LIMIT $reg_per_page OFFSET $offset
                    ";

  $stmt = $conn->prepare($query);
  $stmt->execute();
  $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //Obtenemos los resultados de la consulta
  $data = array();

  $index = 0;

  // Usar fetchAll() para resultados más limpios
  if (count($result) > 0) {
    foreach ($result as $row) {
      $index++; //Incrementamos el indice
      $data[$index] = $row; //Guardamos los datos en el array
    }
  }
  return !isset($data) ? array() : $data;
}

function send_total_patient_pdf($conn, $id_doctor): array
{

  $query = "SELECT patient.Id_card_number as id,
                    patient.Name as name,
                    patient.Last_name as last_name,
                    patient.Genre as genre,
                    patient.Age as age,
                    patient.Date_registration as date,
                    patient.Contact as contact
                  
        
            From
                    doctor
            Join
                    patient ON patient.FK_Doctor = doctor.Id
            Where
                    doctor.Id = $id_doctor
            Order by
                    patient.Date_registration DESC

                    ";

  $stmt = $conn->prepare($query);
  $stmt->execute();
  $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //Obtenemos los resultados de la consulta
  $data = array();

  $index = 0;

  // Usar fetchAll() para resultados más limpios
  if (count($result) > 0) {
    foreach ($result as $row) {
      $index++; //Incrementamos el indice
      $data[$index] = $row; //Guardamos los datos en el array
    }
  }
  return !isset($data) ? array() : $data;
}

function countUsers(mysqli $conexion, $id_doctor): int      //Calcular el total de paginas
{
  $sql = "SELECT COUNT(*) as total FROM patient WHERE Fk_Doctor = $id_doctor";
  $result_sql = $conexion->query(query: $sql);
  $total = $result_sql->fetch_assoc();
  return intval(value: $total['total']);
}