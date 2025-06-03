<?php
declare(strict_types=1);
session_start();

//echo $_SESSION['id'] ?? "No session started"; // Depuracion de la sesion
//echo $_SESSION['id_card_number'] ?? "No session started"; // Depuracion de la sesion
include_once "../controllers/conection.php";

//Activar los tipos estrictos
//Incluir el archivo de funciones mediante templates
require_once("../templates/functions.php");

$Id_doctor = $_SESSION['id'] ?? null; // Obtener el id del doctor de la sesion


function query_process($query, $conection): array
{
  $stmt = $conection->prepare($query);//Preparamos la consulta
  $stmt->execute();// ejecutamos la consulta
  $response = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //Obtenemos los resultados de la consulta
  $data = array(); // Inicializar el array

  $index = 0;

  if (count($response) > 0) {
    foreach ($response as $row) {
      $index++; //Incrementamos el indice
      $data[$index] = $row; //Guardamos los datos en el array
    }
  }

  return $data; // Retornamos el array con los datos
}

$query1 = "SELECT 
    doctor.Id_card_number AS Id_card_number,
    doctor.Name AS Name_doctor, 
    doctor.Last_name AS Last_name_doctor, 
    COUNT(patient.Id) AS Total_patient, 
    SUM(CASE WHEN patient.Genre = 'Masculino' THEN 1 ELSE 0 END) AS Total_male, 
    SUM(CASE WHEN patient.Genre = 'Femenino' THEN 1 ELSE 0 END) AS Total_female
FROM 
    doctor
JOIN 
    patient ON patient.Fk_Doctor = doctor.Id
WHERE 
    doctor.Id = $Id_doctor
GROUP BY 
    doctor.Id, doctor.Name, doctor.Last_name";

$query2 = "SELECT 
	patient.Name,
    patient.Last_name,
    patient.date_registration AS Date
FROM
	doctor
JOIN
	patient ON patient.Fk_Doctor = doctor.Id
WHERE
	doctor.Id = $Id_doctor
ORDER BY
	patient.date_registration DESC 
LIMIT 3";

$data = query_process($query1, $conection); // Ejecutamos la consulta y obtenemos los datos

$data_date = query_process($query2, $conection); // Ejecutamos la consulta y obtenemos los datos

//$query = "SELECT * FROM doctor WHERE id = $Id_doctor";


extract($data[1]); // Extraemos los datos del array para usarlos en la vista
extract($data_date[1]); // Extraemos los datos del array para usarlos en la vista

?>

<!DOCTYPE html>
<html lang="en">

<?php render_template(template: "head", style: array("style" => "home")) ?>

<body>
  <?php render_template(template: "headerAdmin", ubication: "home") ?>

  <main>
    <section id="hero">

      <?php render_template(template: "asideButton", ubication: "home") ?>

      <article id="hero-container">
        <header class="hero-bar">
          <p>Guia Alimentaria</p>
        </header>
        <div class="hero-content">

          <section class="hero-box box-user box1">
            <div class="profile-img">
              <img src="../img/home/profile.png" alt="User-profile">
            </div>
            <hgroup>
              <p><?= $Name_doctor . ' ' . $Last_name_doctor ?></p>
              <p><?= $Id_card_number ?></p>
              <p>Nutricionista</p>
            </hgroup>
          </section>

          <section class="pacient-table box2">
            <header class="table-header">
              <strong>Ultimos Pacientes</strong>
            </header>
            <table class="table">
              <thead>
                <tr>
                  <th>Nombre de Paciente</th>
                  <th>Fecha de Registro</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data_date as $row): ?>
                  <tr>
                    <td><?= $row['Name'] . ' ' . $row['Last_name'] ?></td>
                    <td><?= date("d/m/Y", strtotime($row['Date'])) ?></td>
                  </tr>

                <?php endforeach; ?>
              </tbody>
            </table>
          </section>

          <section class="male-box box3">
            <div class="data-resume">
              <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 1024 1024">
                <path fill="#0100ff"
                  d="M874 120H622c-3.3 0-6 2.7-6 6v56c0 3.3 2.7 6 6 6h160.4L583.1 387.3c-50-38.5-111-59.3-175.1-59.3c-76.9 0-149.3 30-203.6 84.4S120 539.1 120 616s30 149.3 84.4 203.6C258.7 874 331.1 904 408 904s149.3-30 203.6-84.4C666 765.3 696 692.9 696 616c0-64.1-20.8-124.9-59.2-174.9L836 241.9V402c0 3.3 2.7 6 6 6h56c3.3 0 6-2.7 6-6V150c0-16.5-13.5-30-30-30M408 828c-116.9 0-212-95.1-212-212s95.1-212 212-212s212 95.1 212 212s-95.1 212-212 212" />
              </svg>
              <?php $Total_male = isset($Total_male) ? $Total_male : 0 ?>
              <p><?= $Total_male ?></p>
            </div>
          </section>

          <section class="female-box box4">
            <div class="data-resume">
              <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 1024 1024">
                <path fill="#ff00cf"
                  d="M712.8 548.8c53.6-53.6 83.2-125 83.2-200.8c0-75.9-29.5-147.2-83.2-200.8C659.2 93.6 587.8 64 512 64s-147.2 29.5-200.8 83.2S228 272.1 228 348c0 63.8 20.9 124.4 59.4 173.9c7.3 9.4 15.2 18.3 23.7 26.9c8.5 8.5 17.5 16.4 26.8 23.7c39.6 30.8 86.3 50.4 136.1 57V736H360c-4.4 0-8 3.6-8 8v60c0 4.4 3.6 8 8 8h114v140c0 4.4 3.6 8 8 8h60c4.4 0 8-3.6 8-8V812h114c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8H550V629.5c61.5-8.2 118.2-36.1 162.8-80.7M512 556c-55.6 0-107.7-21.6-147.1-60.9C325.6 455.8 304 403.6 304 348s21.6-107.7 60.9-147.1S456.4 140 512 140s107.7 21.6 147.1 60.9C698.4 240.2 720 292.4 720 348s-21.6 107.7-60.9 147.1C619.7 534.4 567.6 556 512 556" />
              </svg>
              <?php $Total_female = isset($Total_female) ? $Total_female : 0 ?>
              <p><?= $Total_female ?></p>
            </div>
          </section>

          <section id="do-container" class="centex box5">
            <div id="input-container" class="center">
              <h1>Mis Tareas</h1>
              <input type="text" placeholder="Ingresa una tarea" id="Ingresar-tarea">
              <button type="submit">Crear Tarea</button>
              <p id="totalTareas">Numero total de tareas: 0</p>
            </div>
            <div id="list-container"></div>
          </section>
        </div>
      </article>
    </section>

    <?php render_template(template: "aside", ubication: "home") ?>
  </main>

  <?php render_template(template: "footer", ubication: "home") ?>

  <script src="../app/actionAside.js"></script>
  <script src="../app/doList.js"></script>
</body>

</html>



<!--  -->